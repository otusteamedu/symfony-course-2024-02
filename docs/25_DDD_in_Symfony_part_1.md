# DDD в Symfony, часть 1

Запускаем контейнеры командой `docker-compose up -d`

### Делаем XML-маппинг

1. В файле `config/packages/doctrine.yaml` исправляем секцию `doctrine.orm.mappings.App`
    ```yaml
    App:
        type: xml
        is_bundle: false
        dir: '%kernel.project_dir%/src/Service/Orm/Mapping'
        prefix: 'App\Entity'
        alias: App
    ```
2. Добавляем файл `src/Service/Orm/Mapping/EmailNotification.orm.xml`
    ```xml
    <doctrine-mapping
            xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping
                            https://www.doctrine-project.org/schemas/orm/doctrine-mapping.xsd"
    >
        <entity name="App\Entity\EmailNotification" table="email_notification">
            <id name="id" type="bigint">
                <generator strategy="IDENTITY" />
            </id>
            <field name="email" type="string" length="128" nullable="false" />
            <field name="text" type="string" length="128" nullable="false" />
            <field name="createdAt" type="datetime" nullable="false" />
            <field name="updatedAt" type="datetime" nullable="false" />
    
            <lifecycle-callbacks>
                <lifecycle-callback type="prePersist" method="setCreatedAt"/>
                <lifecycle-callback type="prePersist" method="setUpdatedAt"/>
                <lifecycle-callback type="preUpdate" method="setUpdatedAt"/>
            </lifecycle-callbacks>
    
        </entity>
    </doctrine-mapping>
    ```
3. Исправляем класс `App\Entity\EmailNotification`
    ```php
    <?php
    
    namespace App\Entity;
    
    use DateTime;
    
    class EmailNotification
    {
        private int $id;
    
        private string $email;
    
        private string $text;
    
        private DateTime $createdAt;
    
        private DateTime $updatedAt;
    
        public function getId(): int
        {
            return $this->id;
        }
    
        public function setId(int $id): void
        {
            $this->id = $id;
        }
    
        public function getEmail(): string
        {
            return $this->email;
        }
    
        public function setEmail(string $email): void
        {
            $this->email = $email;
        }
    
        public function getText(): string
        {
            return $this->text;
        }
    
        public function setText(string $text): void
        {
            $this->text = $text;
        }
    
        public function getCreatedAt(): DateTime {
            return $this->createdAt;
        }
    
        public function setCreatedAt(): void {
            $this->createdAt = new DateTime();
        }
    
        public function getUpdatedAt(): DateTime {
            return $this->updatedAt;
        }
    
        public function setUpdatedAt(): void {
            $this->updatedAt = new DateTime();
        }
    }
    ```
4. Добавляем файл `src/Service/Orm/Mapping/SmsNotification.orm.xml`
    ```xml
    <doctrine-mapping
            xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping
                            https://www.doctrine-project.org/schemas/orm/doctrine-mapping.xsd"
    >
        <entity name="App\Entity\SmsNotification" table="sms_notification">
            <id name="id" type="bigint">
                <generator strategy="IDENTITY" />
            </id>
            <field name="phone" type="string" length="11" nullable="false" />
            <field name="text" type="string" length="60" nullable="false" />
            <field name="createdAt" type="datetime" nullable="false" />
            <field name="updatedAt" type="datetime" nullable="false" />
    
            <lifecycle-callbacks>
                <lifecycle-callback type="prePersist" method="setCreatedAt"/>
                <lifecycle-callback type="prePersist" method="setUpdatedAt"/>
                <lifecycle-callback type="preUpdate" method="setUpdatedAt"/>
            </lifecycle-callbacks>
    
        </entity>
    </doctrine-mapping>
    ``` 
5. Исправляем класс `App\Entity\SmsNotification`
    ```php
    <?php
    
    namespace App\Entity;
    
    use DateTime;
    
    class SmsNotification
    {
        private int $id;
    
        private string $phone;
    
        private string $text;
    
        private DateTime $createdAt;
    
        private DateTime $updatedAt;
    
        public function getId(): int
        {
            return $this->id;
        }
    
        public function setId(int $id): void
        {
            $this->id = $id;
        }
    
        public function getPhone(): string
        {
            return $this->phone;
        }
    
        public function setPhone(string $phone): void
        {
            $this->phone = $phone;
        }
    
        public function getText(): string
        {
            return $this->text;
        }
    
        public function setText(string $text): void
        {
            $this->text = $text;
        }
    
        public function getCreatedAt(): DateTime {
            return $this->createdAt;
        }
    
        public function setCreatedAt(): void {
            $this->createdAt = new DateTime();
        }
    
        public function getUpdatedAt(): DateTime {
            return $this->updatedAt;
        }
    
        public function setUpdatedAt(): void {
            $this->updatedAt = new DateTime();
        }
    }
    ```
6. Добавляем файл `src/Service/Orm/Mapping/Subscription.orm.xml`
    ```xml
    <doctrine-mapping
    xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping
    https://www.doctrine-project.org/schemas/orm/doctrine-mapping.xsd"
    >
        <entity name="App\Entity\Subscription" table="subscription">
            <id name="id" type="bigint">
                <generator strategy="IDENTITY" />
            </id>
            <many-to-one field="author" inversed-by="subscriptionFollowers" target-entity="App\Entity\User">
                <join-column name="author_id" referenced-column-name="id" />
            </many-to-one>
            <many-to-one field="follower" inversed-by="subscriptionAuthors" target-entity="App\Entity\User">
                <join-column name="follower_id" referenced-column-name="id" />
            </many-to-one>
            <field name="createdAt" type="datetime" nullable="false" />
            <field name="updatedAt" type="datetime" nullable="false" />
    
            <indexes>
                <index name="subscription__author_id__ind" columns="author_id"/>
                <index name="subscription__follower_id__ind" columns="follower_id"/>
            </indexes>
    
            <lifecycle-callbacks>
                <lifecycle-callback type="prePersist" method="setCreatedAt"/>
                <lifecycle-callback type="prePersist" method="setUpdatedAt"/>
                <lifecycle-callback type="preUpdate" method="setUpdatedAt"/>
            </lifecycle-callbacks>
    
        </entity>
    </doctrine-mapping>
    ```
