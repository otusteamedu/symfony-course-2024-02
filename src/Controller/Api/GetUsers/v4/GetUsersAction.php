<?php

namespace App\Controller\Api\GetUsers\v4;

use App\Manager\UserManager;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

class GetUsersAction extends AbstractFOSRestController
{
    private const DEFAULT_PAGE = 0;
    private const DEFAULT_PER_PAGE = 20;

    public function __construct(private readonly UserManager $userManager)
    {
    }

    #[Rest\Get(path: '/api/v4/users.{format}', defaults: ['format' => 'json'])]
    public function __invoke(
        #[MapQueryParameter] ?int $perPage,
        #[MapQueryParameter] ?int $page,
        string $format
    ): Response
    {
        $users = $this->userManager->getUsers($page ?? self::DEFAULT_PAGE, $perPage ?? self::DEFAULT_PER_PAGE);
        $code = empty($users) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
        $context = (new Context())->setGroups(['video-user-info', 'user-id-list']);

        return $this->handleView(
            $this->view(['users' => $users], $code)->setContext($context)->setFormat($format),
        );
    }
}