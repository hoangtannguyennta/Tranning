<?php
namespace App\Repositories\PermissionRole;

use App\Repositories\BaseRepository;
use App\Models\PermissionRole;
use App\Models\Role;

class PermissionRoleRepository extends BaseRepository implements PermissionRoleRepositoryInterface
{
    public function getModel()
    {
        return PermissionRole::class;
    }

    public function getProduct()
    {
        return $this->model->get();
    }

    public function createProduct($params)
    {
        $roles = Role::find($params['role_id']);

        foreach ($params['permission_id'] as $value) {
            if (!$roles->permissions->contains($value)) {
                $roles->permissions()->attach($value);
            }
        }
    }

    public function updateProduct($params, $id)
    {
        $roles = Role::find($id);
        $roles->permissions()->sync($params['permission_id']);
    }
}
