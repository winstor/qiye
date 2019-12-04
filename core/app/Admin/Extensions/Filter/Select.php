<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-03-08
 * Time: 下午 2:00
 */

namespace App\Admin\Extensions\Filter;

use Encore\Admin\Admin;
class Select
{
    protected $options;
    protected $class;
    protected $name;
    public function __construct($options,$name,$class='')
    {
        $this->name = $name;
        $this->class = $class?:$name;
        $this->options = $options;
    }

    public function script()
    {
        $placeholder = json_encode([
            'id'   => '',
            'text' => trans('admin.choose'),
        ]);
        $script = <<<SCRIPT
$(".{$this->class}").select2({
  placeholder: $placeholder,
  "allowClear":true
});

SCRIPT;
        Admin::script($script);
    }

    protected function render()
    {
        $view =  view('admin::filter.select', [
                'name'=>$this->name,
                'class'=>$this->class,
                'options'=>$this->options,
                'value'=>request()->get($this->name,0)
            ])->render();
        return <<<EOT
<div class="col-sm-3">{$view}</div>
EOT;
    }

    public function __toString()
    {
        return $this->render();
    }


}