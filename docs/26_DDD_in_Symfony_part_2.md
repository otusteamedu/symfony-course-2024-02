# Symfony Messenger

Запускаем контейнеры командой `docker-compose up -d`

## Добавляем синхронную команду

1. Добавляем интерфейс `App\Domain\Repository\UserRepositoryInterface`
    ```php
    <?php
    
    namespace App\Domain\Repository;
    
    use App\Entity\User;
    
    interface UserRepositoryInterface
    {
        public function save(User $user): void;
    }
    ```
2. Добавляем класс `App\Domain\Command\CreateUser\CreateUserCommand`
    ```php
    <?php
    
    namespace App\Domain\Command\CreateUser;
    
    use App\Controller\Api\CreateUser\v5\Input\CreateUserDTO;
    use JMS\Serializer\Annotation as JMS;
    
    final class CreateUserCommand
    {
        private function __construct(
            private readonly string $login,
            private readonly string $password,
            /** @JMS\Type("array<string>") */
            private readonly array $roles,
            private readonly int $age,
            private readonly bool $isActive,
        ) {
        }
    
        public function getLogin(): string
        {
            return $this->login;
        }
    
        public function getPassword(): string
        {
            return $this->password;
        }
    
        public function getRoles(): array
        {
            return $this->roles;
        }
    
        public function getAge(): int
        {
            return $this->age;
        }
    
        public function isActive(): bool
        {
            return $this->isActive;
        }
    
        public static function createFromRequest(CreateUserDTO $request): self
        {
            return new self(
                $request->login,
                $request->password,
                $request->roles,
                $request->age,
                $request->isActive,
            );
        }
    }
    ```
3. Добавляем класс `App\Domain\Command\CreateUser\Handler`
    ```php
    <?php
    
    namespace App\Domain\Command\CreateUser;
    
    use App\Domain\Repository\UserRepositoryInterface;
    use App\Domain\ValueObject\UserLogin;
    use App\Entity\User;
    use Symfony\Component\Messenger\Attribute\AsMessageHandler;
    
    #[AsMessageHandler]
    class Handler
    {
        public function __construct(
            private readonly UserRepositoryInterface $userRepository,
        ) {
        }
    
        public function __invoke(CreateUserCommand $command): void
        {
            $user = new User();
            $user->setLogin(UserLogin::fromString($command->getLogin()));
            $user->setPassword($command->getPassword());
            $user->setRoles($command->getRoles());
            $user->setAge($command->getAge());
            $user->setIsActive($command->isActive());
            $this->userRepository->save($user);
        }
    }
    ```
4. Добавляем класс `App\Infrastructure\Repository\Doctrine\UserRepositoryAdapter`
    ```php
    <?php
    
    namespace App\Infrastructure\Repository\Doctrine;
    
    use App\Domain\Repository\UserRepositoryInterface;
    use App\Entity\User;
    use App\Manager\UserManager;
    
    class UserRepositoryAdapter implements UserRepositoryInterface
    {
        public function __construct(private readonly UserManager $manager)
        {
        }
    
        public function save(User $user): void
        {
            $this->manager->saveUser($user);
        }
    }
    ```
5. В файле `config/packages/messenger.yaml` исправляем секцию `messenger.routing`
    ```yaml
    App\DTO\AddFollowersDTO: add_followers
    FeedBundle\DTO\SendNotificationDTO: doctrine
    App\DTO\SendNotificationAsyncDTO: send_notification
    App\Domain\Command\CreateUser\CreateUserCommand: sync
    ```
6. Исправляем класс `App\Controller\Api\CreateUser\v5\CreateUserAction`
    ```php
    <?php
    
    namespace App\Controller\Api\CreateUser\v5;
    
    use App\Controller\Api\CreateUser\v5\Input\CreateUserDTO;
    use App\Controller\Api\CreateUser\v5\Output\UserIsCreatedDTO;
    use App\Controller\Common\ErrorResponseTrait;
    use App\Domain\Command\CreateUser\CreateUserCommand;
    use FOS\RestBundle\Controller\AbstractFOSRestController;
    use FOS\RestBundle\Controller\Annotations as Rest;
    use Nelmio\ApiDocBundle\Annotation\Model;
    use OpenApi\Annotations as OA;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
    use Symfony\Component\Messenger\MessageBusInterface;
    
    class CreateUserAction extends AbstractFOSRestController
    {
        use ErrorResponseTrait;
    
        public function __construct(private readonly MessageBusInterface $messageBus)
        {
        }
    
        #[Rest\Post(path: '/api/v5/users')]
        /**
         * @OA\Post(
         *     operationId="addUser",
         *     tags={"Пользователи"},
         *     @OA\RequestBody(
         *         description="Input data format",
         *         @OA\JsonContent(ref=@Model(type=CreateUserDTO::class))
         *     ),
         *     @OA\Response(
         *         response=200,
         *         description="Success",
         *         @OA\JsonContent(ref=@Model(type=UserIsCreatedDTO::class))
         *     )
         * )
         */
        public function saveUserAction(#[MapRequestPayload] CreateUserDTO $request): Response
        {
            $this->messageBus->dispatch(CreateUserCommand::createFromRequest($request));
            
            return $this->handleView($this->view(['success' => true]));
        }
    }
    ```
