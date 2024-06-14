<?php

namespace App\Domain\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
}
