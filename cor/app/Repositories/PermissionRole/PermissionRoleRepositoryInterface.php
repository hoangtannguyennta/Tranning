<?php
namespace App\Repositories\PermissionRole;

use App\Repositories\RepositoryInterface;

interface PermissionRoleRepositoryInterface extends RepositoryInterface
{
    public function getProduct();
    public function createProduct($params);
    public function updateProduct($params, $id);
}
