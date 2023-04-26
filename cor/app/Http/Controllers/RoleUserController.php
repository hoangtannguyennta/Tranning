<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User;

class RoleUserController extends Controller
{
    /**
     * @var RoleRepositoryInterface|\App\Repositories\Repository
     */
    protected $permissionRoleRepo;
    protected $permissionRepo;
    protected $roleRepo;

    public function __construct(
        RoleRepositoryInterface $roleRepo
    )
    {
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $data = [
            'roles' => $this->roleRepo->getProduct(),
        ];
        return view('role.list', $data);
    }
}
