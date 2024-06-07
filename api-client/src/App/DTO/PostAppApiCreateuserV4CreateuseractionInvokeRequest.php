<?php
declare(strict_types=1);

namespace App\DTO;

use Articus\DataTransfer\Annotation as DTA;

class PostAppApiCreateuserV4CreateuseractionInvokeRequest
{
    /**
     * @DTA\Data(field="login")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     */
    public ?string $login = null;

    /**
     * @DTA\Data(field="password")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     */
    public ?string $password = null;

    /**
     * @DTA\Data(field="roles")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     */
    public ?string $roles = null;

    /**
     * @DTA\Data(field="age")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     * @DTA\Validator(name="Match", options={"pattern":"/\d+/"})
     */
    public ?string $age = null;

    /**
     * @DTA\Data(field="isActive")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     * @DTA\Validator(name="Match", options={"pattern":"/true|false/"})
     */
    public ?string $is_active = null;

}
