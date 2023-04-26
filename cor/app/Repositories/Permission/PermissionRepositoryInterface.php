<?php
namespace App\Repositories\Permission;

use App\Repositories\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface
{
    public function getProduct();
    public function createProduct($params);
    public function edit($id);
    public function updateProduct($params, $id);
}
