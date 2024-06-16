<?php

namespace App\Repository;

use App\Models\User;

class AuthRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
