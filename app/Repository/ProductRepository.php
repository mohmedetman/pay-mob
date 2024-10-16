<?php

namespace App\Repository;

use App\Models\User;

class ProductRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    public function index () {
        return $this->model->limit(3)->get();
    }

}