7. Исправляем класс `App\Entity\Subscription`
    ```php
    <?php
    
    namespace App\Entity;
    
    use DateTime;
    
    class Subscription
    {
        private int $id;
    
        private User $author;
    
        private User $follower;
    
        private DateTime $createdAt;
    
        private DateTime $updatedAt;
    
        public function getId(): int
        {
            return $this->id;
        }
    
        public function setId(int $id): void
        {
            $this->id = $id;
        }
    
        public function getAuthor(): User
        {
            return $this->author;
        }
    
        public function setAuthor(User $author): void
        {
            $this->author = $author;
        }
    
        public function getFollower(): User
        {
            return $this->follower;
        }
    
        public function setFollower(User $follower): void
        {
            $this->follower = $follower;
        }
    
        public function getCreatedAt(): DateTime {
            return $this->createdAt;
        }
    
        public function setCreatedAt(): void {
            $this->createdAt = new DateTime();
        }
    
        public function getUpdatedAt(): DateTime {
            return $this->updatedAt;
        }
    
        public function setUpdatedAt(): void {
            $this->updatedAt = new DateTime();
        }
    }
    ```
8. Добавляем файл `src/Service/Orm/Mapping/Tweet.orm.xml`
    ```xml
    <doctrine-mapping
            xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping
                            https://www.doctrine-project.org/schemas/orm/doctrine-mapping.xsd"
    >
        <entity name="App\Entity\Tweet" table="tweet" repository-class="App\Repository\TweetRepository">
            <id name="id" type="bigint">
                <generator strategy="IDENTITY" />
            </id>
            <many-to-one field="author" inversed-by="tweets" target-entity="App\Entity\User">
                <join-column name="author_id" referenced-column-name="id" />
            </many-to-one>
            <field name="text" type="string" length="140" nullable="false" />
            <field name="createdAt" type="datetime" nullable="false" />
            <field name="updatedAt" type="datetime" nullable="false" />
    
            <indexes>
                <index name="tweet__author_id__ind" columns="author_id"/>
            </indexes>
    
            <lifecycle-callbacks>
                <lifecycle-callback type="prePersist" method="setCreatedAt"/>
                <lifecycle-callback type="prePersist" method="setUpdatedAt"/>
                <lifecycle-callback type="preUpdate" method="setUpdatedAt"/>
            </lifecycle-callbacks>
    
        </entity>
    </doctrine-mapping>
    ```
9. Исправляем класс `App\Entity\Tweet`
    ```php
    <?php
    
    namespace App\Entity;
    
    use DateTime;
    use JMS\Serializer\Annotation as JMS;
    use JsonException;
    
    class Tweet
    {
        private ?int $id = null;
    
        #[JMS\Groups(['elastica'])]
        private User $author;
    
        #[JMS\Groups(['elastica'])]
        private string $text;
    
        private DateTime $createdAt;
    
        private DateTime $updatedAt;
    
        public function getId(): int
        {
            return $this->id;
        }
    
        public function setId(int $id): void
        {
            $this->id = $id;
        }
    
        public function getAuthor(): User
        {
            return $this->author;
        }
    
        public function setAuthor(User $author): void
        {
            $this->author = $author;
        }
    
        public function getText(): string
        {
            return $this->text;
        }
    
        public function setText(string $text): void
        {
            $this->text = $text;
        }
    
        public function getCreatedAt(): DateTime {
            return $this->createdAt;
        }
    
        public function setCreatedAt(): void {
            $this->createdAt = DateTime::createFromFormat('U', (string)time());
        }
    
        public function getUpdatedAt(): DateTime {
            return $this->updatedAt;
        }
    
        public function setUpdatedAt(): void {
            $this->updatedAt = new DateTime();
        }
    
        public function toArray(): array
        {
            return [
                'id' => $this->id,
                'login' => $this->author->getLogin(),
                'text' => $this->text,
                'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
                'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            ];
        }
    
        public function toFeed(): array
        {
            return [
                'id' => $this->id,
                'author' => isset($this->author) ? $this->author->getLogin() : null,
                'text' => $this->text,
                'createdAt' => isset($this->createdAt) ? $this->createdAt->format('Y-m-d h:i:s') : '',
            ];
        }
    
        /**
         * @throws JsonException
         */
        public function toAMPQMessage(): string
        {
            return json_encode(['tweetId' => $this->id], JSON_THROW_ON_ERROR);
        }
    }
    ```
