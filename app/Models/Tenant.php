<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\MaintenanceMode;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDateTimeFormatter, HasDatabase, HasDomains, MaintenanceMode;

    protected $table = 'tenants';

    protected $guarded = [];

    /**
     * 自定义列.
     *
     * @return string[]
     */
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'expired_at'
        ];
    }
}
