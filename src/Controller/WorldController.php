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
        $userId = $user->getId();
        $this->userManager->updateUserLoginWithQueryBuilder($userId, 'User is updated #2');
        $this->userManager->clearEntityManager();
        $user = $this->userManager->findUser($userId);

        return $this->json($user->toArray());
    }
}