10. Добавляем файл `src/Service/Orm/Mapping/User.orm.xml`
    ```xml
    <doctrine-mapping
            xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping
                            https://www.doctrine-project.org/schemas/orm/doctrine-mapping.xsd"
    >
        <entity name="App\Entity\User" table="`user`" repository-class="App\Repository\UserRepository">
            <id name="id" type="bigint">
                <generator strategy="IDENTITY" />
            </id>
            <field name="login" type="string" length="32" nullable="false" unique="true"/>
            <field name="password" type="string" length="120" nullable="false" />
            <field name="age" type="integer" nullable="false" />
            <field name="isActive" type="boolean" nullable="false" />
            <field name="createdAt" type="datetime" nullable="false" />
            <field name="updatedAt" type="datetime" nullable="false" />
            <one-to-many field="tweets" mapped-by="author" target-entity="App\Entity\Tweet" />
            <many-to-many field="authors" mapped-by="followers" target-entity="App\Entity\User" />
            <many-to-many field="followers" inversed-by="authors" target-entity="App\Entity\User">
                <join-table name="author_follower">
                    <join-columns>
                        <join-column name="author_id" referenced-column-name="id"/>
                    </join-columns>
                    <inverse-join-columns>
                        <join-column name="follower_id" referenced-column-name="id"/>
                    </inverse-join-columns>
                </join-table>
            </many-to-many>
            <one-to-many field="subscriptionAuthors" mapped-by="follower" target-entity="App\Entity\Subscription" />
            <one-to-many field="subscriptionFollowers" mapped-by="author" target-entity="App\Entity\Subscription" />
            <field name="roles" type="json" length="1024" nullable="false" />
            <field name="token" type="string" length="32" unique="true" nullable="true" />
            <field name="phone" type="string" length="11" nullable="true" />
            <field name="email" type="string" length="128" nullable="true" />
            <field name="preferred" type="string" length="10" nullable="true" />
    
            <lifecycle-callbacks>
                <lifecycle-callback type="prePersist" method="setCreatedAt"/>
                <lifecycle-callback type="prePersist" method="setUpdatedAt"/>
                <lifecycle-callback type="preUpdate" method="setUpdatedAt"/>
            </lifecycle-callbacks>
    
        </entity>
    </doctrine-mapping>
    ```
11. Исправляем класс `App\Entity\User`
    ```php
    <?php
    
    namespace App\Entity;
    
    use App\Repository\UserRepository;
    use DateTime;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;
    use JetBrains\PhpStorm\ArrayShape;
    use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Validator\Constraints as Assert;
    use JMS\Serializer\Annotation as JMS;
    
    class User implements HasMetaTimestampsInterface, UserInterface, PasswordAuthenticatedUserInterface
    {
        public const EMAIL_NOTIFICATION = 'email';
        public const SMS_NOTIFICATION = 'sms';
    
        #[JMS\Groups(['user-id-list'])]
        private ?int $id = null;
    
        #[JMS\Groups(['video-user-info', 'elastica'])]
        private string $login;
    
        private string $password;
    
        #[Assert\NotBlank]
        #[Assert\GreaterThan(18)]
        #[JMS\Groups(['video-user-info'])]
        private int $age;
    
        #[JMS\Groups(['video-user-info'])]
        #[JMS\SerializedName('isActive')]
        private bool $isActive;
    
        private DateTime $createdAt;
    
        private DateTime $updatedAt;
    
        private Collection $tweets;
    
        private Collection $authors;
    
        private Collection $followers;
    
        private Collection $subscriptionAuthors;
    
        private Collection $subscriptionFollowers;
    
        private array $roles = [];
    
        private ?string $token = null;
    
        #[JMS\Groups(['elastica'])]
        private ?string $phone = null;
    
        #[JMS\Groups(['elastica'])]
        private ?string $email = null;
    
        #[JMS\Groups(['elastica'])]
        private ?string $preferred = null;
    
        public function __construct()
        {
            $this->tweets = new ArrayCollection();
            $this->authors = new ArrayCollection();
            $this->followers = new ArrayCollection();
            $this->subscriptionAuthors = new ArrayCollection();
            $this->subscriptionFollowers = new ArrayCollection();
        }
    
        public function getToken(): ?string
        {
            return $this->token;
        }
    
        public function setToken(?string $token): void
        {
            $this->token = $token;
        }
    
        /**
         * @return string[]
         */
        public function getRoles(): array
        {
            $roles = $this->roles;
            // guarantee every user at least has ROLE_USER
            $roles[] = 'ROLE_USER';
    
            return array_unique($roles);
        }
    
        /**
         * @param string[] $roles
         */
        public function setRoles(array $roles): void
        {
            $this->roles = $roles;
        }
    
        public function getId(): int
        {
            return $this->id;
        }
    
        public function setId(int $id): void
        {
            $this->id = $id;
        }
    
        public function getLogin(): string
        {
            return $this->login;
        }
    
        public function setLogin(string $login): void
        {
            $this->login = $login;
        }
    
        public function getPassword(): string
        {
            return $this->password;
        }
    
        public function setPassword(string $password): void
        {
            $this->password = $password;
        }
    
        public function getAge(): int
        {
            return $this->age;
        }
    
        public function setAge(int $age): void
        {
            $this->age = $age;
        }
    
        public function isActive(): bool
        {
            return $this->isActive;
        }
    
        public function setIsActive(bool $isActive): void
        {
            $this->isActive = $isActive;
        }
    
        public function getCreatedAt(): DateTime {
            return $this->createdAt;
        }
    
        public function setCreatedAt(): void {
            $this->createdAt = new DateTime();
        }
    
        public function getUpdatedAt(): DateTime {
            return $this->updatedAt;
        }
    
        public function setUpdatedAt(): void {
            $this->updatedAt = new DateTime();
        }
    
        public function addTweet(Tweet $tweet): void
        {
            if (!$this->tweets->contains($tweet)) {
                $this->tweets->add($tweet);
            }
        }
    
        public function addFollower(User $follower): void
        {
            if (!$this->followers->contains($follower)) {
                $this->followers->add($follower);
            }
        }
    
        public function addAuthor(User $author): void
        {
            if (!$this->authors->contains($author)) {
                $this->authors->add($author);
            }
        }
    
        public function addSubscriptionAuthor(Subscription $subscription): void
        {
            if (!$this->subscriptionAuthors->contains($subscription)) {
                $this->subscriptionAuthors->add($subscription);
            }
        }
    
        public function addSubscriptionFollower(Subscription $subscription): void
        {
            if (!$this->subscriptionFollowers->contains($subscription)) {
                $this->subscriptionFollowers->add($subscription);
            }
        }
    
        /**
         * @return User[]
         */
        public function getFollowers(): array
        {
            return $this->followers->toArray();
        }
    
        #[ArrayShape([
            'id' => 'int|null',
            'login' => 'string',
            'password' => 'string',
            'roles' => 'string[]',
            'createdAt' => 'string',
            'updatedAt' => 'string',
            'tweets' => ['id' => 'int|null', 'login' => 'string', 'createdAt' => 'string', 'updatedAt' => 'string'],
            'followers' => 'string[]',
            'authors' => 'string[]',
            'subscriptionFollowers' =>  ['subscriptionId' => 'int|null', 'userId' => 'int|null', 'login' => 'string'],
            'subscriptionAuthors' =>  ['subscriptionId' => 'int|null', 'userId' => 'int|null', 'login' => 'string'],
        ])]
        public function toArray(): array
        {
            return [
                'id' => $this->id,
                'login' => $this->login,
                'password' => $this->password,
                'roles' => $this->getRoles(),
                'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
                'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
                'tweets' => array_map(static fn(Tweet $tweet) => $tweet->toArray(), $this->tweets->toArray()),
                'followers' => array_map(
                    static fn(User $user) => ['id' => $user->getId(), 'login' => $user->getLogin()],
                    $this->followers->toArray()
                ),
                'authors' => array_map(
                    static fn(User $user) => ['id' => $user->getLogin(), 'login' => $user->getLogin()],
                    $this->authors->toArray()
                ),
                'subscriptionFollowers' => array_map(
                    static fn(Subscription $subscription) => [
                        'subscription_id' => $subscription->getId(),
                        'user_id' => $subscription->getFollower()->getId(),
                        'login' => $subscription->getFollower()->getLogin(),
                    ],
                    $this->subscriptionFollowers->toArray()
                ),
                'subscriptionAuthors' => array_map(
                    static fn(Subscription $subscription) => [
                        'subscription_id' => $subscription->getId(),
                        'user_id' => $subscription->getAuthor()->getId(),
                        'login' => $subscription->getAuthor()->getLogin(),
                    ],
                    $this->subscriptionAuthors->toArray()
                ),
            ];
        }
    
        public function eraseCredentials()
        {
            // TODO: Implement eraseCredentials() method.
        }
    
        public function getUserIdentifier(): string
        {
            return $this->login;
        }
    
        public function getPhone(): ?string
        {
            return $this->phone;
        }
    
        public function setPhone(?string $phone): void
        {
            $this->phone = $phone;
        }
    
        public function getEmail(): ?string
        {
            return $this->email;
        }
    
        public function setEmail(?string $email): void
        {
            $this->email = $email;
        }
    
        public function getPreferred(): ?string
        {
            return $this->preferred;
        }
    
        public function setPreferred(?string $preferred): void
        {
            $this->preferred = $preferred;
        }
    }
    ```
