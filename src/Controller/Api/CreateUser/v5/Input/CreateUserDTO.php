<?php

namespace App\Controller\Api\CreateUser\v5\Input;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDTO
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(max: 32)]
    public string $login;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(max: 32)]
    public string $password;

    #[Assert\NotBlank]
    #[Assert\Type('array')]
    public array $roles;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    public int $age;

    #[Assert\NotBlank]
    #[Assert\Type('bool')]
    public bool $isActive;

    public function getSafeFields(): array
    {
        return ['login', 'password', 'roles', 'age', 'isActive'];
    }
}
