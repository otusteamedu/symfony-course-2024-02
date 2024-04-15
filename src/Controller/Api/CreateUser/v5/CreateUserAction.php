<?php

namespace App\Controller\Api\CreateUser\v5;

use App\Controller\Api\CreateUser\v5\Input\CreateUserDTO;
use App\Controller\Common\ErrorResponseTrait;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class CreateUserAction extends AbstractFOSRestController
{
    use ErrorResponseTrait;

    public function __construct(private readonly CreateUserManagerInterface $saveUserManager)
    {
    }

    #[Rest\Post(path: '/api/v5/users')]
    public function saveUserAction(#[MapRequestPayload] CreateUserDTO $request): Response
    {
        $user = $this->saveUserManager->saveUser($request);
        [$data, $code] = ($user->id === null) ? [['success' => false], 400] : [['user' => $user], 200];

        return $this->handleView($this->view($data, $code));
    }
}
