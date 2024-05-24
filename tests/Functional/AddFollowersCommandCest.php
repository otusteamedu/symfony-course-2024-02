<?php

namespace IntegrationTests;

use App\Entity\User;
use App\Tests\Support\FunctionalTester;
use Codeception\Example;
use UnitTests\Fixtures\MultipleUsersFixture;

class AddFollowersCommandCest
{
    private const COMMAND = 'followers:add';

    public function executeDataProvider(): array
    {
        return [
            'positive' => ['followersCount' => 20, 'expected' => "20 followers were created\n", 'exitCode' => 0],
            'zero' => ['followersCount' => 0, 'expected' => "0 followers were created\n", 'exitCode' => 0],
            'default' => ['followersCount' => null, 'expected' => "10 followers were created\n", 'exitCode' => 0],
            'negative' => ['followersCount' => -1, 'expected' => "Count should be positive integer\n", 'exitCode' => 1],
        ];
    }

    /**
     * @dataProvider executeDataProvider
     */
    public function testExecuteReturnsResult(FunctionalTester $I, Example $example): void
    {
        /** @var User $author */
        $author = $I->have(User::class);
        $params = ['authorId' => $author->getId()];
        $inputs = $example['followersCount'] === null ? ["\n"] : [$example['followersCount']."\n"];
        $output = $I->runSymfonyConsoleCommand(self::COMMAND, $params, $inputs, $example['exitCode']);
        $I->assertStringEndsWith($example['expected'], $output);
    }
}