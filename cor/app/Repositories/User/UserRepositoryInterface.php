<?php
namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getProduct();
    public function createProduct($params);
    public function edit($id);
    public function updateProduct($params, $id);
}
