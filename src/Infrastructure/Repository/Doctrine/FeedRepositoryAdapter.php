<?php

namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\Repository\FeedRepositoryInterface;
use FeedBundle\Service\FeedService;

class FeedRepositoryAdapter implements FeedRepositoryInterface
{
    public function __construct(private readonly FeedService $feedService)
    {
    }

    public function getFeed(int $userId, int $count): array
    {
        return $this->feedService->getFeed($userId, $count);
    }
}