11. Выполняем команду `php bin/console doctrine:schema:update --dump-sql`, видим изменения только в создании sequences
для идентификаторов
12. Выполняем запрос Add user v5 из Postman-коллекции v10. Видим успешный ответ, проверяем, что запись в БД создалась.

### Добавляем ValueObject

1. Добавляем класс `App\Domain\ValueObject\ValueObjectInterface`
    ```php
    <?php
    
    namespace App\Domain\ValueObject;
    
    interface ValueObjectInterface
    {
        public function equals(ValueObjectInterface $other): bool;
    
        public function getValue(): mixed;
    }
    ```
2. Добавляем класс `App\Domain\ValueObject\AbstractValueObjectString`
    ```php
    <?php
    
    namespace App\Domain\ValueObject;
    
    use JsonSerializable;
    
    abstract class AbstractValueObjectString implements ValueObjectInterface, JsonSerializable
    {
        private readonly string $value;
    
        final public function __construct(string $value)
        {
            $this->validate($value);
    
            $this->value = $this->transform($value);
        }
    
        public function __toString(): string
        {
            return $this->value;
        }
    
        public static function fromString(string $value): static
        {
            return new static($value);
        }
    
        public function equals(ValueObjectInterface $other): bool
        {
            return get_class($this) === get_class($other) && $this->getValue() === $other->getValue();
        }
    
        public function getValue(): string
        {
            return $this->value;
        }
    
        public function jsonSerialize(): string
        {
            return $this->value;
        }
    
        protected function validate(string $value): void
        {
        }
    
        protected function transform(string $value): string
        {
            return $value;
        }
    }
    ```
3. Добавляем класс `App\Domain\ValueObject\UserLogin`
    ```php
    <?php
    
    namespace App\Domain\ValueObject;
    
    class UserLogin extends AbstractValueObjectString
    {
    }
    ```
4. Добавляем класс `App\Doctrine\AbstractStringType`
    ```php
    <?php
    
    namespace App\Doctrine;
    
    use App\Domain\ValueObject\AbstractValueObjectString;
    use Doctrine\DBAL\Platforms\AbstractPlatform;
    use Doctrine\DBAL\Types\ConversionException;
    use Doctrine\DBAL\Types\Type;
    
    abstract class AbstractStringType extends Type
    {
        abstract protected function getConcreteValueObjectType(): string;
    
        public function convertToPHPValue($value, AbstractPlatform $platform): ?AbstractValueObjectString
        {
            if ($value === null) {
                return null;
            }
    
            if (is_string($value)) {
                /** @var AbstractValueObjectString $concreteValueObjectType */
                $concreteValueObjectType = $this->getConcreteValueObjectType();
    
                return $concreteValueObjectType::fromString($value);
            }
    
            /** @psalm-suppress MixedArgument */
            throw ConversionException::conversionFailed($value, $this->getName());
        }
    
        public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
        {
            if ($value === null) {
                return null;
            }
    
            if ($value instanceof AbstractValueObjectString) {
                return $value->getValue();
            }
    
            /** @psalm-suppress MixedArgument */
            throw ConversionException::conversionFailed($value, $this->getName());
        }
    
        public function requiresSQLCommentHint(AbstractPlatform $platform): bool
        {
            return true;
        }
    
        public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
        {
            return $platform->getStringTypeDeclarationSQL($column);
        }
    }
    ```
