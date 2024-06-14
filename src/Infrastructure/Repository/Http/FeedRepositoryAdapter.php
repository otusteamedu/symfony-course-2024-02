<?php

namespace App\Infrastructure\Repository\Http;

use App\Domain\Repository\FeedRepositoryInterface;

class FeedRepositoryAdapter implements FeedRepositoryInterface
{
    public function __construct(private readonly FeedClient $feedClient)
    {
    }

    public function getFeed(int $userId, int $count): array
    {
        return $this->feedClient->getFeed($userId, $count);
    }
}
