<?php
namespace App\Repositories\RoleUser;

use App\Repositories\RepositoryInterface;

interface RoleUserRepositoryInterface extends RepositoryInterface
{
    public function getProduct();
    public function createProduct($params);
    public function updateProduct($params, $id);
}
