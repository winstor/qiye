<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-03-04
 * Time: 下午 2:43
 */

namespace App\Admin\Extensions\Grid;

use Encore\Admin\Admin;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Collection;

class CategoryTree
{
    protected $model;
    protected $columns;
    public $columnNames = [];
    protected $rows;
    protected $view = 'admin.grid.category';
    protected $keyName='id';
    protected $titleName = 'title';
    protected $switches=[];
    protected $resourcePath;
    public static $script = [];
    protected $items;

    public function __construct(Eloquent $model)
    {
        $this->model = $model;
        $this->keyName =$model->getKeyName();
        $this->items = new Collection();
    }
    public function model()
    {
        return $this->model;
    }
    public function query(callable $callback=null)
    {
        $callback($this->model());
    }
    public function addSwitch($name,$label)
    {
        $this->column($name,$label);
        $this->switches[] = $name;
        $this->switchScript($name);
        return $this;
    }
    protected function switchScript($name)
    {
        $class = 'grid-switch-'.$name;
        $key = $name;
        $script  =  <<<EOT
$('.$class').bootstrapSwitch({
    size:'mini',
    onText: '启用',
    offText: '禁用',
    onColor: 'primary',
    offColor: 'default',
    onSwitchChange: function(event, state){

        $(this).val(state ? 'on' : 'off');

        var pk = $(this).data('key');
        var value = $(this).val();

        $.ajax({
            url: "{$this->resource()}/" + pk,
            type: "POST",
            data: {
                "{$key}": value,
                _token: LA.token,
                _method: 'PUT'
            },
            success: function (data) {
                toastr.success(data.message);
            }
        });
    }
});

EOT;
        Admin::script($script);
    }

    protected function delScript()
    {
        $script= <<<EOT
$('.grid-row-delete').unbind('click').click(function() {

    var id = $(this).data('id');

    swal({
        title: "确认删除?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "确认",
        showLoaderOnConfirm: true,
        cancelButtonText: "取消",
        preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    method: 'post',
                    url: '{$this->resource()}/' + id,
                    data: {
                        _method:'delete',
                        _token:LA.token,
                    },
                    success: function (data) {
                        $.pjax.reload('#pjax-container');
                        resolve(data);
                    }
                });
            });
        }
    }).then(function(result) {
        var data = result.value;
        if (typeof data === 'object') {
            if (data.status) {
                swal(data.message, '', 'success');
            } else {
                swal(data.message, '', 'error');
            }
        }
    });
});           
EOT;
        Admin::script($script);
    }

    public function column($name,$label)
    {
        $this->columns[$name] =$label;
        return $this;
    }

    public function resource($path = null)
    {
        if (!empty($path)) {
            $this->resourcePath = $path;
            return $this;
        }

        if (!empty($this->resourcePath)) {
            return $this->resourcePath;
        }
        return app('request')->getPathInfo();
    }

    public function render()
    {
        $lists = $this->model()->get()->groupBy('parent_id');
        $data = [
            'columns'=>$this->columns,
            'lists'=> $this->tree($lists),
            'scripts'=>self::$script,
            'switches'=>$this->switches,
            'router'=>$this->resource(),
            'titleName'=>$this->titleName,
            'keyName'=>$this->model()->getKeyName()
        ];
        $this->delScript();
        return  view($this->view,$data)->render();
    }
    public function tree($lists,$pid=0,$num=0)
    {
        $new_data = [];
        if(isset($lists[$pid])){
            foreach($lists[$pid] as $item){
                $item['level'] = $num;
                $new_data[] = $item;
                $child_data = $this->tree($lists,$item[$this->keyName],++$num);
                $new_data = array_merge($new_data,$child_data);
            }
        }
        return $new_data;
    }
    public function __toString()
    {
        return $this->render();
    }

}