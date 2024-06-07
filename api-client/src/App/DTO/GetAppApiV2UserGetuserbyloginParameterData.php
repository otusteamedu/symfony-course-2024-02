<?php
declare(strict_types=1);

namespace App\DTO;

use Articus\DataTransfer\Annotation as DTA;

/**
 * Parameters for get_app_api_v2_user_getuserbylogin
 */
class GetAppApiV2UserGetuserbyloginParameterData
{
    /**
     * @DTA\Data(subset="path", field="userLogin")
     * @DTA\Strategy(subset="path", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="path", name="QueryStringScalar", options={"type":"string"})
     */
    public ?string $user_login = null;

}
