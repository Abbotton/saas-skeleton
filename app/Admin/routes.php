<?php

use App\Features\UserImpersonation;
use Dcat\Admin\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\ScopeSessions;
use Stancl\Tenancy\Middleware\CheckTenantForMaintenanceMode;

Admin::routes();

/**
 * 超级管理员可以通过此路由进入租户后台.
 */
Route::middleware([
    'web',
    CheckTenantForMaintenanceMode::class,
    ScopeSessions::class,
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])
    ->prefix(config('admin.route.prefix'))
    ->group(function (Router $router) {
        $router->get('/god/{token}', function ($token) {
            return UserImpersonation::makeResponse($token);
        });
    });

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    // 仪表盘
    $router->get('/dashboard', 'HomeController@index');

});
