<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-03-08
 * Time: 下午 2:00
 */

namespace App\Admin\Extensions\Grid\Article;

use Encore\Admin\Admin;
class SelectChange
{
    protected $options;
    protected $class;
    protected $name;
    protected $router;
    public function __construct($options,$name,$class='')
    {
        $this->name = $name;
        $this->class = $class?:$name;
        $this->options = $options;
        $this->router = app('request')->getPathInfo();
    }

    public function script()
    {
        $script = <<<SCRIPT

$(".{$this->class}").select2({
  placeholder: {id:"",text:"请选择分类"},
  "allowClear":true
});
//选择后自动跳转
$('select[name="{$this->name}"]').change(function(){
    var value = $(this).val();
    if(value){
        window.location.href="{$this->router}?{$this->name}="+value;
    }else{
        window.location.href="{$this->router}";
    }
})

SCRIPT;
        Admin::script($script);
        return $script;
    }
    protected function render()
    {
        $this->script();
        return view('admin::filter.select', [
                'name'=>$this->name,
                'class'=>$this->class,
                'options'=>$this->options,
                'value'=>request()->get($this->name,0)
            ])->render();
    }

    public function __toString()
    {
         return <<<EOT
<div class="col-sm-3">{$this->render()}</div>
EOT;
    }


}