<?php

namespace App\Domain\Command\CreateUser;

use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\UserLogin;
use App\Entity\User;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class Handler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function __invoke(CreateUserCommand $command): int
    {
        $user = new User();
        $user->setLogin(UserLogin::fromString($command->getLogin()));
        $user->setPassword($command->getPassword());
        $user->setRoles($command->getRoles());
        $user->setAge($command->getAge());
        $user->setIsActive($command->isActive());
        $this->userRepository->save($user);

        return $user->getId();
    }
}
