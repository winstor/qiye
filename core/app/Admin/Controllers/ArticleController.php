<?php

namespace App\Admin\Controllers;


use App\Article;
use App\Category;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use App\Admin\Extensions\Grid\Article\SelectChange;
use App\Admin\Extensions\Grid\Article\CreateButton;

class ArticleController extends Controller
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
            ->header('文章管理')
            ->description(' ')
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
        if(Article::checkSite($id)){
            return $content
                ->header('文章管理 ')
                ->description(' ')
                ->body($this->form()->edit($id));
        }
        return redirect('/admin/articles');
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
            ->header('文章管理')
            ->description(' ')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article);
        $grid->model()->where('site_id',config('site.site_id'));
        if(request()->get('category_id')){
            $grid->model()->where('category_id',request()->get('category_id'));
        }
        //$grid->id('ID');
        $grid->column('title','&nbsp;&nbsp;文章名称')->display(function($title){
            $str = '<span style="color: red">[%s]</span>';
            if($this->is_top){
                $title.=sprintf($str,'顶');
            }
            if($this->is_hot){
                $title.=sprintf($str,'荐');
            }
            if($this->is_img && $this->img){
                $title.=sprintf($str,'图');
            }
            return '&nbsp;&nbsp;&nbsp;&nbsp;'.$title;
        });
        $grid->column('category.title','分类');
        $grid->hits('浏览');
        $grid->updated_at('更新时间');
        $grid->actions(function(Grid\Displayers\Actions $actions){
            $actions->disableView();
        });
        $grid->disableExport();
        //$grid->disableCreateButton();
        $grid->tools(function (Grid\Tools $tools) {
            $tools->disableRefreshButton();
            $tools->disableFilterButton();
            $tools->batch(function (Grid\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
            //$tools->append(new CreateButton('新增','category_id'));
            $tools->append(new SelectChange(Category::selectTree(),'category_id'));
        });
        $grid->disableRowSelector();
        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article);
        $states = [
            'on'  => ['value' => 1, 'text' => '启用', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
        ];
        $form->text('title', '标题')->rules('required',['required'=>'标题不能为空']);
        $form->text('keywords', '关键字')->default('');
        $form->select('category_id','上级分类')->default(request()->get('category_id'))->options(Category::selectTree())
            ->rules('required',['required'=>'分类不能为空']);
        $form->hidden('site_id')->default(config('site.site_id'));
        $form->hidden('from', '外部链接')->default('');
        $form->number('hits', '浏览次数')->default(1);
        $form->textarea('note', '摘要');
        $form->editor('content', '内容');
        $form->image('img', '缩略图');
        $form->switch('is_img', '使用缩略图')->default(0)->states($states);
        $form->switch('is_top', '置顶')->states($states);
        $form->switch('is_hot', '推荐')->states($states);
        $form->datetime('updated_at','更新时间');
        $form->datetime('created_at','发布时间');
        //$form->text('author', '作者');
        $form->tools(function(Form\Tools $tools){
            $tools->disableDelete();
            $tools->disableView();
        });
        $form->footer(function(Form\Footer $footer){
            $footer->disableReset();
            $footer->disableViewCheck();
        });
        return $form;
    }
    //删除
    public function destroy($id)
    {

        if (Article::checkSite($id) && $this->form()->destroy($id)) {
            $data = [
                'status'  => true,
                'message' => trans('admin.delete_succeeded'),
            ];
        } else {
            $data = [
                'status'  => false,
                'message' => trans('admin.delete_failed'),
            ];
        }

        return response()->json($data);
    }
}
