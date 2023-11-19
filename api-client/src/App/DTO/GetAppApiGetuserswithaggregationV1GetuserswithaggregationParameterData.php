<?php
declare(strict_types=1);

namespace App\DTO;

use Articus\DataTransfer\Annotation as DTA;

/**
 * Parameters for get_app_api_getuserswithaggregation_v1_getuserswithaggregation
 */
class GetAppApiGetuserswithaggregationV1GetuserswithaggregationParameterData
{
    /**
     * 
     * @DTA\Data(subset="query", field="field", nullable=true)
     * @DTA\Strategy(subset="query", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="query", name="QueryStringScalar", options={"type":"string"})
     */
    public ?string $field = null;

}
