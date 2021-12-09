<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDateTimeFormatter, HasDatabase, HasDomains;

    protected $table = 'tenants';

    protected $guarded = [];

}
