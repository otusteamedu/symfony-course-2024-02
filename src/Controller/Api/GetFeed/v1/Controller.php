<?php

namespace App\Controller\Api\GetFeed\v1;

use FeedBundle\Facade\FeedFacade;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use OpenApi\Attributes as OA;
use Symfony\Component\Routing\Attribute\Route;

class Controller extends AbstractFOSRestController
{
    /** @var int */
    private const DEFAULT_FEED_SIZE = 20;

    public function __construct(private readonly FeedFacade $feedFacade)
    {
    }

    #[Route(path: '/api/v1/get-feed', methods: ['GET'])]
    #[OA\Get(
        operationId: 'getFeed',
        tags: ['Лента'],
        parameters: [
            new OA\Parameter(
                name: 'userId',
                description: 'ID пользователя',
                in: 'query',
                example: '135',
            ),
            new OA\Parameter(
                name: 'count',
                description: 'Количество на странице',
                in: 'query',
                example: '1',
            ),
        ]
    )]
    #[Rest\QueryParam(name: 'userId', requirements: '\d+')]
    #[Rest\QueryParam(name: 'count', requirements: '\d+', nullable: true)]
    public function getFeedAction(int $userId, ?int $count = null): View
    {
        $count = $count ?? self::DEFAULT_FEED_SIZE;
        $tweets = $this->feedFacade->getFeed($userId, $count);
        $code = empty($tweets) ? 204 : 200;

        return View::create(['tweets' => $tweets], $code);
    }
}
