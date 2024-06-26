﻿# Symfony Messenger

## Установка Symfony Messenger

1. Исправляем файл `docker/Dockerfile`
    ```dockerfile
    FROM php:8.2-fpm-alpine
    
    # Install dev dependencies
    RUN apk update \
        && apk upgrade --available \
        && apk add --virtual build-deps \
            autoconf \
            build-base \
            icu-dev \
            libevent-dev \
            openssl-dev \
            zlib-dev \
            libzip \
            libzip-dev \
            zlib \
            zlib-dev \
            bzip2 \
            git \
            libpng \
            libpng-dev \
            libjpeg \
            libjpeg-turbo-dev \
            libwebp-dev \
            freetype \
            freetype-dev \
            postgresql-dev \
            curl \
            wget \
            bash \
            libmemcached-dev \
            rabbitmq-c \
            rabbitmq-c-dev \
            linux-headers
    
    # Install Composer
    RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
    
    # Install PHP extensions
    RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
    RUN docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) \
        intl \
        gd \
        bcmath \
        pdo_pgsql \
        sockets \
        zip \
        pcntl
    RUN pecl channel-update pecl.php.net \
        && pecl install -o -f \
            redis \
            event \
            memcached \
            amqp \
        && rm -rf /tmp/pear \
        && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
        && echo "extension=event.so" > /usr/local/etc/php/conf.d/event.ini \
        && echo "extension=memcached.so" > /usr/local/etc/php/conf.d/memcached.ini \
        && echo "extension=amqp.so" > /usr/local/etc/php/conf.d/amqp.ini
    ```
2. Исправляем файл `docker/supervisor/Dockerfile`
    ```dockerfile
    FROM php:8.2-fpm-alpine

    # Install dev dependencies
    RUN apk update \
        && apk upgrade --available \
        && apk add --virtual build-deps \
            autoconf \
            build-base \
            icu-dev \
            libevent-dev \
            openssl-dev \
            zlib-dev \
            libzip \
            libzip-dev \
            zlib \
            zlib-dev \
            bzip2 \
            git \
            libpng \
            libpng-dev \
            libjpeg \
            libjpeg-turbo-dev \
            libwebp-dev \
            freetype \
            freetype-dev \
            postgresql-dev \
            curl \
            wget \
            bash \
            libmemcached-dev \
            rabbitmq-c \
            rabbitmq-c-dev \
            linux-headers
    
    # Install Composer
    RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
    
    # Install PHP extensions
    RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
    RUN docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) \
        intl \
        gd \
        bcmath \
        pdo_pgsql \
        sockets \
        zip \
        pcntl
    RUN pecl channel-update pecl.php.net \
        && pecl install -o -f \
            redis \
            event \
            memcached \
            amqp \
        && rm -rf /tmp/pear \
        && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
        && echo "extension=event.so" > /usr/local/etc/php/conf.d/event.ini \
        && echo "extension=memcached.so" > /usr/local/etc/php/conf.d/memcached.ini \
        && echo "extension=amqp.so" > /usr/local/etc/php/conf.d/amqp.ini
    
    RUN apk add supervisor && mkdir /var/log/supervisor
    ```
3. Запускаем контейнеры командой `docker-compose up -d --build`
4. Заходим в контейнер командой `docker exec -it php sh`. Дальнейшие команды выполняются из контейнера
5. Устанавливаем пакеты `symfony/messenger`, `symfony/doctrine-messenger` и `symfony/amqp-messenger`
6. В файле `.env` раскомментируем и исправляем переменные с DSN для транспорта
    ```shell
    MESSENGER_DOCTRINE_TRANSPORT_DSN=doctrine://default
    MESSENGER_AMQP_TRANSPORT_DSN=amqp://user:password@rabbit-mq:5672/%2f/messages
    ```
7. В файле `config/packages/messenger.yaml` исправляем секцию `messenger.transports`
    ```yaml
    doctrine:
        dsn: "%env(MESSENGER_DOCTRINE_TRANSPORT_DSN)%"
    amqp:
        dsn: "%env(MESSENGER_AMQP_TRANSPORT_DSN)%"
    sync: 'sync://'    
    ``` 

