<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Permission\PermissionRepositoryInterface;

class PermissionController extends Controller
{
    /**
     * @var PermissionRepositoryInterface|\App\Repositories\Repository
     */
    protected $permissionRepo;

    public function __construct(PermissionRepositoryInterface $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    public function index()
    {
        $data = [
            'permissions' => $this->permissionRepo->getProduct(),
        ];
        return view('permission.list', $data);
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $this->permissionRepo->createProduct($request->all());

        return redirect()->route('permission.index')->with('success', '#');
    }

    public function edit($id)
    {
        $data = [
            'permissions' => $this->permissionRepo->edit($id),
        ];
        return view('permission.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->permissionRepo->updateProduct($request->all(), $id);

        return redirect()->route('permission.index')->with('success', '#');
    }

    public function destroy($id)
    {
        $this->permissionRepo->find($id)->delete();

        return redirect()->route('permission.index')->with('success', '#');
    }
}
