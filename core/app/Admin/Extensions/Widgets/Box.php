<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-02-28
 * Time: 下午 3:46
 */

namespace App\Admin\Extensions\Widgets;


class Box extends \Encore\Admin\Widgets\Box
{
    public function createable()
    {
        $this->tools[] =
            '<a href="'.app('request')->getPathInfo().'/create" class="btn btn-sm btn-success" title="新增">
        <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;新增</span>
    </a>';
        return $this;
    }
}