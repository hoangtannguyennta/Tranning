<?php
namespace App\Repositories\RoleUser;

use App\Repositories\BaseRepository;
use App\Models\RoleUser;
use App\Models\Role;

class RoleUserRepository extends BaseRepository implements RoleUserRepositoryInterface
{
    public function getModel()
    {
        return RoleUser::class;
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
