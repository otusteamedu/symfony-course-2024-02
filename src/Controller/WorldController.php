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
        /** @var User $user */
        $user = $this->userManager->findUser(1);
        $this->userManager->updateUserLoginWithQueryBuilder($user->getId(), 'User is updated');

        return $this->json($user->toArray());
    }
}