5. Добавляем класс `App\Doctrine\UserLoginType`
    ```php
    <?php
    
    namespace App\Doctrine;
    
    use App\Domain\ValueObject\UserLogin;
    
    class UserLoginType extends AbstractStringType
    {
        public function getName()
        {
            return 'userLogin';
        }
    
        protected function getConcreteValueObjectType(): string
        {
            return UserLogin::class;
        }
    }
    ```
6. В файле `config/packages/doctrine.yaml` в секцию `doctrine.dbal` добавляем подсекцию `types`
    ```yaml
    types:
        'userLogin': App\Doctrine\UserLoginType
    ```
7. Добавляем файл `src/Service/Orm/Mapping/User.orm.xml`
    ```xml
    <doctrine-mapping
            xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping
                            https://www.doctrine-project.org/schemas/orm/doctrine-mapping.xsd"
    >
        <entity name="App\Entity\User" table="`user`" repository-class="App\Repository\UserRepository">
            <id name="id" type="bigint">
                <generator strategy="IDENTITY" />
            </id>
            <field name="login" type="userLogin" length="32" nullable="false" unique="true"/>
            <field name="password" type="string" length="120" nullable="false" />
            <field name="age" type="integer" nullable="false" />
            <field name="isActive" type="boolean" nullable="false" />
            <field name="createdAt" type="datetime" nullable="false" />
            <field name="updatedAt" type="datetime" nullable="false" />
            <one-to-many field="tweets" mapped-by="author" target-entity="App\Entity\Tweet" />
            <many-to-many field="authors" mapped-by="followers" target-entity="App\Entity\User" />
            <many-to-many field="followers" inversed-by="authors" target-entity="App\Entity\User">
                <join-table name="author_follower">
                    <join-columns>
                        <join-column name="author_id" referenced-column-name="id"/>
                    </join-columns>
                    <inverse-join-columns>
                        <join-column name="follower_id" referenced-column-name="id"/>
                    </inverse-join-columns>
                </join-table>
            </many-to-many>
            <one-to-many field="subscriptionAuthors" mapped-by="follower" target-entity="App\Entity\Subscription" />
            <one-to-many field="subscriptionFollowers" mapped-by="author" target-entity="App\Entity\Subscription" />
            <field name="roles" type="json" length="1024" nullable="false" />
            <field name="token" type="string" length="32" unique="true" nullable="true" />
            <field name="phone" type="string" length="11" nullable="true" />
            <field name="email" type="string" length="128" nullable="true" />
            <field name="preferred" type="string" length="10" nullable="true" />
    
            <lifecycle-callbacks>
                <lifecycle-callback type="prePersist" method="setCreatedAt"/>
                <lifecycle-callback type="prePersist" method="setUpdatedAt"/>
                <lifecycle-callback type="preUpdate" method="setUpdatedAt"/>
            </lifecycle-callbacks>
    
        </entity>
    </doctrine-mapping>
    ```
