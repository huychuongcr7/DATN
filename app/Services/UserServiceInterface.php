<?php

namespace App\Services;

interface UserServiceInterface
{
    public function createUser(array $param);
    public function updateUser(array $param, int $id);
}
