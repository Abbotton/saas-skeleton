<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckTenantIsExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:expire_check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '检查租户是否已过期';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Tenant::whereDate('expired_at', '<', Carbon::now())
            ->get()
            ->runForEach(function ($item) {
                $item->putDownForMaintenance(['message' => '账号状态已过期']);
            });
    }
}
