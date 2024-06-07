<?php
declare(strict_types=1);

namespace App\DTO;

use Articus\DataTransfer\Annotation as DTA;

class PostAppApiAddfollowersV1AddfollowersRequest
{
    /**
     * @DTA\Data(field="userId")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     * @DTA\Validator(name="Match", options={"pattern":"/\d+/"})
     */
    public ?string $user_id = null;

    /**
     * @DTA\Data(field="followersLogin")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     */
    public ?string $followers_login = null;

    /**
     * @DTA\Data(field="count")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     * @DTA\Validator(name="Match", options={"pattern":"/\d+/"})
     */
    public ?string $count = null;

    /**
     * @DTA\Data(field="async")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     * @DTA\Validator(name="Match", options={"pattern":"/0|1/"})
     */
    public ?string $async = null;

}