8. Исправляем класс `App\Entity\User`
    ```php
    <?php
    
    namespace App\Entity;
    
    use App\Domain\ValueObject\UserLogin;
    use App\Repository\UserRepository;
    use DateTime;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;
    use JetBrains\PhpStorm\ArrayShape;
    use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Validator\Constraints as Assert;
    use JMS\Serializer\Annotation as JMS;
    
    class User implements HasMetaTimestampsInterface, UserInterface, PasswordAuthenticatedUserInterface
    {
        public const EMAIL_NOTIFICATION = 'email';
        public const SMS_NOTIFICATION = 'sms';
    
        #[JMS\Groups(['user-id-list'])]
        private ?int $id = null;
    
        #[JMS\Groups(['video-user-info', 'elastica'])]
        private UserLogin $login;
    
        private string $password;
    
        #[Assert\NotBlank]
        #[Assert\GreaterThan(18)]
        #[JMS\Groups(['video-user-info'])]
        private int $age;
    
        #[JMS\Groups(['video-user-info'])]
        #[JMS\SerializedName('isActive')]
        private bool $isActive;
    
        private DateTime $createdAt;
    
        private DateTime $updatedAt;
    
        private Collection $tweets;
    
        private Collection $authors;
    
        private Collection $followers;
    
        private Collection $subscriptionAuthors;
    
        private Collection $subscriptionFollowers;
    
        private array $roles = [];
    
        private ?string $token = null;
    
        #[JMS\Groups(['elastica'])]
        private ?string $phone = null;
    
        #[JMS\Groups(['elastica'])]
        private ?string $email = null;
    
        #[JMS\Groups(['elastica'])]
        private ?string $preferred = null;
    
        public function __construct()
        {
            $this->tweets = new ArrayCollection();
            $this->authors = new ArrayCollection();
            $this->followers = new ArrayCollection();
            $this->subscriptionAuthors = new ArrayCollection();
            $this->subscriptionFollowers = new ArrayCollection();
        }
    
        public function getToken(): ?string
        {
            return $this->token;
        }
    
        public function setToken(?string $token): void
        {
            $this->token = $token;
        }
    
        /**
         * @return string[]
         */
        public function getRoles(): array
        {
            $roles = $this->roles;
            // guarantee every user at least has ROLE_USER
            $roles[] = 'ROLE_USER';
    
            return array_unique($roles);
        }
    
        /**
         * @param string[] $roles
         */
        public function setRoles(array $roles): void
        {
            $this->roles = $roles;
        }
    
        public function getId(): int
        {
            return $this->id;
        }
    
        public function setId(int $id): void
        {
            $this->id = $id;
        }
    
        public function getLogin(): UserLogin
        {
            return $this->login;
        }
    
        public function setLogin(UserLogin $login): void
        {
            $this->login = $login;
        }
    
        public function getPassword(): string
        {
            return $this->password;
        }
    
        public function setPassword(string $password): void
        {
            $this->password = $password;
        }
    
        public function getAge(): int
        {
            return $this->age;
        }
    
        public function setAge(int $age): void
        {
            $this->age = $age;
        }
    
        public function isActive(): bool
        {
            return $this->isActive;
        }
    
        public function setIsActive(bool $isActive): void
        {
            $this->isActive = $isActive;
        }
    
        public function getCreatedAt(): DateTime {
            return $this->createdAt;
        }
    
        public function setCreatedAt(): void {
            $this->createdAt = new DateTime();
        }
    
        public function getUpdatedAt(): DateTime {
            return $this->updatedAt;
        }
    
        public function setUpdatedAt(): void {
            $this->updatedAt = new DateTime();
        }
    
        public function addTweet(Tweet $tweet): void
        {
            if (!$this->tweets->contains($tweet)) {
                $this->tweets->add($tweet);
            }
        }
    
        public function addFollower(User $follower): void
        {
            if (!$this->followers->contains($follower)) {
                $this->followers->add($follower);
            }
        }
    
        public function addAuthor(User $author): void
        {
            if (!$this->authors->contains($author)) {
                $this->authors->add($author);
            }
        }
    
        public function addSubscriptionAuthor(Subscription $subscription): void
        {
            if (!$this->subscriptionAuthors->contains($subscription)) {
                $this->subscriptionAuthors->add($subscription);
            }
        }
    
        public function addSubscriptionFollower(Subscription $subscription): void
        {
            if (!$this->subscriptionFollowers->contains($subscription)) {
                $this->subscriptionFollowers->add($subscription);
            }
        }
    
        /**
         * @return User[]
         */
        public function getFollowers(): array
        {
            return $this->followers->toArray();
        }
    
        #[ArrayShape([
            'id' => 'int|null',
            'login' => 'string',
            'password' => 'string',
            'roles' => 'string[]',
            'createdAt' => 'string',
            'updatedAt' => 'string',
            'tweets' => ['id' => 'int|null', 'login' => 'string', 'createdAt' => 'string', 'updatedAt' => 'string'],
            'followers' => 'string[]',
            'authors' => 'string[]',
            'subscriptionFollowers' =>  ['subscriptionId' => 'int|null', 'userId' => 'int|null', 'login' => 'string'],
            'subscriptionAuthors' =>  ['subscriptionId' => 'int|null', 'userId' => 'int|null', 'login' => 'string'],
        ])]
        public function toArray(): array
        {
            return [
                'id' => $this->id,
                'login' => $this->login,
                'password' => $this->password,
                'roles' => $this->getRoles(),
                'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
                'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
                'tweets' => array_map(static fn(Tweet $tweet) => $tweet->toArray(), $this->tweets->toArray()),
                'followers' => array_map(
                    static fn(User $user) => ['id' => $user->getId(), 'login' => $user->getLogin()->getValue()],
                    $this->followers->toArray()
                ),
                'authors' => array_map(
                    static fn(User $user) => ['id' => $user->getLogin()->getValue(), 'login' => $user->getLogin()->getValue()],
                    $this->authors->toArray()
                ),
                'subscriptionFollowers' => array_map(
                    static fn(Subscription $subscription) => [
                        'subscription_id' => $subscription->getId(),
                        'user_id' => $subscription->getFollower()->getId(),
                        'login' => $subscription->getFollower()->getLogin()->getValue(),
                    ],
                    $this->subscriptionFollowers->toArray()
                ),
                'subscriptionAuthors' => array_map(
                    static fn(Subscription $subscription) => [
                        'subscription_id' => $subscription->getId(),
                        'user_id' => $subscription->getAuthor()->getId(),
                        'login' => $subscription->getAuthor()->getLogin()->getValue(),
                    ],
                    $this->subscriptionAuthors->toArray()
                ),
            ];
        }
    
        public function eraseCredentials()
        {
            // TODO: Implement eraseCredentials() method.
        }
    
        public function getUserIdentifier(): string
        {
            return $this->login;
        }
    
        public function getPhone(): ?string
        {
            return $this->phone;
        }
    
        public function setPhone(?string $phone): void
        {
            $this->phone = $phone;
        }
    
        public function getEmail(): ?string
        {
            return $this->email;
        }
    
        public function setEmail(?string $email): void
        {
            $this->email = $email;
        }
    
        public function getPreferred(): ?string
        {
            return $this->preferred;
        }
    
        public function setPreferred(?string $preferred): void
        {
            $this->preferred = $preferred;
        }
    }
    ```
9. В классе `App\DTO\ManageUserDTO` исправляем метод `fromEntity`
    ```php
    public static function fromEntity(User $user): self
    {
        return new self(...[
            'login' => $user->getLogin()->getValue(),
            'password' => $user->getPassword(),
            'age' => $user->getAge(),
            'isActive' => $user->isActive(),
            'roles' => $user->getRoles(),
            'followers' => array_map(
                static function (User $user) {
                    return [
                        'id' => $user->getId(),
                        'login' => $user->getLogin()->getValue(),
                        'password' => $user->getPassword(),
                        'age' => $user->getAge(),
                        'isActive' => $user->isActive(),
                    ];
                },
                $user->getFollowers()
            ),
            'phone' => $user->getPhone(),
            'email' => $user->getEmail(),
            'preferred' => $user->getPreferred(),
        ]);
    }
    ```