## Отправляем сообщение через Symfony Messenger

1. Исправляем класс `App\Controller\Api\AddFollowers\v1\Controller`
    ```php
    <?php
    
    namespace App\Controller\Api\AddFollowers\v1;
    
    use App\DTO\AddFollowersDTO;
    use App\Manager\UserManager;
    use App\Service\SubscriptionService;
    use FOS\RestBundle\Controller\AbstractFOSRestController;
    use FOS\RestBundle\Controller\Annotations as Rest;
    use FOS\RestBundle\Controller\Annotations\RequestParam;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Messenger\MessageBusInterface;
    
    class Controller extends AbstractFOSRestController
    {
        private SubscriptionService $subscriptionService;
    
        private UserManager $userManager;
    
        private MessageBusInterface $messageBus;
    
        public function __construct(SubscriptionService $subscriptionService, UserManager $userManager, MessageBusInterface $messageBus)
        {
            $this->subscriptionService = $subscriptionService;
            $this->userManager = $userManager;
            $this->messageBus = $messageBus;
        }
    
        #[Rest\Post(path: '/api/v1/add-followers')]
        #[RequestParam(name: 'userId', requirements: '\d+')]
        #[RequestParam(name: 'followersLogin')]
        #[RequestParam(name: 'count', requirements: '\d+')]
        #[RequestParam(name: 'async', requirements: '0|1')]
        public function addFollowersAction(int $userId, string $followersLogin, int $count, int $async): Response
        {
            $user = $this->userManager->findUser($userId);
            if ($user !== null) {
                if ($async === 0) {
                    $createdFollowers = $this->subscriptionService->addFollowers($user, $followersLogin, $count);
                    $view = $this->view(['created' => $createdFollowers], 200);
                } else {
                    for ($i = 0; $i < $count; $i++) {
                        $this->messageBus->dispatch(new AddFollowersDTO($user->getId(), "$followersLogin #$i", 1));
                    }
                    $view = $this->view(['success' => true], 200);
                }
            } else {
                $view = $this->view(['success' => false], 404);
            }
    
            return $this->handleView($view);
        }
    }
    ```
2. В файле `config/packages/messenger.yaml`
   1. исправляем секцию `messenger.transports.amqp`
       ```yaml
       dsn: "%env(MESSENGER_AMQP_TRANSPORT_DSN)%"
       options:
           exchange:
               name: 'old_sound_rabbit_mq.add_followers'
               type: direct
       ```
   2. исправляем секцию `messenger.routing`
       ```yaml
       App\DTO\AddFollowersDTO: amqp
       ```
3. Выполняем запрос Add followers из Postman-коллекции v10 с параметром async = 1. Проверяем, в интерфейсе RabbitMQ, что
сообщения попали в очередь, однако пользователи в БД не появились.
4. В интерфейсе RabbitMQ в очереди `messages` можем просмотреть сообщения и увидеть, что они сериализуются как пустые
массивы.

## Исправляем сериализацию сообщения

1. В файле `config/packages/messenger.yaml` исправляем секцию `messenger.transports.amqp`
    ```yaml
    amqp:
        dsn: "%env(MESSENGER_AMQP_TRANSPORT_DSN)%"
        options:
            exchange:
                name: 'old_sound_rabbit_mq.add_followers'
                type: direct
        serializer: 'messenger.transport.symfony_serializer'
    ```
2. Исправляем класс `App\DTO\AddFollowersDTO`
    ```php
    <?php
    
    namespace App\DTO;
    
    use JsonException;
    use Symfony\Component\Serializer\Annotation\Ignore;
    
    class AddFollowersDTO
    {
        #[Ignore]
        private array $payload;
    
        private int $userId;
    
        private string $followerLogin;
    
        private int $count;
    
        public function __construct(int $userId, string $followerLogin, int $count)
        {
            $this->payload = ['userId' => $userId, 'followerLogin' => $followerLogin, 'count' => $count];
            $this->userId = $userId;
            $this->followerLogin = $followerLogin;
            $this->count = $count;
        }
    
        /**
         * @throws JsonException
         */
        public function toAMQPMessage(): string
        {
            return json_encode($this->payload, JSON_THROW_ON_ERROR);
        }
    
        public function getUserId(): int
        {
            return $this->userId;
        }
    
        public function getFollowerLogin(): string
        {
            return $this->followerLogin;
        }
    
        public function getCount(): int
        {
            return $this->count;
        }
    }
    ```