7. В классе `config/services.yaml` убираем описание сервиса `App\Controller\Api\CreateUser\v5\CreateUserAction`
8. Выполняем запрос Add user v5 из Postman-коллекции v10. Видим успешный ответ, проверяем, что запись в БД создалась.

## Возвращаем ответ от команды

1. В классе `\App\Controller\Api\CreateUser\v5\CreateUserAction` исправляем мето `saveUserAction`
    ```php
    public function saveUserAction(#[MapRequestPayload] CreateUserDTO $request): Response
    {
        $envelope = $this->messageBus->dispatch(CreateUserCommand::createFromRequest($request));
        /** @var HandledStamp|null $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);
        [$data, $code] = ($handledStamp?->getResult() === null) ? [['success' => false], 400] : [['userId' => $handledStamp?->getResult()], 200];

        return $this->handleView($this->view($data, $code));
    }
    ```
2. В классе `App\Domain\Command\CreateUser\Handler` исправляем метод `__invoke`
    ```php
    public function __invoke(CreateUserCommand $command): int
    {
        $user = new User();
        $user->setLogin(UserLogin::fromString($command->getLogin()));
        $user->setPassword($command->getPassword());
        $user->setRoles($command->getRoles());
        $user->setAge($command->getAge());
        $user->setIsActive($command->isActive());
        $this->userRepository->save($user);
        
        return $user->getId();
    }
    ```
3. Выполняем запрос Add user v5 из Postman-коллекции v10. Видим в ответе идентификатор пользователя и то, что запись в
   БД создалась.

### Делаем команду асинхронной

1. В файле `config/packages/messenger.yaml`
   1. Добавляем новый транспорт в секцию `messenger.transports`
        ```yaml
        create_user:
            dsn: "%env(MESSENGER_AMQP_TRANSPORT_DSN)%"
            options:
                exchange:
                    name: 'old_sound_rabbit_mq.create_user'
                    type: direct
        ```
   2. Исправляем секцию `messenger.routing`
        ```yaml
        App\DTO\AddFollowersDTO: add_followers
        FeedBundle\DTO\SendNotificationDTO: doctrine
        App\DTO\SendNotificationAsyncDTO: send_notification
        App\Domain\Command\CreateUser\CreateUserCommand: create_user
        ```
2. В файл `supervisor/consumer.conf` добавляем новую секцию
    ```ini
    [program:create_user]
    command=php /app/bin/console messenger:consume create_user --limit=1000 --env=dev -vv
    process_name=create_user_%(process_num)02d
    numprocs=1
    directory=/tmp
    autostart=true
    autorestart=true
    startsecs=3
    startretries=10
    user=www-data
    redirect_stderr=false
    stdout_logfile=/app/var/log/supervisor.create_user.out.log
    stdout_capture_maxbytes=1MB
    stderr_logfile=/app/var/log/supervisor.create_user.error.log
    stderr_capture_maxbytes=1MB
    ```
3. Перезапускаем контейнер супервизора командой `docker-compose restart supervisor`
4. Выполняем запрос Add user v5 из Postman-коллекции v10. Видим ответ `success: false`, но запись в БД создалась.

## Добавляем шину запросов

1. Добавляем класс `App\Application\QueryInterface`
    ```php
    <?php
    
    namespace App\Application;
    
    /**
     * @template T
     */
    interface QueryInterface
    {
    }
    ```
2. Добавляем класс `App\Application\QueryBusInterface`
    ```php
    <?php
    
    namespace App\Application;
    
    interface QueryBusInterface
    {
        /**
         * @template T
         *
         * @param QueryInterface<T> $query
         *
         * @return T
         */
        public function query(QueryInterface $query);
    }
    ```
3. Добавляем класс `App\Application\QueryBus`
    ```php
    <?php
    
    namespace App\Application;
    
    use Symfony\Component\Messenger\MessageBusInterface;
    use Symfony\Component\Messenger\Stamp\HandledStamp;
    
    class QueryBus implements QueryBusInterface
    {
        public function __construct(
            private readonly MessageBusInterface $baseQueryBus
        ) {
        }
    
        /**
         * @return mixed
         */
        public function query(QueryInterface $query)
        {
            $envelope = $this->baseQueryBus->dispatch($query);
            /** @var HandledStamp|null $handledStamp */
            $handledStamp = $envelope->last(HandledStamp::class);
            
            return $handledStamp?->getResult();
        }
    }
    ```
4. Добавляем класс `App\Domain\Query\GetFeed\GetFeedQuery`
    ```php
    <?php
    
    namespace App\Domain\Query\GetFeed;
    
    use App\Application\QueryInterface;

    /**
     * @implements QueryInterface<GetFeedQueryResult>
     */
    class GetFeedQuery implements QueryInterface
    {
        public function __construct(
            private readonly int $userId,
            private readonly int $count,
        ) {
        }
    
        public function getUserId(): int
        {
            return $this->userId;
        }
    
        public function getCount(): int
        {
            return $this->count;
        }
    }
    ```
