<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-03-01
 * Time: 上午 10:57
 */

namespace App\Admin\Extensions\Grid;

use Closure;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Column;

class CategoryGrid extends Grid
{
    protected $handleData;

    public function build()
    {
        if ($this->builded) {
            return;
        }

        $collection = $this->processFilter(false);

        $data = $collection->toArray();

        $this->prependRowSelectorColumn();
        $this->appendActionsColumn();

        Column::setOriginalGridModels($collection);

        $this->columns->map(function (Column $column) use (&$data) {
            $data = $column->fill($data);

            $this->columnNames[] = $column->getName();
        });
        if($this->handleData){
            $data = call_user_func($this->handleData,$data);
        }
        $this->buildRows($data);

        $this->builded = true;
    }
    //处理数据
    public function handleData(Closure $callback)
    {
        $this->handleData = $callback;
        return $this;
    }
}