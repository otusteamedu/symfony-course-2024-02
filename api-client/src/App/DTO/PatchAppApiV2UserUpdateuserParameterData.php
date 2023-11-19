<?php
declare(strict_types=1);

namespace App\DTO;

use Articus\DataTransfer\Annotation as DTA;

/**
 * Parameters for patch_app_api_v2_user_updateuser
 */
class PatchAppApiV2UserUpdateuserParameterData
{
    /**
     * @DTA\Data(subset="path", field="userId")
     * @DTA\Strategy(subset="path", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="path", name="QueryStringScalar", options={"type":"string"})
     */
    public ?string $user_id = null;

}