5. Добавляем класс `App\Domain\Query\GetFeed\GetFeedQueryResult`
    ```php
    <?php
    
    namespace App\Domain\Query\GetFeed;
    
    use JMS\Serializer\Annotation as JMS;
    
    class GetFeedQueryResult
    {
        public function __construct(
           /** @JMS\Type("array") */
           private readonly array $tweets, 
        ) {
        }
    
        public function getTweets(): array
        {
            return $this->tweets;
        }
    
        public function isEmpty(): bool
        {
            return empty($this->tweets);
        }
    }
    ```
6. Добавляем интерфейс `App\Domain\Repository\FeedRepositoryInterface`
    ```php
    <?php
    
    namespace App\Domain\Repository;
    
    interface FeedRepositoryInterface
    {
        public function getFeed(int $userId, int $count): array;
    }
    ```
7. Добавляем класс `App\Infrastructure\Repository\Doctrine\FeedRepositoryAdapter`
    ```php
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
    ```
8. Добавляем класс `App\Domain\Query\GetFeed\Handler`
    ```php
    <?php
    
    namespace App\Domain\Query\GetFeed;
    
    use App\Domain\Repository\FeedRepositoryInterface;
    use Symfony\Component\Messenger\Attribute\AsMessageHandler;
    
    #[AsMessageHandler]
    class Handler
    {
        public function __construct(
            private readonly FeedRepositoryInterface $feedRepository,
        ) {
        }
    
        public function __invoke(GetFeedQuery $query): GetFeedQueryResult
        {
            return new GetFeedQueryResult(
                $this->feedRepository->getFeed($query->getUserId(), $query->getCount())
            );
        }
    }
    ```
9. Исправляем класс `App\Controller\Api\GetFeed\v1\Controller`
    ```php
    <?php
    
    namespace App\Controller\Api\GetFeed\v1;
    
    use App\Domain\Query\GetFeed\GetFeedQuery;
    use App\Domain\Query\GetFeed\GetFeedQueryResult;
    use App\Application\QueryBusInterface;
    use FOS\RestBundle\Controller\AbstractFOSRestController;
    use FOS\RestBundle\Controller\Annotations as Rest;
    use FOS\RestBundle\View\View;
    use Symfony\Component\HttpFoundation\Response;
    
    class Controller extends AbstractFOSRestController
    {
        /** @var int */
        private const DEFAULT_FEED_SIZE = 20;
    
        /**
         * @param QueryBusInterface<GetFeedQueryResult> $queryBus
         */
        public function __construct(
            private readonly QueryBusInterface $queryBus
        )
        {
        }
    
        #[Rest\Get('/api/v1/get-feed')]
        #[Rest\QueryParam(name: 'userId', requirements: '\d+')]
        #[Rest\QueryParam(name: 'count', requirements: '\d+', nullable: true)]
        public function getFeedAction(int $userId, ?int $count = null): View
        {
            $count = $count ?? self::DEFAULT_FEED_SIZE;
            $result = $this->queryBus->query(new GetFeedQuery($userId, $count));
    
            return View::create($result, $result->isEmpty() ? Response::HTTP_NO_CONTENT : Response::HTTP_OK);
        }
    }
    ```
10. Выполняем запрос Add followers из Postman-коллекции v10, чтобы получить подписчиков.
11. Выполняем запрос Post tweet из Postman-коллекции v10, дожидаемся обновления лент.
12. Выполняем запрос Get feed из Postman-коллекции v10 для любого подписчика, видим твит.
13. Выполняем запрос Get feed из Postman-коллекции v10 для автора, видим пустой ответ с кодом 204.

## Устанавливаем deptrac

1. Заходим в контейнер командой `docker exec -it php sh`. Дальнейшие команды выполняем из контейнера
2. Устанавливаем deptrac командой `composer require qossmic/deptrac-shim --dev`
3. Исправляем файл `deptrac.yaml`
    ```yaml
    parameters:
      paths:
        - ./src
      exclude_files: []
      layers:
        - name: Controller
          collectors:
            - type: className
              regex: ^App\\Controller\\GetFeed\\.*
        - name: Domain
          collectors:
            - type: className
              regex: ^App\\Domain\\.*
        - name: Infrastructure
          collectors:
            - type: className
              regex: ^App\\Service\\.*
        - name: External
          collectors:
            - type: className
              regex: ^FeedBundle\\.*
      ruleset:
        Controller:
          - Domain
          - Infrastructure
        Domain:
        Infrastructure:
          - Domain
        External:
    ```
4. Запускаем `deptrac` командой `vendor/bin/deptrac --clear-cache`, видим 2 ошибки

### Исправляем зависимости

1. Переносим класс `App\Client\FeedClient` в пространство имён `App\Infrastructure\Repository\Http`
2. Переносим класс `App\Infrastructure\Repository\Doctrine\FeedRepositoryAdapter` в пространство имён
`App\Infrastructure\Repository\Http` и исправляем
    ```php
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
    ```
3. Запускаем `deptrac` командой `vendor/bin/deptrac --clear-cache`, видим, что ошибки исправлены
