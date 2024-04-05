<?php

namespace App\Controller\Api\v3;

use App\DTO\ManageUserDTO;
use App\Entity\User;
use App\Manager\UserManager;
use App\Security\Voter\UserVoter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

#[Route(path: 'api/v3/user')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly UserManager $userManager,
        private readonly AuthorizationCheckerInterface $authorizationChecker,
    )
    {
    }

    #[Route(path: '', methods: ['POST'])]
    public function saveUserAction(Request $request): Response
    {
        $saveUserDTO = ManageUserDTO::fromRequest($request);
        $userId = $this->userManager->saveUserFromDTO(new User(), $saveUserDTO);
        [$data, $code] = $userId === null ?
            [['success' => false], Response::HTTP_BAD_REQUEST] :
            [['success' => true, 'userId' => $userId], Response::HTTP_OK];

        return new JsonResponse($data, $code);
    }

    #[Route(path: '', methods: ['GET'])]
    public function getUsersAction(Request $request): Response
    {
        $perPage = $request->query->get('perPage');
        $page = $request->query->get('page');
        $users = $this->userManager->getUsers($page ?? 0, $perPage ?? 20);
        $code = empty($users) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;

        return new JsonResponse(['users' => array_map(static fn(User $user) => $user->toArray(), $users)], $code);
    }

    #[Route(path: '', methods: ['DELETE'])]
    public function deleteUserAction(Request $request): Response
    {
        $userId = $request->query->get('userId');
        $user = $this->userManager->findUser($userId);
        if (!$this->authorizationChecker->isGranted(UserVoter::DELETE, $user)) {
            return new JsonResponse('Access denied', Response::HTTP_FORBIDDEN);
        }
        $result = $this->userManager->deleteUserById($userId);

        return new JsonResponse(['success' => $result], $result ? Response::HTTP_OK : Response::HTTP_NOT_FOUND);
    }

    #[Route(path: '', methods: ['PATCH'])]
    public function updateUserAction(Request $request): Response
    {
        $userId = $request->query->get('userId');
        $login = $request->request->get('login');
        $result = $this->userManager->updateUserLogin($userId, $login);

        return new JsonResponse(['success' => $result], $result ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}