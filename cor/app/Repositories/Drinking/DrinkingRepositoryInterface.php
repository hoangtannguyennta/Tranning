<?php
namespace App\Repositories\Drinking;

use App\Repositories\RepositoryInterface;

interface DrinkingRepositoryInterface extends RepositoryInterface
{
    public function getProduct();

    public function createDrinking($params);
}
