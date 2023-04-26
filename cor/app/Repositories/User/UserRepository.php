<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getProduct()
    {
        return $this->model->get();
    }

    public function createProduct($params)
    {
        return $this->model->create($params);
    }

    public function edit($params)
    {
        return $this->model->find($params);
    }

    public function updateProduct($params, $id)
    {
        $data = $this->model->find($id);
        return $data->update($params);
    }
}
