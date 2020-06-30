<?php

namespace App\Services;

interface CheckInventoryServiceInterface
{
    public function createCheckInventory(array $param);
    public function updateCheckInventory(array $param, int $id);
    public function deleteCheckInventory(int $id);
}
