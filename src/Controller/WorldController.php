<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WorldController extends AbstractController
{
    public function __construct(private readonly UserManager $userManager)
    {
    }

    public function hello(): Response
    {
        $user = $this->userManager->updateUserLogin(1, 'My new user');
        [$data, $code] = $user === null ? [null, Response::HTTP_NOT_FOUND] : [$user->toArray(), Response::HTTP_OK];

        return $this->json($data, $code);
    }
}