10. В классе `App\Controller\Api\CreateUser\v5\CreateUserManager` исправляем метод `getUser`
    ```php
    public function saveUser(CreateUserDTO $saveUserDTO): UserIsCreatedDTO
    {
        $this->statsdAPIClient->increment('save_user_v5_attempt');

        $user = new User();
        $user->setLogin(UserLogin::fromString($saveUserDTO->login));
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $saveUserDTO->password));
        $user->setRoles($saveUserDTO->roles);
        $user->setAge($saveUserDTO->age);
        $user->setIsActive($saveUserDTO->isActive);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->eventDispatcher->dispatch(new CreateUserEvent($user->getLogin()->getValue()));

        $result = new UserIsCreatedDTO();
        $context = (new SerializationContext())->setGroups(['video-user-info', 'user-id-list']);
        $result->loadFromJsonString($this->serializer->serialize($user, 'json', $context));

        return $result;
    }
    ```
11. В классе `App\Entity\Tweet` исправляем методы `toArray` и `toFeed`
    ```php
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'login' => $this->author->getLogin()->getValue(),
            'text' => $this->text,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
        ];
    }

    public function toFeed(): array
    {
        return [
            'id' => $this->id,
            'author' => isset($this->author) ? $this->author->getLogin()->getValue() : null,
            'text' => $this->text,
            'createdAt' => isset($this->createdAt) ? $this->createdAt->format('Y-m-d h:i:s') : '',
        ];
    }
    ```
12. В классе `App\Controller\Api\CreateUser\v5\CreateUserManager` исправляем метод `saveUser`
    ```php
    public function saveUser(CreateUserDTO $saveUserDTO): UserIsCreatedDTO
    {
        $this->statsdAPIClient->increment('save_user_v5_attempt');

        $user = new User();
        $user->setLogin(UserLogin::fromString($saveUserDTO->login));
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $saveUserDTO->password));
        $user->setRoles($saveUserDTO->roles);
        $user->setAge($saveUserDTO->age);
        $user->setIsActive($saveUserDTO->isActive);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->eventDispatcher->dispatch(new CreateUserEvent($user->getLogin()->getValue()));

        $result = new UserIsCreatedDTO();
        $context = (new SerializationContext())->setGroups(['video-user-info', 'user-id-list']);
        $result->loadFromJsonString($this->serializer->serialize($user, 'json', $context));

        return $result;
    }
    ```
