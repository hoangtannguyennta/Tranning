<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Permission\PermissionRepositoryInterface;

class RoleController extends Controller
{
    /**
     * @var RoleRepositoryInterface|\App\Repositories\Repository
     * @var PermissionRoleRepositoryInterface|\App\Repositories\Repository
     */
    protected $roleRepo;
    protected $permissionRepo;

    public function __construct(
        RoleRepositoryInterface $roleRepo,
        PermissionRepositoryInterface $permissionRepo,
    )
    {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }

    public function index()
    {
        $data = [
            'roles' => $this->roleRepo->getProduct(),
        ];
        return view('role.list', $data);
    }

    public function create()
    {
        $data = [
            'permissions' => $this->permissionRepo->getProduct(),
        ];
        return view('role.create', $data);
    }

    public function store(Request $request)
    {
        $this->roleRepo->createProduct($request);

        return redirect()->route('role.index')->with('success', '#');
    }

    public function edit($id)
    {
        $role = $this->roleRepo->edit($id);
        $data = [
            'permission_array' => $role->permissions->pluck('id')->toArray(),
            'role' => $role,
            'permissions' => $this->permissionRepo->getProduct(),
        ];
        return view('role.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->roleRepo->updateProduct($request, $id);

        return redirect()->route('role.index')->with('success', '#');
    }

    public function destroy($id)
    {
        $this->roleRepo->find($id)->delete();

        return redirect()->route('role.index')->with('success', '#');
    }

    public function destroyAttach($id)
    {
        $role = $this->roleRepo->find($id);
        $role->permissions()->detach();

        return redirect()->route('role.index')->with('success', '#');
    }
}
