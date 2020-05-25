<?php

namespace App\Services;

interface BillServiceInterface
{
    public function createBill(array $param);
    public function updateBill(array $param, int $id);
    public function deleteBill(int $id);
    public function createBillCustomer(array $param);
    public function completeBill(int $id);
}
