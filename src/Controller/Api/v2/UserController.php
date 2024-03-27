<?php

namespace App\Controller\Api\v2;

use App\Entity\User;
use App\Manager\UserManager;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: 'api/v2/user')]
class UserController extends AbstractController
{
    private const DEFAULT_PAGE = 0;
    private const DEFAULT_PER_PAGE = 20;

    public function __construct(private readonly UserManager $userManager)
    {
    }

    #[Route(path: '', methods: ['POST'])]
    public function saveUserAction(Request $request): Response
    {
        $login = $request->request->get('login');
        $user = $this->userManager->create($login);
        [$data, $code] = $user->getId() === null ?
            [['success' => false], Response::HTTP_BAD_REQUEST] :
            [['success' => true, 'userId' => $user->getId()], Response::HTTP_OK];

        return new JsonResponse($data, $code);
    }

    #[Route(path: '', methods: ['GET'])]
    public function getUsersAction(Request $request): Response
    {
        $perPage = $request->request->get('perPage');
        $page = $request->request->get('page');
        $users = $this->userManager->getUsers($page ?? self::DEFAULT_PAGE, $perPage ?? self::DEFAULT_PER_PAGE);
        $code = empty($users) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;

        return new JsonResponse(['users' => array_map(static fn(User $user) => $user->toArray(), $users)], $code);
    }

    #[Route(path: '/by-login/{userLogin}', methods: ['GET'], priority: 2)]
    public function getUserByLoginAction(#[MapEntity(mapping: ['userLogin' => 'login'])] User $user): Response
    {
        return new JsonResponse(['user' => $user->toArray()], Response::HTTP_OK);
    }

    #[Route(path: '/{userId}', requirements: ['userId' => '\d+'], methods: ['DELETE'])]
    public function deleteUserAction(#[MapEntity(id: 'userId')] User $user): Response
    {
        $result = $this->userManager->deleteUser($user);

        return new JsonResponse(['success' => $result], $result ? Response::HTTP_OK : Response::HTTP_NOT_FOUND);
    }

    #[Route(path: '/{userId}', methods: ['PATCH'])]
    public function updateUserAction(#[MapEntity(expr: 'repository.find(userId)')] User $user, Request $request): Response
    {
        $login = $request->query->get('login');
        $this->userManager->updateUserLogin($user, $login);

        return new JsonResponse(['user' => $user->toArray()], Response::HTTP_OK);
    }
}