3. Ещё раз выполняем запрос Add followers из Postman-коллекции v10 с параметром async = 1. Видим, что пользователи
добавились в БД.

## Отправляем сообщение с routingKey

1. Исправляем класс `FeedBundle\Consumer\UpdateFeed\Consumer`
    ```php
    <?php
    
    namespace FeedBundle\Consumer\UpdateFeed;
    
   use Doctrine\ORM\EntityManagerInterface;
   use StatsdBundle\Client\StatsdAPIClient;
   use FeedBundle\Consumer\UpdateFeed\Input\Message;
   use FeedBundle\DTO\SendNotificationDTO;
   use FeedBundle\Service\FeedService;
   use JsonException;
   use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
   use PhpAmqpLib\Message\AMQPMessage;
   use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
   use Symfony\Component\Messenger\Envelope;
   use Symfony\Component\Messenger\MessageBusInterface;
   use Symfony\Component\Validator\Validator\ValidatorInterface;
    
    class Consumer implements ConsumerInterface
    {
        public function __construct(
            private readonly EntityManagerInterface $entityManager,
            private readonly ValidatorInterface $validator,
            private readonly FeedService $feedService,
            private readonly MessageBusInterface $messageBus,
            private readonly StatsdAPIClient $statsdAPIClient,
            private readonly string $key,
        )
        {
        }
    
        public function execute(AMQPMessage $msg): int
        {
            try {
                $message = Message::createFromQueue($msg->getBody());
                $errors = $this->validator->validate($message);
                if ($errors->count() > 0) {
                    return $this->reject((string)$errors);
                }
            } catch (JsonException $e) {
                return $this->reject($e->getMessage());
            }
    
            $tweetDTO = $message->getTweetDTO();

            $this->feedService->putTweet($tweetDTO, $message->getFollowerId());
            $notificationMessage = (new SendNotificationDTO($message->getFollowerId(), $tweetDTO->getText()));
            $this->messageBus->dispatch(new Envelope($notificationMessage, [new AmqpStamp($message->getPreferred())]));
    
            $this->statsdAPIClient->increment($this->key);
            $this->entityManager->clear();
            $this->entityManager->getConnection()->close();
    
            return self::MSG_ACK;
        }
    
        private function reject(string $error): int
        {
            echo "Incorrect message: $error";
    
            return self::MSG_REJECT;
        }
    }
    ```
2. Исправляем класс `FeedBundle\DTO\SendNotificationDTO`
    ```php
    <?php
    
    namespace FeedBundle\DTO;
    
    use JsonException;
    use Symfony\Component\Serializer\Annotation\Ignore;
    
    class SendNotificationDTO
    {
        #[Ignore]
        private array $payload;
        
        private int $userId;
        
        private string $text;
    
        public function __construct(int $userId, string $text)
        {
            $this->payload = ['userId' => $userId, 'text' => $text];
            $this->userId = $userId;
            $this->text = $text;
        }
    
        /**
         * @throws JsonException
         */
        public function toAMQPMessage(): string
        {
            return json_encode($this->payload, JSON_THROW_ON_ERROR);
        }
    
        public function getUserId(): int
        {
            return $this->userId;
        }
    
        public function getText(): string
        {
            return $this->text;
        }
    }
    ```
