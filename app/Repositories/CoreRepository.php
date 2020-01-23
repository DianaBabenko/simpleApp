<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 *
 * @package App\Repositories
 *
 * Can't create or change
 */
abstract class CoreRepository {
    /**
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct() {
        $this->model = app($this->getModelClass());
    }

    /**
     * @retur mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model\Illuminate\Foundation\Application\mixed
     */
    protected function startConditions() {
        return clone $this->model;
    }
}
