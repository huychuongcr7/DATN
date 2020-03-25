<?php

namespace App\Services;

interface CustomerServiceInterface
{
    public function createCustomer(array $param);
    public function updateCustomer(array $param, int $id);
}
