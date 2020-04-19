<?php

namespace App\Services;

interface ImportOrderServiceInterface
{
    public function createImportOrder(array $param);
    public function updateImportOrder(array $param, int $id);
    public function deleteImportOrder(int $id);
}