13. Исправляем класс `App\Manager\UserManager`
    ```php
    <?php
    
    namespace App\Manager;
    
    use App\Domain\ValueObject\UserLogin;
    use App\DTO\ManageUserDTO;
    use App\Entity\User;
    use App\Repository\UserRepository;
    use Doctrine\Common\Collections\Criteria;
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\NonUniqueResultException;
    use Elastica\Aggregation\Terms;
    use Elastica\Query;
    use Elastica\Query\QueryString;
    use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
    use FOS\ElasticaBundle\Paginator\FantaPaginatorAdapter;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    
    class UserManager
    {
        public function __construct(
            private readonly EntityManagerInterface $entityManager,
            private readonly UserPasswordHasherInterface $userPasswordHasher,
            private readonly PaginatedFinderInterface $finder,
        ) {
        }
    
        public function createByLogin(string $login): User
        {
            $user = new User();
            $user->setLogin(UserLogin::fromString($login));
            $user->setCreatedAt();
            $user->setUpdatedAt();
    
            $this->entityManager->persist($user);
            $this->entityManager->flush();
    
            return $user;
        }
    
        public function clearEntityManager(): void
        {
            $this->entityManager->clear();
        }
    
        public function findUser(int $id): ?User
        {
            $repository = $this->entityManager->getRepository(User::class);
            $user = $repository->find($id);
    
            return $user instanceof User ? $user : null;
        }
    
        public function subscribeUser(User $author, User $follower): void
        {
            $author->addFollower($follower);
            $follower->addAuthor($author);
            $this->entityManager->flush();
        }
    
        /**
         * @return User[]
         */
        public function findUsersByLogin(string $name): array
        {
            return $this->entityManager->getRepository(User::class)->findBy(['login' => $name]);
        }
    
        /**
         * @return User[]
         */
        public function findUsersByCriteria(string $login): array
        {
            $criteria = Criteria::create();
            $criteria->andWhere(Criteria::expr()?->eq('login', $login));
            /** @var EntityRepository $repository */
            $repository = $this->entityManager->getRepository(User::class);
    
            return $repository->matching($criteria)->toArray();
        }
    
        public function updateUserLoginById(int $userId, string $login): ?User
        {
            $user = $this->findUser($userId);
            if (!($user instanceof User)) {
                return null;
            }
            $user->setLogin(UserLogin::fromString($login));
            $this->entityManager->flush();
    
            return $user;
        }
    
        public function findUsersWithQueryBuilder(string $login): array
        {
            $queryBuilder = $this->entityManager->createQueryBuilder();
            // SELECT u.* FROM `user` u WHERE u.login LIKE :userLogin
            $queryBuilder->select('u')
                ->from(User::class, 'u')
                ->andWhere($queryBuilder->expr()->like('u.login',':userLogin'))
                ->setParameter('userLogin', "%$login%");
    
            return $queryBuilder->getQuery()->getResult();
        }
    
        public function updateUserLoginWithQueryBuilder(int $userId, string $login): void
        {
            $queryBuilder = $this->entityManager->createQueryBuilder();
            $queryBuilder->update(User::class,'u')
                ->set('u.login', ':userLogin')
                ->where($queryBuilder->expr()->eq('u.id', ':userId'))
                ->setParameter('userId', $userId)
                ->setParameter('userLogin', $login);
    
            $queryBuilder->getQuery()->execute();
        }
    
        /**
         * @throws \Doctrine\DBAL\Exception
         */
        public function updateUserLoginWithDBALQueryBuilder(int $userId, string $login): void
        {
            $queryBuilder = $this->entityManager->getConnection()->createQueryBuilder();
            $queryBuilder->update('"user"','u')
                ->set('login', ':userLogin')
                ->where($queryBuilder->expr()->eq('u.id', ':userId'))
                ->setParameter('userId', $userId)
                ->setParameter('userLogin', $login);
    
            $queryBuilder->executeStatement();
        }
    
        /**
         * @throws NonUniqueResultException
         */
        public function findUserWithTweetsWithQueryBuilder(int $userId): ?User
        {
            $queryBuilder = $this->entityManager->createQueryBuilder();
            $queryBuilder->select('u', 't')
                ->from(User::class, 'u')
                ->leftJoin('u.tweets', 't')
                ->where($queryBuilder->expr()->eq('u.id', ':userId'))
                ->setParameter('userId', $userId);
    
            return $queryBuilder->getQuery()->getOneOrNullResult();
        }
    
        /**
         * @throws \Doctrine\DBAL\Exception
         */
        public function findUserWithTweetsWithDBALQueryBuilder(int $userId): array
        {
            $queryBuilder = $this->entityManager->getConnection()->createQueryBuilder();
            $queryBuilder->select('u', 't')
                ->from('"user"', 'u')
                ->leftJoin('u', 'tweet', 't', 'u.id = t.author_id')
                ->where($queryBuilder->expr()->eq('u.id', ':userId'))
                ->setParameter('userId', $userId);
    
            return $queryBuilder->executeQuery()->fetchAllNumeric();
        }
    
        /**
         * @return User[]
         */
        public function getUsers(int $page, int $perPage): array
        {
            /** @var UserRepository $userRepository */
            $userRepository = $this->entityManager->getRepository(User::class);
    
            return $userRepository->getUsers($page, $perPage);
        }
    
        public function deleteUserById(int $userId): bool
        {
            /** @var UserRepository $userRepository */
            $userRepository = $this->entityManager->getRepository(User::class);
            /** @var User $user */
            $user = $userRepository->find($userId);
            if ($user === null) {
                return false;
            }
            return $this->deleteUser($user);
        }
    
        public function deleteUser(User $user): bool
        {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
    
            return true;
        }
    
        public function updateUserLogin(User $user, string $login): void
        {
            $user->setLogin(UserLogin::fromString($login));
            $this->entityManager->flush();
        }
    
        public function saveUser(User $user): void
        {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    
        public function saveUserFromDTO(User $user, ManageUserDTO $manageUserDTO): ?int
        {
            $user->setLogin(UserLogin::fromString($manageUserDTO->login));
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $manageUserDTO->password));
            $user->setAge($manageUserDTO->age);
            $user->setIsActive($manageUserDTO->isActive);
            $user->setRoles($manageUserDTO->roles);
            $user->setPhone($manageUserDTO->phone);
            $user->setEmail($manageUserDTO->email);
            $user->setPreferred($manageUserDTO->preferred);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
    
            return $user->getId();
        }
    
        public function findUserByLogin(string $login): ?User
        {
            /** @var UserRepository $userRepository */
            $userRepository = $this->entityManager->getRepository(User::class);
            /** @var User|null $user */
            $user = $userRepository->findOneBy(['login' => $login]);
    
            return $user;
        }
    
        public function updateUserToken(string $login): ?string
        {
            $user = $this->findUserByLogin($login);
            if ($user === null) {
                return false;
            }
            $token = base64_encode(random_bytes(20));
            $user->setToken($token);
            $this->entityManager->flush();
    
            return $token;
        }
    
        public function findUserByToken(string $token): ?User
        {
            /** @var UserRepository $userRepository */
            $userRepository = $this->entityManager->getRepository(User::class);
            /** @var User|null $user */
            $user = $userRepository->findOneBy(['token' => $token]);
    
            return $user;
        }
    
        /**
         * @return User[]
         */
        public function findUserByQuery(string $query, int $perPage, int $page): array
        {
            $paginatedResult = $this->finder->findPaginated($query);
            $paginatedResult->setMaxPerPage($perPage);
            $paginatedResult->setCurrentPage($page);
            $result = [];
            array_push($result, ...$paginatedResult->getCurrentPageResults());
    
            return array_map(static fn (User $user) => $user->toArray(), $result);
        }
    
        /**
         * @return User[]
         */
        public function findUserWithAggregation(string $field): array
        {
            $aggregation = new Terms('notifications');
            $aggregation->setField($field);
            $query = new Query();
            $query->addAggregation($aggregation);
            $paginatedResult = $this->finder->findPaginated($query);
            /** @var FantaPaginatorAdapter $adapter */
            $adapter = $paginatedResult->getAdapter();
    
            return $adapter->getAggregations();
        }
    
        /**
         * @return User[]
         */
        public function findUserByQueryWithAggregation(string $queryString, string $field): array
        {
            $aggregation = new Terms('notifications');
            $aggregation->setField($field);
            $query = new Query(new QueryString($queryString));
            $query->addAggregation($aggregation);
            $paginatedResult = $this->finder->findPaginated($query);
            /** @var FantaPaginatorAdapter $adapter */
            $adapter = $paginatedResult->getAdapter();
    
            return $adapter->getAggregations();
        }
    }
    ```
14. Выполняем запрос Add user v5 из Postman-коллекции v10. Видим, что запись в БД создалась.
15. Выполняем запрос Get users list из Postman-коллекции v10, видим ошибку
16. Очищаем кэш метаданных Doctrine командой `php bin/console doctrine:cache:clear-metadata`
17. Ещё раз выполняем запрос Get users list из Postman-коллекции v10, видим созданного пользователя.
