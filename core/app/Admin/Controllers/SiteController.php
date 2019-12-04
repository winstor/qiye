<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Actions\CreateRow;

use App\Admin\Extensions\Actions\EditRow;
use App\Admin\Extensions\Actions\SiteDelete;
use App\AdminUser;
use App\Site;
use App\Http\Controllers\Controller;
use App\Template;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class SiteController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('站点管理')
            ->description('列表')
            ->body($this->grid());
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('网站管理')
            ->description('编辑')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('网站管理')
            ->description('创建')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Site);
        $grid->filter(function(Grid\Filter $filter){
            $filter->disableIdFilter();
            $filter->column(1/2,function(Grid\Filter $filter){
                $filter->equal('code','站点标识');
            });
            $filter->column(1/2,function(Grid\Filter $filter){
                $filter->like('name','站点名称');
            });
        });
        $grid->id('ID')->sortable();
        $grid->code('根目录');
        $grid->name('名称');
        $grid->adminUsers('管理者')->pluck('name')->label();
        $status = [
            'on'  => ['value' => 1, 'text' => '启用', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '禁用', 'color' => 'default'],
        ];
        $grid->status('状态')->switch($status);
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            //禁用查看
            $site_id = $actions->row->id;
            $actions->disableView();
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->append(new CreateRow('/admin/adminUsers/create?site_id='.$site_id,'添加管理者'));
            $actions->append(new EditRow('/admin/sites/'.$site_id));
            //$actions->append(new DeleteRow('/admin/sites/',$site_id));
        });
        $grid->tools(function (Grid\Tools $tools) {
            $tools->batch(function (Grid\Tools\BatchActions $actions) {
                //禁用批量删除
                $actions->disableDelete();
            });
        });
        //禁用导出
        $grid->disableExport();
        return $grid;
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Site);
        $form->hidden('id');
        $form->text('code','网站标识')->rules('required',['required'=>'网站标识必须']);
        $form->text('name','名称')->rules('required',['required'=>'名称必须']);
        $form->text('host','域名地址')->default('');

        $form->select('template_id','状态')->options(Template::where('status',1)->pluck('name','template'));
        $states = [
            'on'  => ['value' => 1, 'text' => '启用', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '禁用', 'color' => 'danger'],
        ];
        $form->switch('status','状态')->states($states);
        $form->footer(function($footer){
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }
    public function destroy($id)
    {
        $data = [
            'status'  => false,
            'message' => trans('暂不支持删除'),
        ];
        return response()->json($data);
    }
}
