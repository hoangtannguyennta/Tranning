<?php
namespace App\Repositories\Role;

use App\Repositories\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface
{
    public function getProduct();
    public function createProduct($params);
    public function edit($id);
    public function updateProduct($params, $id);
}
