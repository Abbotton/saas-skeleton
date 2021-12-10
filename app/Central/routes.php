<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('central.route.prefix'),
    'namespace'  => config('central.route.namespace'),
    'middleware' => config('central.route.middleware'),
], function (Router $router) {
    // 首页
    $router->get('/', 'HomeController@index');
    // 租户管理
    $router->resource('/tenant', 'TenantController');
    // 域名管理
    $router->resource('/domain', 'DomainController')->only(['index', 'destroy', 'show']);
});
