<?php

namespace App\Admin\Extensions;

use Encore\Admin\Admin;
use Encore\Admin\Form\Field;

class Ueditors extends Field
{
    protected $view = 'admin.ueditors';

    /*protected static $css = [

    ];*/

    protected static $js = [
        '/vendor/ueditor/ueditor.config.js',
        '/vendor/ueditor/ueditor.all.js',
    ];

    public function render()
    {
        $this->script = <<<EOT

UE.delEditor("containers");
var ue = UE.getEditor("containers", {
    initialFrameWidth: "100%",
    initialFrameHeight:500
});

EOT;
        return parent::render();
    }
}