<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

app('view')->prependNamespace('admin', resource_path('views/admin'));
Encore\Admin\Form::forget(['map', 'editor']);
Encore\Admin\Form::extend('editor',\App\Admin\Extensions\Ueditor::class);
Encore\Admin\Form::extend('wangEditor',\App\Admin\Extensions\Form\WangEditor::class);