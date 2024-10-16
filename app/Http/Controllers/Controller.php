<?php

namespace App\Http\Controllers;

use App\Repository\BaseRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected BaseRepository $model;

    public function __construct(BaseRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->limit(3);
    }

    public function show($id)
    {
        return $this->model->find($id); // Find a record by ID
    }

    public function store(array $data)
    {
        return $this->model->create($data); // Create a new record
    }

    public function update(array $data, $id)
    {
        return $this->model->update($data, $id); // Update the record
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }
}
