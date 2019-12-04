<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    //超级管理
    $router->resource('superUsers','SuperUserController');
    //站点管理
    $router->resource('sites','SiteController');
    //模板添加
    $router->resource('templates','TemplateController');
    //文章管理、、、
    $router->group(['middleware'=>'check.site'],function(Router $router){
        //基本设置
        $router->resource('configs','ConfigController');
        $router->resource('categories','CategoryController');
        $router->resource('articles','ArticleController');
        $router->resource('adminUsers','AdminUserController');
    });
});
