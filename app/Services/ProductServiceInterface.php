<?php

namespace App\Services;

interface ProductServiceInterface
{
    public function createProduct(array $param);
    public function updateProduct(array $param, int $id);
}
