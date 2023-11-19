<?php
declare(strict_types=1);

namespace App\DTO;

use Articus\DataTransfer\Annotation as DTA;

/**
 * Parameters for get_app_api_getusersbyquerywithaggregation_v1_getusersbyquerywithaggregation
 */
class GetAppApiGetusersbyquerywithaggregationV1GetusersbyquerywithaggregationParameterData
{
    /**
     * 
     * @DTA\Data(subset="query", field="field", nullable=true)
     * @DTA\Strategy(subset="query", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="query", name="QueryStringScalar", options={"type":"string"})
     */
    public ?string $field = null;

    /**
     * 
     * @DTA\Data(subset="query", field="query", nullable=true)
     * @DTA\Strategy(subset="query", name="QueryStringScalar", options={"type":"string"})
     * @DTA\Validator(subset="query", name="QueryStringScalar", options={"type":"string"})
     */
    public ?string $query = null;

}
