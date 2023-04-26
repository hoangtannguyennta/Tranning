<?php
namespace App\Repositories\Role;

use App\Repositories\BaseRepository;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function getModel()
    {
        return Role::class;
    }

    public function getProduct()
    {
        return $this->model->get();
    }

    public function createProduct($params)
    {
        $role = $this->model->create($params->all());
        $role->permissions()->attach($params->permission_id);
    }

    public function edit($params)
    {
        return $this->model->find($params);
    }

    public function updateProduct($params, $id)
    {
        $role = $this->model->find($id);
        $role->update($params->all());
        $role->permissions()->sync($params->permission_id);
    }
}