3. В файле `config/packages/messenger.yaml`
   1. исправляем секцию `messenger.transports`
       ```yaml
       doctrine:
           dsn: "%env(MESSENGER_DOCTRINE_TRANSPORT_DSN)%"
       add_followers:
           dsn: "%env(MESSENGER_AMQP_TRANSPORT_DSN)%"
           options:
               exchange:
                   name: 'old_sound_rabbit_mq.add_followers'
                   type: direct
           serializer: 'messenger.transport.symfony_serializer'
       send_notification:
           dsn: "%env(MESSENGER_AMQP_TRANSPORT_DSN)%"
           options:
               exchange:
                   name: 'old_sound_rabbit_mq.send_notification'
                   type: topic
           serializer: 'messenger.transport.symfony_serializer'
       sync: 'sync://'
       ```
   2. исправляем секцию `messenger.routing`
       ```yaml
       App\DTO\AddFollowersDTO: add_followers
       FeedBundle\DTO\SendNotificationDTO: send_notification
       ```
4. Пересобираем и перезапускаем контейнеры командами
    ```shell
    docker-compose stop
    docker-compose up -d --build
    ```
5. Выполняем запрос Post tweet из Postman-коллекции v10 с параметром async = 1. Видим, что уведомления добавились в БД.

## Имитируем проблему с отправкой сообщения

1. В классе `FeedBundle\Consumer\UpdateFeed\Consumer` исправляем метод `execute`
    ```php
    public function execute(AMQPMessage $msg): int
    {
        try {
            $message = Message::createFromQueue($msg->getBody());
            $errors = $this->validator->validate($message);
            if ($errors->count() > 0) {
                return $this->reject((string)$errors);
            }
        } catch (JsonException $e) {
            return $this->reject($e->getMessage());
        }

        $tweetDTO = $message->getTweetDTO();

        try {
            $this->feedService->putTweet($tweetDTO, $message->getFollowerId());
            if ($message->getFollowerId() === 5) {
                sleep(2);
                throw new Exception();
            }
            $notificationMessage = (new SendNotificationDTO($message->getFollowerId(), $tweetDTO->getText()));
            $this->messageBus->dispatch(new Envelope($notificationMessage, [new AmqpStamp($message->getPreferred())]));
        } catch (Throwable $e) {
            return self::MSG_REJECT_REQUEUE;
        }

        $this->statsdAPIClient->increment($this->key);
        $this->entityManager->clear();
        $this->entityManager->getConnection()->close();

        return self::MSG_ACK;
    }
    ```
2. Перезапускаем контейнер supervisor командой `docker-compose restart supervisor`
3. Выполняем запрос Post tweet из Postman-коллекции v10 с параметром async = 1. Видим, что лента для пользователя с id=5
растёт, но уведомления не отправляются.

## Добавляем транзакционную отправку сообщения

1. Исправляем класс `FeedBundle\DTO\SendNotificationDTO`
    ```php
    <?php
    
    namespace FeedBundle\DTO;
    
    class SendNotificationDTO
    {
        private int $userId;
    
        private string $text;
    
        private string $preferred;
    
        public function __construct(int $userId, string $text, string $preferred)
        {
            $this->userId = $userId;
            $this->text = $text;
            $this->preferred = $preferred;
        }
    
        public function getUserId(): int
        {
            return $this->userId;
        }
    
        public function getText(): string
        {
            return $this->text;
        }
    
        public function getPreferred(): string
        {
            return $this->preferred;
        }
    }
    ```
2. В классе `FeedBundle\Consumer\UpdateFeed\Consumer` исправляем метод `execute`
    ```php
    public function execute(AMQPMessage $msg): int
    {
        try {
            $message = Message::createFromQueue($msg->getBody());
            $errors = $this->validator->validate($message);
            if ($errors->count() > 0) {
                return $this->reject((string)$errors);
            }
        } catch (JsonException $e) {
            return $this->reject($e->getMessage());
        }

        $tweetDTO = $message->getTweetDTO();

        try {
            $this->entityManager->getConnection()->beginTransaction();
            $this->feedService->putTweet($tweetDTO, $message->getFollowerId());
            if ($message->getFollowerId() === 5) {
                sleep(2);
                throw new Exception();
            }
            $notificationMessage = (new SendNotificationDTO($message->getFollowerId(), $tweetDTO->getText(), $message->getPreferred()));
            $this->messageBus->dispatch($notificationMessage);
            $this->entityManager->getConnection()->commit();
        } catch (Throwable $e) {
            $this->entityManager->getConnection()->rollBack();
            return self::MSG_REJECT_REQUEUE;
        }

        $this->statsdAPIClient->increment($this->key);
        $this->entityManager->clear();
        $this->entityManager->getConnection()->close();

        return self::MSG_ACK;
    }
    ```
