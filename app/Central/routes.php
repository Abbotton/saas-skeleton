<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;
use Mosiboom\DcatIframeTab\Controllers\IframeController;

Admin::routes();

Route::group([
    'prefix'     => config('central.route.prefix'),
    'namespace'  => config('central.route.namespace'),
    'middleware' => config('central.route.middleware'),
], function (Router $router) {
    // 首页
    $router->get('/',  [IframeController::class, 'index']);
    // 仪表盘
    $router->get('/dashboard', 'HomeController@index');
    // 租户管理
    $router->resource('/tenant', 'TenantController');
    // 域名管理
    $router->resource('/domain', 'DomainController')->only(['index', 'destroy', 'show']);
});
