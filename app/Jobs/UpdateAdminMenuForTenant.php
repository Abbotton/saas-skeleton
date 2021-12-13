<?php

namespace App\Jobs;

use Dcat\Admin\Models\Menu;
use Stancl\Tenancy\Contracts\Tenant;

class UpdateAdminMenuForTenant
{
    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function handle()
    {
        $this->tenant->run(function ($tenant) {
            // 更新首页URL
            Menu::where('id', 1)->update(['uri' => '/dashboard']);
        });
    }
}