3. В файле `config/packages/messenger.yaml`
   1. исправляем секцию `messenger.transports.doctrine`
       ```yaml
       doctrine:
           dsn: "%env(MESSENGER_DOCTRINE_TRANSPORT_DSN)%"
           serializer: 'messenger.transport.symfony_serializer'
       ```
   2. исправляем секцию `messenger.routing`
       ```yaml
       App\DTO\AddFollowersDTO: add_followers
       FeedBundle\DTO\SendNotificationDTO: doctrine
       ```
4. Очищаем очередь, в которой "зависли" сообщения
5. Перезапускаем контейнер supervisor командой `docker-compose restart supervisor`
6. Выполняем запрос Post tweet из Postman-коллекции v10 с параметром async = 1. Видим, что лента для пользователя с id=5
   больше не растёт, и уведомления не отправляются.

## Добавляем обработчик

1. Добавляем класс `App\DTO\SendNotificationAsyncDTO`
    ```php
    <?php
    
    namespace App\DTO;
    
    class SendNotificationAsyncDTO
    {
        private int $userId;
    
        private string $text;
    
        public function __construct(int $userId, string $text)
        {
            $this->userId = $userId;
            $this->text = $text;
        }
    
        public function getUserId(): int
        {
            return $this->userId;
        }
    
        public function getText(): string
        {
            return $this->text;
        }
    }
    ```
2. В файле `config/packages/messenger.yaml`
   1. исправляем секцию `messenger.routing`
       ```yaml
       App\DTO\AddFollowersDTO: add_followers
       FeedBundle\DTO\SendNotificationDTO: doctrine
       App\DTO\SendNotificationAsyncDTO: send_notification
       ```
   2. добавляем секцию `messenger.buses`
       ```yaml
       buses:
           messenger.bus.default:
               middleware:
                    - doctrine_ping_connection
                    - doctrine_close_connection
                    - doctrine_transaction
       ```
3. Добавляем класс `FeedBundle\MessageHandler\SendNotification\Handler`
    ```php
    <?php
    
    namespace FeedBundle\MessageHandler\SendNotification;
    
    use App\DTO\SendNotificationAsyncDTO;
    use FeedBundle\DTO\SendNotificationDTO;
    use Symfony\Component\Messenger\Attribute\AsMessageHandler;
    use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
    use Symfony\Component\Messenger\Envelope;
    use Symfony\Component\Messenger\MessageBusInterface;
    
    #[AsMessageHandler]
    class Handler
    {
        private MessageBusInterface $messageBus;
    
        public function __construct(MessageBusInterface $messageBus)
        {
            $this->messageBus = $messageBus;
        }
    
        public function __invoke(SendNotificationDTO $message): void
        {
            $envelope = new Envelope(
                new SendNotificationAsyncDTO($message->getUserId(), $message->getText()),
                [new AmqpStamp($message->getPreferred())]
            );
            $this->messageBus->dispatch($envelope);
        }
    }
    ```
4. В файл `supervisor/consumer.conf` добавляем новый процесс
    ```ini
    [program:messenger_doctrine]
    command=php /app/bin/console messenger:consume doctrine --limit=1000 --env=dev -vv
    process_name=messenger_doctrine_%(process_num)02d
    numprocs=1
    directory=/tmp
    autostart=true
    autorestart=true
    startsecs=3
    startretries=10
    user=www-data
    redirect_stderr=false
    stdout_logfile=/app/var/log/supervisor.messenger_doctrine.out.log
    stdout_capture_maxbytes=1MB
    stderr_logfile=/app/var/log/supervisor.messenger_doctrine.error.log
    stderr_capture_maxbytes=1MB
    ```
5. Перезапускаем контейнер supervisor командой `docker-compose restart supervisor`
6. Видим, что очередь в БД разобралась, и сообщения ушли в RabbitMQ и там обработались. 
