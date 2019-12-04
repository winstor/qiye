<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-02-21
 * Time: 下午 2:41
 */

namespace App\Admin\Extensions\Actions;

class EditRow
{
    protected $router;
    protected $i;
    public function __construct($router,$i='fa-edit')
    {
        $this->router = $router;
        $this->i = $i;
    }
    protected function render()
    {
        return <<<EOT
&nbsp;
<a href="$this->router/edit" title="编辑"><i class="fa $this->i"></i></a>
&nbsp;
EOT;
    }

    public function __toString()
    {
        return $this->render();
    }

}