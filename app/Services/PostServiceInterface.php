<?php

namespace App\Services;

interface PostServiceInterface
{
    public function createPost(array $param);
    public function updatePost(array $param, int $id);
}
