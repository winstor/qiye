<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\Http\Controllers\Controller;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class AdminUserController extends Controller
{
    use HasResourceActions;

    protected $header = '管理员';
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
        $admin = AdminUser::find($id);
        if(!$admin || $admin->isRole('super')){
            return redirect('/admin');
        }
        return $content
            ->header($this->header)
            ->description(' ')
            ->body($this->beforeForm()->edit($id));
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
            ->body($this->beforeForm());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AdminUser());
        $grid->model()->where('id','>',2)->where('level',3)->where('site_id',config('site.site_id',0));
        $grid->model()->whereHas('roles',function($query){
            $query->where('slug','<>','super');
        });
        $grid->id('ID')->sortable();
        $grid->username(trans('admin.username'));
        $grid->name(trans('admin.name'));
        $grid->created_at(trans('admin.created_at'));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });
        $grid->disableExport();
        $grid->tools(function (Grid\Tools $tools) {
            $tools->batch(function (Grid\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
        });
        $grid->disableFilter();
        $grid->disablePagination();
        return $grid;
    }
    public function beforeForm()
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
        $form->hidden('roles[]')->default(Role::where('slug','admin')->value('id'));
        $form->hidden('site_id')->default(config('site.site_id'));
        $form->hidden('level')->default(3);
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

    public function form()
    {
        $form = $this->beforeForm();
        $form->multipleSelect('roles', trans('admin.roles'))->options(Role::where('slug','admin')->pluck('name', 'id'));
        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
            if($form->model()->isRole('super')){
                return redirect('/admin');
            }
            $form->level=3;
            $form->site_id=config('site.site_id',0);
            $form->roles = [Role::where('slug','admin')->value('id')];
        });
        return $form;
    }
    public function destroy($id)
    {
        $user = AdminUser::find($id);
        $site_id= config('site.site_id');
        if ($user->site_id==$site_id && !$user->inRoles(['super','administrator']) && $this->form()->destroy($id)) {
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
