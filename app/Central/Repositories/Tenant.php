<?php

namespace App\Central\Repositories;

use App\Models\Tenant as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Tenant extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
