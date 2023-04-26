<?php
namespace App\Repositories\Permission;

use App\Repositories\BaseRepository;
use App\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function getModel()
    {
        return Permission::class;
    }

    public function getProduct()
    {
        return $this->model->get(['id', 'name', 'display_name']);
    }

    public function createProduct($params)
    {
        return $this->model->create($params);
    }

    public function edit($params)
    {
        return $this->model->find($params);
    }

    public function updateProduct($params, $id)
    {
        $data = $this->model->find($id);
        return $data->update($params);
    }
}
