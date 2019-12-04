<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-02-21
 * Time: 下午 2:54
 */

namespace App\Admin\Extensions\Actions;


class CreateRow
{
    protected $router;
    protected $i;
    protected $title;
    public function __construct($router,$title='添加',$i='fa-plus')
    {
        $this->router = $router;
        $this->i = $i;
        $this->title = $title;
    }
    protected function render()
    {
        return <<<EOT
<a href="$this->router" title="$this->title"><i class="fa $this->i"></i></a>&nbsp;
EOT;
    }

    public function __toString()
    {
        return $this->render();
    }

}