<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Dcat\Admin\Models\Menu;
use Illuminate\Console\Command;

class SaasInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'saas:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SAAS后台初始化';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $createdAt = Carbon::now();
        Menu::insert([
            [
                'parent_id' => 0,
                'order' => 8,
                'title' => '租户管理',
                'icon' => 'fa-cube',
                'uri' => '/tenant',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 9,
                'title' => '域名管理',
                'icon' => 'fa-internet-explorer',
                'uri' => '/domain',
                'created_at' => $createdAt,
            ]
        ]);
        // 更新首页URL
        Menu::where('id', 1)->update(['uri' => '/dashboard']);
    }
}
