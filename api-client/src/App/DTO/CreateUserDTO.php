<?php
declare(strict_types=1);

namespace App\DTO;

use Articus\DataTransfer\Annotation as DTA;

class CreateUserDTO
{
    /**
     * @DTA\Data(field="login")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     * @DTA\Validator(name="Length", options={"max":32})
     */
    public ?string $login = null;

    /**
     * @DTA\Data(field="password")
     * @DTA\Validator(name="Scalar", options={"type":"string"})
     * @DTA\Validator(name="Length", options={"max":32})
     */
    public ?string $password = null;

    /**
     * @DTA\Data(field="age")
     * @DTA\Validator(name="Scalar", options={"type":"int"})
     */
    public ?int $age = null;

    /**
     * @DTA\Data(field="is_active")
     * @DTA\Validator(name="Scalar", options={"type":"bool"})
     */
    public ?bool $is_active = null;

}
