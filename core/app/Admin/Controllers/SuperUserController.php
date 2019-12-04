<?php

namespace App\Admin\Controllers;

use App\Site;
use App\AdminUser;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Auth\Database\Role;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;

class SuperUserController extends Controller
{
    use HasResourceActions;

    protected $header = '用户管理';

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header($this->header)
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
            ->header($this->header)
            ->description(' ')
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
            ->header($this->header)
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
        $grid = new Grid(new AdminUser());
        $grid->model()->where('id','>',1);
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->column(1/2,function($filter){
                $filter->equal('username','用户名');
                $filter->equal('name','名称');
            });
            $filter->column(1/2,function($filter){
                $filter->equal('site_id','管理站点')->select(Site::pluck('name','id'));
            });
        });
        if(request()->get('site_id')){
            $grid->model()->where('site_id',request()->get('site_id'));
        }
        $grid->id('ID')->sortable();
        $grid->username(trans('admin.username'));
        $grid->name(trans('admin.name'));
        $grid->roles(trans('admin.roles'))->pluck('name')->label();
        $grid->column('site.name','负责网站')->label();
        $grid->created_at(trans('admin.created_at'));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if ($actions->getKey() <3) {
                $actions->disableDelete();
            }
            $actions->disableView();
        });
        $grid->disableExport();
        $grid->tools(function (Grid\Tools $tools) {
            $tools->batch(function (Grid\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
        });
        $grid->disablePagination();
        return $grid;
    }

    public function form()
    {
        $userModel = config('admin.database.users_model');
        $form = new Form(new $userModel());
        $form->text('username', trans('admin.username'))->rules('required');
        $form->text('name', trans('admin.name'))->rules('required');
        $form->password('password', trans('admin.password'))->rules('required|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });
        $form->ignore(['password_confirmation']);
        $form->multipleSelect('roles', trans('admin.roles'))->options(Role::where('id','>',1)->pluck('name', 'id'));
        $form->select('site_id','管理网站')->options(Site::where('status',1)->pluck('name','id'));
        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
            $form->site_id or $form->site_id=0;
            $roles = $form->roles;
            $super_role_id = Role::where('slug','super')->value('id');
            if(in_array($super_role_id,$roles) || $form->model()->id==2){
                $form->roles= [$super_role_id];
            }else{
                $form->roles = [role::where('slug','admin')->value('id')];
            }
        });
        $form->tools(function(Form\Tools $tools){
            $tools->disableDelete();
            $tools->disableView();
        });
        $form->footer(function(Form\Footer $footer){
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
    //删除
    public function destroy($id)
    {
        if($id<3){
            $data = [
                'status'  => false,
                'message' => trans('admin.delete_failed'),
            ];
        }elseif ($this->form()->destroy($id)) {
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
