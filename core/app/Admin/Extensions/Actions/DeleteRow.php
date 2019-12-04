<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-02-21
 * Time: 下午 2:23
 */

namespace App\Admin\Extensions\Actions;
use Encore\Admin\Admin;


class DeleteRow
{
    protected $router;
    protected $id;
    public function __construct($router,$id)
    {
        $this->id = $id;
        $this->router = rtrim($router,'/');
    }
    protected function script()
    {
        return <<<SCRIPT
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
                    url: '$this->router/'+id,
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
SCRIPT;
    }
    protected function render()
    {
        Admin::script($this->script());
        return <<<EOT
&nbsp;<a href="javascript:void(0);"  data-id="$this->id" class="grid-row-delete" title="删除"><i class="fa fa-trash"></i></a>
EOT;
    }

    public function __toString()
    {
        return $this->render();
    }

}