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
        $arrays = array();
        foreach ($params->permission_id as $key => $value) {
            foreach ($value as $value2) {
                array_push($arrays, ['menu_id' => $key, 'permission_id' => $value2]);
            }
        }

        $role = $this->model->create($params->all());
        $role->rolesMenu()->attach($arrays);
    }

    public function edit($params)
    {
        return $this->model->with('rolesMenu')->find($params);
    }

    public function updateProduct($params, $id)
    {
        $role = $this->model->find($id);
        $role->update($params->all());
        $role->permissions()->sync($params->permission_id);
    }
}
