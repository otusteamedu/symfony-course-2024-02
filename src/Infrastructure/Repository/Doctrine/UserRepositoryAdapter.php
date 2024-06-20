<?php

namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\Repository\UserRepositoryInterface;
use App\Entity\User;
use App\Manager\UserManager;

class UserRepositoryAdapter implements UserRepositoryInterface
{
    public function __construct(private readonly UserManager $manager)
    {
    }

    public function save(User $user): void
    {
        $this->manager->saveUser($user);
    }
}
