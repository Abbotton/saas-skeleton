<?php

namespace App\Central\Repositories;

use App\Models\Domain as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Domain extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
