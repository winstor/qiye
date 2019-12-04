<?php

namespace App\Admin\Controllers;

use App\Template;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TemplateController extends Controller
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
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
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
            ->header('Edit')
            ->description('description')
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
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Template);

        $grid->id('ID');
        $grid->name('名称');
        $grid->template('目录');
        $status = [
            'on'  => ['value' => 1, 'text' => '启用', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '禁用', 'color' => 'default'],
        ];
        $grid->status('状态')->display(function($status){
            return $status?'使用':'禁用';
        });
        $grid->created_at('创建日期');
        $grid->updated_at('更新日期');
        $grid->disableRowSelector();
        $grid->disableFilter();
        $grid->disableExport();
        $grid->actions(function(Grid\Displayers\Actions $actions){
            $actions->disableView();
            $actions->disableDelete();
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        return redirect('/admin/templates');
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Template);

        $form->text('name', '模板名称')->rules('required',['required'=>'名称不能为空']);
        $form->hidden('template')->default('temp_'.date('YmdHis'))->rules('required',['required'=>'目录不能为空']);
        $form->image('template_img','模板展示图');
        $form->file('file')->move('template')->uniqueName()->help('上传模板')->options(['showPreview'=>false]);
        $states = [
            'on'  => ['value' => 1, 'text' => '使用', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ];
        $form->switch('status', 'Status')->states($states);
        $form->footer(function(Form\Footer $footer){
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableCreatingCheck();
            $footer->disableEditingCheck();
        });
        $form->tools(function(Form\Tools $tools){
            $tools->disableDelete();
            $tools->disableView();
        });
        $form->saving(function(Form $form){
            if($form->model()->template=='temp_default'){
                $form->template= 'temp_default';
                $form->status=1;
            }
        });
        $form->saved(function(Form $form){

        });
        return $form;
    }

}
