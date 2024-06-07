<?php
declare(strict_types=1);

namespace App\DTO;

use Articus\DataTransfer\Annotation as DTA;

/**
 * Parameters for delete_app_api_v2_user_deleteuser
 */
class DeleteAppApiV2UserDeleteuserParameterData
{
    /**
     * @DTA\Data(subset="path", field="userId")
     * @DTA\Strategy(subset="path", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="path", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="path", name="Match", options={"pattern":"/\d+/"})
     */
    public ?string $user_id = null;

}
