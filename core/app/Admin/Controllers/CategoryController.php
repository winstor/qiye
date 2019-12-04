<?php

namespace App\Admin\Controllers;


use App\Admin\Extensions\Actions\CreateRow;
use App\Admin\Extensions\Actions\DeleteRow;
use App\Admin\Extensions\Actions\EditRow;
use App\Article;
use App\Category;
use Encore\Admin\Form;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use App\Admin\Extensions\Grid\CategoryGrid;
use Encore\Admin\Controllers\HasResourceActions;

use App\Admin\Extensions\Grid\Test;

class CategoryController extends Controller
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
            ->header('分类管理')
            ->description('分类列表')
            ->body($this->grid());
    }
    protected function grid()
    {
        $grid = new CategoryGrid(new Category());
        $grid->model()->where('site_id',config('site.site_id'))->orderBy('order');
        $grid->id('ID');
        $grid->title('名称')->display(function($title){
            $top =  $this->parent_id==0?'<img src="/uploads/anchor.gif" />&nbsp;':'|-&nbsp;';
            return $top.$title;
        });
        $grid->column('article_count','文章数量')->display(function(){
            $count = $this->articles()->count();
            if($count>0){
                return '<a href="/admin/articles?category_id='.$this->id.'">'.$count.'</a>';
            }
            return '0';
        });
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
        ];
        $grid->is_index('首页显示')->switch($states);
        $grid->is_menu('导航显示')->switch($states);
        $grid->order('导航排序')->editable();
        //$grid->updated_at(trans('admin.updated_at'));
        $grid->handleData(function($items){
            return Category::tree($items,0,0,1);
        });
        $grid->actions(function(Actions $actions){
            $actions->disableView();
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->append(new CreateRow('/admin/categories/create?parent_id='.$actions->row->id,'创建下级'));
            $actions->append(new EditRow('/admin/categories/'.$actions->row->id));
            $actions->append(new DeleteRow('/admin/categories',$actions->row->id));
        });
        $grid->disablePagination();
        $grid->disableTools();
        $grid->disableExport();
        $grid->disableRowSelector();
        return $grid;
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
        if(Category::checkSite($id)){
            return $content
                ->header('分类管理')
                ->description(' ')
                ->body($this->form()->edit($id));
        }
        return redirect('admin/categories');
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
            ->header('分类管理')
            ->description(' ')
            ->body($this->form());
    }

    public function show($id)
    {
        return redirect('/admin/categories');
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());
        //$form->display('id', 'ID');
        $form->select('parent_id','上级分类')->default(request()->get('parent_id',0))->options(Category::selectOptions());
        $form->text('title','分类名称')->rules('required',['required'=>'名称不能为空']);
        $form->image('logo');
        $form->textarea('desc','分类描述')->default('');
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
        ];
        $form->switch('is_menu','导航显示')->default(1)->states($states);
        $form->number('order','导航排序')->default(10);
        $form->switch('is_index','首页显示')->states($states);
        $form->hidden('site_id')->default(config('site.site_id'));
        //$form->display('created_at', '创建时间');
        //$form->display('updated_at', '更新时间');
        $form->tools(function(Form\Tools $tools){
            $tools->disableView();
            $tools->disableDelete();
        });
        $form->footer(function(Form\Footer $footer){
            $footer->disableReset();
            $footer->disableViewCheck();
            //$footer->disableCreatingCheck();
            //$footer->disableEditingCheck();
        });
        return $form;
    }

    public function destroy($id)
    {
        if(Category::checkSite($id)){
            $data = [
                'status'  => true,
                'message' => trans('admin.delete_succeeded'),
            ];
            Category::deleteAndChild($id);
            Article::where('category_id',$id)->delete();
        }else{
            $data = [
                'status'  => false,
                'message' => '不存在或没有权限',
            ];
        }
        return response()->json($data);
    }
}
