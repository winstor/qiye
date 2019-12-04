<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-03-08
 * Time: 上午 11:01
 */

namespace App\Admin\Extensions\Grid\Article;

use Encore\Admin\Grid\Tools\AbstractTool;

class CreateButton extends AbstractTool
{
    protected $fa;
    protected $title;
    protected $queryString;
    public function __construct($title,$params='',$fa='fa-plus')
    {
        $this->fa = $fa;
        $this->title = $title;
        $this->queryString = $this->getQueryString($params);

    }
    protected function getQueryString($params)
    {
        $params = is_array($params)?$params:[$params];
        $request = request()->only($params);
        if($request){
            return http_build_query($request);
        }
        return '';
    }
    /**
     * Render CreateButton.
     *
     * @return string
     */
    public function render()
    {
        $url =  sprintf('%s/create%s',
            app('request')->getPathInfo(),
            $this->queryString ? ('?'.$this->queryString) : ''
        );
        return <<<EOT

<div class="btn-group pull-right" style="margin-right: 10px">
    <a href="{$url}" class="btn btn-sm btn-success" title="{$this->title}">
        <i class="fa {$this->fa}"></i><span class="hidden-xs">&nbsp;&nbsp;{$this->title}</span>
    </a>
</div>

EOT;
    }

}