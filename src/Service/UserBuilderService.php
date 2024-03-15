<?php

namespace App\Service;

use App\Entity\User;
use App\Manager\TweetManager;
use App\Manager\UserManager;

class UserBuilderService
{
    public function __construct(
        private readonly TweetManager $tweetManager,
        private readonly UserManager $userManager,
    ) {
    }

    /**
     * @param string[] $texts
     */
    public function createUserWithTweets(string $login, array $texts): User
    {
        $user = $this->userManager->create($login);
        foreach ($texts as $text) {
            $this->tweetManager->postTweet($user, $text);
        }
        $userId = $user->getId();
        $this->userManager->clearEntityManager();

        return $this->userManager->findUser($userId);
    }
}
