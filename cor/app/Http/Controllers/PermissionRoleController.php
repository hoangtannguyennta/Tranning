<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PermissionRole\PermissionRoleRepositoryInterface;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;

class PermissionRoleController extends Controller
{
    /**
     * @var PermissionRoleRepositoryInterface|\App\Repositories\Repository
     * @var PermissionRepositoryInterface|\App\Repositories\Repository
     * @var RoleRepositoryInterface|\App\Repositories\Repository
     */
    protected $permissionRoleRepo;
    protected $permissionRepo;
    protected $roleRepo;

    public function __construct(
        PermissionRoleRepositoryInterface $permissionRoleRepo,
        PermissionRepositoryInterface $permissionRepo,
        RoleRepositoryInterface $roleRepo
    )
    {
        $this->permissionRoleRepo = $permissionRoleRepo;
        $this->permissionRepo = $permissionRepo;
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $data = [
            'roles' => $this->roleRepo->getProduct(),
        ];
        return view('permissionrole.list', $data);
    }

    public function create()
    {
        $data = [
            'roles' => $this->roleRepo->getProduct(),
            'permissions' => $this->permissionRepo->getProduct(),
        ];
        return view('permissionrole.create', $data);
    }

    public function store(Request $request)
    {
        $this->permissionRoleRepo->createProduct($request->all());

        return redirect()->route('permissionRole.index')->with('success', '#');
    }

    public function edit($id)
    {
        $role = $this->roleRepo->find($id);
        $data = [
            'permission_array' => $role->permissions->pluck('id')->toArray(),
            'roles_id' => $role,
            'roles' => $this->roleRepo->getProduct(),
            'permissions' => $this->permissionRepo->getProduct(),
        ];
        return view('permissionrole.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->permissionRoleRepo->updateProduct($request->all(), $id);

        return redirect()->route('permissionRole.index')->with('success', '#');
    }

    public function destroy($id)
    {
        $role = $this->roleRepo->find($id);
        $role->permissions()->detach();

        return redirect()->route('permissionRole.index')->with('success', '#');
    }
}
