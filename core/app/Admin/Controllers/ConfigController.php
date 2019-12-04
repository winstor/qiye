<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\Config;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Encore\Admin\Controllers\HasResourceActions;
use Illuminate\Support\MessageBag;

class ConfigController extends Controller
{
    use HasResourceActions;
    protected $config_data =['web'=>'网站设置'];
    protected $siteData =[];
    protected $site_id;
    protected $images = ['logo','favicon'];
    public function index()
    {
        return redirect('/admin/configs/web/edit');
    }
    public function edit($type, Content $content)
    {
        $config = Config::getConfig(config('site.site_id'),$type,true);
        return $content
            ->header('设置')
            ->description("setting up")
            ->row($this->form()->edit($config->id));
    }

    protected function form()
    {
        $form = new Form(new Config());
        $form->setView('admin.config.form');
        $form->tab('基本配置',function(Form $form){
            $form->text('title', '网站名称')->default('');
            $form->text('title2', '首页副标题')->default('');
            $form->text('keywords','关键字');
            $form->text('description','网站描述');
            $form->url('icp', '备案序号');
            $form->wangEditor('lx', '联系方式');
            $form->number('per_page', '文章分页数')->min(1)->default(15);
        })->tab('图标logo',function(Form $form){
            $form->image('logo', 'logo');
            $form->file('favicon', 'icon');
        })->tab('邮件发送配置',function(Form $form){
            $form->text('jsonData.MAIL_SMTP_SERVER', '邮件服务器SMTP地址');
            $form->text('jsonData.MAIL_PORT', '邮件服务器SMTP端口');
            $form->text('jsonData.MAIL_FROM', '邮件地址');
            $form->text('jsonData.MAIL_PASSSWORD', '邮件密码');
        });
        $form->hidden('data');
        //禁用右上角
        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
        });
        //禁用下面按钮
        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        //保存前回调
        $form->saving(function (Form $form) {
            if($form->jsonData){
                $form->data = collect($form->jsonData)->filter()->all();
            }
        });
        //保存后回调
        $form->saved(function (Form $form) {
            // ajax but not pjax
            if (request()->ajax() && !request()->pjax()){
                return response()->json([
                    'status'  => true,
                    'message' => '操作成功',
                ]);
            }else{
                //admin_toastr(trans('admin.save_succeeded'));
                //return redirect('/admin/configs/web/edit');
                $success = new MessageBag([
                    'title'   => '更新配置成功！',
                ]);
                return back()->with(compact('success'));
            }
        });
        return $form;
    }
}
