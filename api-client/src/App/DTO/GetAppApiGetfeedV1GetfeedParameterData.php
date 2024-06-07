<?php
declare(strict_types=1);

namespace App\DTO;

use Articus\DataTransfer\Annotation as DTA;

/**
 * Parameters for get_app_api_getfeed_v1_getfeed
 */
class GetAppApiGetfeedV1GetfeedParameterData
{
    /**
     * Количество на странице
     * @DTA\Data(subset="query", field="count", nullable=true)
     * @DTA\Strategy(subset="query", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="query", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="query", name="Match", options={"pattern":"/\d+/"})
     */
    public ?string $count = null;

    /**
     * ID пользователя
     * @DTA\Data(subset="query", field="userId", nullable=true)
     * @DTA\Strategy(subset="query", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="query", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="query", name="Match", options={"pattern":"/\d+/"})
     */
    public ?string $user_id = null;

}
