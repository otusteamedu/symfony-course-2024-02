<?php
declare(strict_types=1);

namespace App;

use Articus\DataTransfer as DT;
use OpenAPIGenerator\APIClient as OAGAC;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Twitter API
 * Otus!
 * The version of the OpenAPI document: 1.2.3
 */
class ApiClient extends OAGAC\AbstractApiClient
{
    //region deleteAppApiV1UserDeleteuser
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function deleteAppApiV1UserDeleteuserRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('DELETE', '/api/v1/user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function deleteAppApiV1UserDeleteuser(
    ): array
    {
        $response = $this->deleteAppApiV1UserDeleteuserRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function deleteAppApiV1UserDeleteuserResult(
    )
    {
        return $this->getSuccessfulContent(...$this->deleteAppApiV1UserDeleteuser());
    }
    //endregion

    //region deleteAppApiV1UserDeleteuserbyid
    /**
     * @param \App\DTO\DeleteAppApiV1UserDeleteuserbyidParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function deleteAppApiV1UserDeleteuserbyidRaw(
        \App\DTO\DeleteAppApiV1UserDeleteuserbyidParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('DELETE', '/api/v1/user/{id}', $this->getPathParameters($parameters), []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\DeleteAppApiV1UserDeleteuserbyidParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function deleteAppApiV1UserDeleteuserbyid(
        \App\DTO\DeleteAppApiV1UserDeleteuserbyidParameterData $parameters
    ): array
    {
        $response = $this->deleteAppApiV1UserDeleteuserbyidRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\DeleteAppApiV1UserDeleteuserbyidParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function deleteAppApiV1UserDeleteuserbyidResult(
        \App\DTO\DeleteAppApiV1UserDeleteuserbyidParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->deleteAppApiV1UserDeleteuserbyid($parameters));
    }
    //endregion

    //region deleteAppApiV2UserDeleteuser
    /**
     * @param \App\DTO\DeleteAppApiV2UserDeleteuserParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function deleteAppApiV2UserDeleteuserRaw(
        \App\DTO\DeleteAppApiV2UserDeleteuserParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('DELETE', '/api/v2/user/{userId}', $this->getPathParameters($parameters), []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\DeleteAppApiV2UserDeleteuserParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function deleteAppApiV2UserDeleteuser(
        \App\DTO\DeleteAppApiV2UserDeleteuserParameterData $parameters
    ): array
    {
        $response = $this->deleteAppApiV2UserDeleteuserRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\DeleteAppApiV2UserDeleteuserParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function deleteAppApiV2UserDeleteuserResult(
        \App\DTO\DeleteAppApiV2UserDeleteuserParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->deleteAppApiV2UserDeleteuser($parameters));
    }
    //endregion

    //region deleteAppApiV3UserDeleteuser
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function deleteAppApiV3UserDeleteuserRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('DELETE', '/api/v3/user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function deleteAppApiV3UserDeleteuser(
    ): array
    {
        $response = $this->deleteAppApiV3UserDeleteuserRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function deleteAppApiV3UserDeleteuserResult(
    )
    {
        return $this->getSuccessfulContent(...$this->deleteAppApiV3UserDeleteuser());
    }
    //endregion

    //region getAppApiGetfeedV1Getfeed
    /**
     * @param \App\DTO\GetAppApiGetfeedV1GetfeedParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getAppApiGetfeedV1GetfeedRaw(
        \App\DTO\GetAppApiGetfeedV1GetfeedParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v1/get-feed', [], $this->getQueryParameters($parameters));
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\GetAppApiGetfeedV1GetfeedParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getAppApiGetfeedV1Getfeed(
        \App\DTO\GetAppApiGetfeedV1GetfeedParameterData $parameters
    ): array
    {
        $response = $this->getAppApiGetfeedV1GetfeedRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\GetAppApiGetfeedV1GetfeedParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getAppApiGetfeedV1GetfeedResult(
        \App\DTO\GetAppApiGetfeedV1GetfeedParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->getAppApiGetfeedV1Getfeed($parameters));
    }
    //endregion

    //region getAppApiGettweetsV1Gettweets
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getAppApiGettweetsV1GettweetsRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v1/tweet', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getAppApiGettweetsV1Gettweets(
    ): array
    {
        $response = $this->getAppApiGettweetsV1GettweetsRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getAppApiGettweetsV1GettweetsResult(
    )
    {
        return $this->getSuccessfulContent(...$this->getAppApiGettweetsV1Gettweets());
    }
    //endregion

    //region getAppApiGetusersV4GetusersactionInvoke
    /**
     * @param \App\DTO\GetAppApiGetusersV4GetusersactionInvokeParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getAppApiGetusersV4GetusersactionInvokeRaw(
        \App\DTO\GetAppApiGetusersV4GetusersactionInvokeParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v4/users.{format}', $this->getPathParameters($parameters), $this->getQueryParameters($parameters));
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\GetAppApiGetusersV4GetusersactionInvokeParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getAppApiGetusersV4GetusersactionInvoke(
        \App\DTO\GetAppApiGetusersV4GetusersactionInvokeParameterData $parameters
    ): array
    {
        $response = $this->getAppApiGetusersV4GetusersactionInvokeRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\GetAppApiGetusersV4GetusersactionInvokeParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getAppApiGetusersV4GetusersactionInvokeResult(
        \App\DTO\GetAppApiGetusersV4GetusersactionInvokeParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->getAppApiGetusersV4GetusersactionInvoke($parameters));
    }
    //endregion

    //region getAppApiGetusersbyqueryV1Getusersbyquery
    /**
     * @param \App\DTO\GetAppApiGetusersbyqueryV1GetusersbyqueryParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getAppApiGetusersbyqueryV1GetusersbyqueryRaw(
        \App\DTO\GetAppApiGetusersbyqueryV1GetusersbyqueryParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v1/get-users-by-query', [], $this->getQueryParameters($parameters));
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\GetAppApiGetusersbyqueryV1GetusersbyqueryParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getAppApiGetusersbyqueryV1Getusersbyquery(
        \App\DTO\GetAppApiGetusersbyqueryV1GetusersbyqueryParameterData $parameters
    ): array
    {
        $response = $this->getAppApiGetusersbyqueryV1GetusersbyqueryRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\GetAppApiGetusersbyqueryV1GetusersbyqueryParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getAppApiGetusersbyqueryV1GetusersbyqueryResult(
        \App\DTO\GetAppApiGetusersbyqueryV1GetusersbyqueryParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->getAppApiGetusersbyqueryV1Getusersbyquery($parameters));
    }
    //endregion

    //region getAppApiGetusersbyquerywithaggregationV1Getusersbyquerywithaggregation
    /**
     * @param \App\DTO\GetAppApiGetusersbyquerywithaggregationV1GetusersbyquerywithaggregationParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getAppApiGetusersbyquerywithaggregationV1GetusersbyquerywithaggregationRaw(
        \App\DTO\GetAppApiGetusersbyquerywithaggregationV1GetusersbyquerywithaggregationParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v1/get-users-by-query-with-aggregation', [], $this->getQueryParameters($parameters));
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\GetAppApiGetusersbyquerywithaggregationV1GetusersbyquerywithaggregationParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getAppApiGetusersbyquerywithaggregationV1Getusersbyquerywithaggregation(
        \App\DTO\GetAppApiGetusersbyquerywithaggregationV1GetusersbyquerywithaggregationParameterData $parameters
    ): array
    {
        $response = $this->getAppApiGetusersbyquerywithaggregationV1GetusersbyquerywithaggregationRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\GetAppApiGetusersbyquerywithaggregationV1GetusersbyquerywithaggregationParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getAppApiGetusersbyquerywithaggregationV1GetusersbyquerywithaggregationResult(
        \App\DTO\GetAppApiGetusersbyquerywithaggregationV1GetusersbyquerywithaggregationParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->getAppApiGetusersbyquerywithaggregationV1Getusersbyquerywithaggregation($parameters));
    }
    //endregion

    //region getAppApiGetuserswithaggregationV1Getuserswithaggregation
    /**
     * @param \App\DTO\GetAppApiGetuserswithaggregationV1GetuserswithaggregationParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getAppApiGetuserswithaggregationV1GetuserswithaggregationRaw(
        \App\DTO\GetAppApiGetuserswithaggregationV1GetuserswithaggregationParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v1/get-users-with-aggregation', [], $this->getQueryParameters($parameters));
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\GetAppApiGetuserswithaggregationV1GetuserswithaggregationParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getAppApiGetuserswithaggregationV1Getuserswithaggregation(
        \App\DTO\GetAppApiGetuserswithaggregationV1GetuserswithaggregationParameterData $parameters
    ): array
    {
        $response = $this->getAppApiGetuserswithaggregationV1GetuserswithaggregationRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\GetAppApiGetuserswithaggregationV1GetuserswithaggregationParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getAppApiGetuserswithaggregationV1GetuserswithaggregationResult(
        \App\DTO\GetAppApiGetuserswithaggregationV1GetuserswithaggregationParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->getAppApiGetuserswithaggregationV1Getuserswithaggregation($parameters));
    }
    //endregion

    //region getAppApiV1UserGetusers
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getAppApiV1UserGetusersRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v1/user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getAppApiV1UserGetusers(
    ): array
    {
        $response = $this->getAppApiV1UserGetusersRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getAppApiV1UserGetusersResult(
    )
    {
        return $this->getSuccessfulContent(...$this->getAppApiV1UserGetusers());
    }
    //endregion

    //region getAppApiV2UserGetuserbylogin
    /**
     * @param \App\DTO\GetAppApiV2UserGetuserbyloginParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getAppApiV2UserGetuserbyloginRaw(
        \App\DTO\GetAppApiV2UserGetuserbyloginParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v2/user/by-login/{userLogin}', $this->getPathParameters($parameters), []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\GetAppApiV2UserGetuserbyloginParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getAppApiV2UserGetuserbylogin(
        \App\DTO\GetAppApiV2UserGetuserbyloginParameterData $parameters
    ): array
    {
        $response = $this->getAppApiV2UserGetuserbyloginRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\GetAppApiV2UserGetuserbyloginParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getAppApiV2UserGetuserbyloginResult(
        \App\DTO\GetAppApiV2UserGetuserbyloginParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->getAppApiV2UserGetuserbylogin($parameters));
    }
    //endregion

    //region getAppApiV2UserGetusers
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getAppApiV2UserGetusersRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v2/user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getAppApiV2UserGetusers(
    ): array
    {
        $response = $this->getAppApiV2UserGetusersRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getAppApiV2UserGetusersResult(
    )
    {
        return $this->getSuccessfulContent(...$this->getAppApiV2UserGetusers());
    }
    //endregion

    //region getAppApiV3UserGetusers
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getAppApiV3UserGetusersRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v3/user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getAppApiV3UserGetusers(
    ): array
    {
        $response = $this->getAppApiV3UserGetusersRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getAppApiV3UserGetusersResult(
    )
    {
        return $this->getSuccessfulContent(...$this->getAppApiV3UserGetusers());
    }
    //endregion

    //region getCreateUser
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getCreateUserRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v1/user/create-user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getCreateUser(
    ): array
    {
        $response = $this->getCreateUserRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getCreateUserResult(
    )
    {
        return $this->getSuccessfulContent(...$this->getCreateUser());
    }
    //endregion

    //region getUpdateUser
    /**
     * @param \App\DTO\GetUpdateUserParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function getUpdateUserRaw(
        \App\DTO\GetUpdateUserParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('GET', '/api/v1/user/update-user/{id}', $this->getPathParameters($parameters), []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\GetUpdateUserParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function getUpdateUser(
        \App\DTO\GetUpdateUserParameterData $parameters
    ): array
    {
        $response = $this->getUpdateUserRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\GetUpdateUserParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function getUpdateUserResult(
        \App\DTO\GetUpdateUserParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->getUpdateUser($parameters));
    }
    //endregion

    //region patchAppApiV1UserUpdateuser
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function patchAppApiV1UserUpdateuserRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('PATCH', '/api/v1/user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function patchAppApiV1UserUpdateuser(
    ): array
    {
        $response = $this->patchAppApiV1UserUpdateuserRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function patchAppApiV1UserUpdateuserResult(
    )
    {
        return $this->getSuccessfulContent(...$this->patchAppApiV1UserUpdateuser());
    }
    //endregion

    //region patchAppApiV2UserUpdateuser
    /**
     * @param \App\DTO\PatchAppApiV2UserUpdateuserParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function patchAppApiV2UserUpdateuserRaw(
        \App\DTO\PatchAppApiV2UserUpdateuserParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('PATCH', '/api/v2/user/{userId}', $this->getPathParameters($parameters), []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\PatchAppApiV2UserUpdateuserParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function patchAppApiV2UserUpdateuser(
        \App\DTO\PatchAppApiV2UserUpdateuserParameterData $parameters
    ): array
    {
        $response = $this->patchAppApiV2UserUpdateuserRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\PatchAppApiV2UserUpdateuserParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function patchAppApiV2UserUpdateuserResult(
        \App\DTO\PatchAppApiV2UserUpdateuserParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->patchAppApiV2UserUpdateuser($parameters));
    }
    //endregion

    //region patchAppApiV3UserUpdateuser
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function patchAppApiV3UserUpdateuserRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('PATCH', '/api/v3/user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function patchAppApiV3UserUpdateuser(
    ): array
    {
        $response = $this->patchAppApiV3UserUpdateuserRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function patchAppApiV3UserUpdateuserResult(
    )
    {
        return $this->getSuccessfulContent(...$this->patchAppApiV3UserUpdateuser());
    }
    //endregion

    //region patchUpdateUser
    /**
     * @param \App\DTO\PatchUpdateUserParameterData $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function patchUpdateUserRaw(
        \App\DTO\PatchUpdateUserParameterData $parameters
    ): ResponseInterface
    {
        $request = $this->createRequest('PATCH', '/api/v1/user/update-user/{id}', $this->getPathParameters($parameters), []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\PatchUpdateUserParameterData $parameters
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function patchUpdateUser(
        \App\DTO\PatchUpdateUserParameterData $parameters
    ): array
    {
        $response = $this->patchUpdateUserRaw($parameters);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\PatchUpdateUserParameterData $parameters
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function patchUpdateUserResult(
        \App\DTO\PatchUpdateUserParameterData $parameters
    )
    {
        return $this->getSuccessfulContent(...$this->patchUpdateUser($parameters));
    }
    //endregion

    //region postAppApiAddfollowersV1Addfollowers
    /**
     * @param \App\DTO\PostAppApiAddfollowersV1AddfollowersRequest $requestContent
     * @param string $requestMediaType
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postAppApiAddfollowersV1AddfollowersRaw(
        \App\DTO\PostAppApiAddfollowersV1AddfollowersRequest $requestContent,
        string $requestMediaType = 'application/json'
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v1/add-followers', [], []);
        $request = $this->addBody($request, $requestMediaType, $requestContent);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\PostAppApiAddfollowersV1AddfollowersRequest $requestContent
     * @param string $requestMediaType
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postAppApiAddfollowersV1Addfollowers(
        \App\DTO\PostAppApiAddfollowersV1AddfollowersRequest $requestContent,
        string $requestMediaType = 'application/json'
    ): array
    {
        $response = $this->postAppApiAddfollowersV1AddfollowersRaw($requestContent, $requestMediaType);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\PostAppApiAddfollowersV1AddfollowersRequest $requestContent
     * @param string $requestMediaType
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postAppApiAddfollowersV1AddfollowersResult(
        \App\DTO\PostAppApiAddfollowersV1AddfollowersRequest $requestContent,
        string $requestMediaType = 'application/json'
    )
    {
        return $this->getSuccessfulContent(...$this->postAppApiAddfollowersV1Addfollowers($requestContent, $requestMediaType));
    }
    //endregion

    //region postAppApiCreateuserV4CreateuseractionInvoke
    /**
     * @param \App\DTO\PostAppApiCreateuserV4CreateuseractionInvokeRequest $requestContent
     * @param string $requestMediaType
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postAppApiCreateuserV4CreateuseractionInvokeRaw(
        \App\DTO\PostAppApiCreateuserV4CreateuseractionInvokeRequest $requestContent,
        string $requestMediaType = 'application/json'
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v4/users', [], []);
        $request = $this->addBody($request, $requestMediaType, $requestContent);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\PostAppApiCreateuserV4CreateuseractionInvokeRequest $requestContent
     * @param string $requestMediaType
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postAppApiCreateuserV4CreateuseractionInvoke(
        \App\DTO\PostAppApiCreateuserV4CreateuseractionInvokeRequest $requestContent,
        string $requestMediaType = 'application/json'
    ): array
    {
        $response = $this->postAppApiCreateuserV4CreateuseractionInvokeRaw($requestContent, $requestMediaType);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\PostAppApiCreateuserV4CreateuseractionInvokeRequest $requestContent
     * @param string $requestMediaType
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postAppApiCreateuserV4CreateuseractionInvokeResult(
        \App\DTO\PostAppApiCreateuserV4CreateuseractionInvokeRequest $requestContent,
        string $requestMediaType = 'application/json'
    )
    {
        return $this->getSuccessfulContent(...$this->postAppApiCreateuserV4CreateuseractionInvoke($requestContent, $requestMediaType));
    }
    //endregion

    //region postAppApiCreateuserV5CreateuseractionSaveuser
    /**
     * @param \App\DTO\CreateUserDTO $requestContent
     * @param string $requestMediaType
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postAppApiCreateuserV5CreateuseractionSaveuserRaw(
        \App\DTO\CreateUserDTO $requestContent,
        string $requestMediaType = 'application/json'
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v5/users', [], []);
        $request = $this->addBody($request, $requestMediaType, $requestContent);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\CreateUserDTO $requestContent
     * @param string $requestMediaType
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postAppApiCreateuserV5CreateuseractionSaveuser(
        \App\DTO\CreateUserDTO $requestContent,
        string $requestMediaType = 'application/json'
    ): array
    {
        $response = $this->postAppApiCreateuserV5CreateuseractionSaveuserRaw($requestContent, $requestMediaType);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\CreateUserDTO $requestContent
     * @param string $requestMediaType
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postAppApiCreateuserV5CreateuseractionSaveuserResult(
        \App\DTO\CreateUserDTO $requestContent,
        string $requestMediaType = 'application/json'
    )
    {
        return $this->getSuccessfulContent(...$this->postAppApiCreateuserV5CreateuseractionSaveuser($requestContent, $requestMediaType));
    }
    //endregion

    //region postAppApiSavetweetV1Savetweet
    /**
     * @param \App\DTO\PostAppApiSavetweetV1SavetweetRequest $requestContent
     * @param string $requestMediaType
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postAppApiSavetweetV1SavetweetRaw(
        \App\DTO\PostAppApiSavetweetV1SavetweetRequest $requestContent,
        string $requestMediaType = 'application/json'
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v1/tweet', [], []);
        $request = $this->addBody($request, $requestMediaType, $requestContent);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param \App\DTO\PostAppApiSavetweetV1SavetweetRequest $requestContent
     * @param string $requestMediaType
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postAppApiSavetweetV1Savetweet(
        \App\DTO\PostAppApiSavetweetV1SavetweetRequest $requestContent,
        string $requestMediaType = 'application/json'
    ): array
    {
        $response = $this->postAppApiSavetweetV1SavetweetRaw($requestContent, $requestMediaType);
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @param \App\DTO\PostAppApiSavetweetV1SavetweetRequest $requestContent
     * @param string $requestMediaType
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postAppApiSavetweetV1SavetweetResult(
        \App\DTO\PostAppApiSavetweetV1SavetweetRequest $requestContent,
        string $requestMediaType = 'application/json'
    )
    {
        return $this->getSuccessfulContent(...$this->postAppApiSavetweetV1Savetweet($requestContent, $requestMediaType));
    }
    //endregion

    //region postAppApiV1TokenGettoken
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postAppApiV1TokenGettokenRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v1/token', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postAppApiV1TokenGettoken(
    ): array
    {
        $response = $this->postAppApiV1TokenGettokenRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postAppApiV1TokenGettokenResult(
    )
    {
        return $this->getSuccessfulContent(...$this->postAppApiV1TokenGettoken());
    }
    //endregion

    //region postAppApiV1UploadUploadfile
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postAppApiV1UploadUploadfileRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v1/upload', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postAppApiV1UploadUploadfile(
    ): array
    {
        $response = $this->postAppApiV1UploadUploadfileRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postAppApiV1UploadUploadfileResult(
    )
    {
        return $this->getSuccessfulContent(...$this->postAppApiV1UploadUploadfile());
    }
    //endregion

    //region postAppApiV1UserSaveuser
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postAppApiV1UserSaveuserRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v1/user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postAppApiV1UserSaveuser(
    ): array
    {
        $response = $this->postAppApiV1UserSaveuserRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postAppApiV1UserSaveuserResult(
    )
    {
        return $this->getSuccessfulContent(...$this->postAppApiV1UserSaveuser());
    }
    //endregion

    //region postAppApiV1UserSaveuserasync
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postAppApiV1UserSaveuserasyncRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v1/user/async', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postAppApiV1UserSaveuserasync(
    ): array
    {
        $response = $this->postAppApiV1UserSaveuserasyncRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postAppApiV1UserSaveuserasyncResult(
    )
    {
        return $this->getSuccessfulContent(...$this->postAppApiV1UserSaveuserasync());
    }
    //endregion

    //region postAppApiV2UserSaveuser
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postAppApiV2UserSaveuserRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v2/user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postAppApiV2UserSaveuser(
    ): array
    {
        $response = $this->postAppApiV2UserSaveuserRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postAppApiV2UserSaveuserResult(
    )
    {
        return $this->getSuccessfulContent(...$this->postAppApiV2UserSaveuser());
    }
    //endregion

    //region postAppApiV3UserSaveuser
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postAppApiV3UserSaveuserRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v3/user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postAppApiV3UserSaveuser(
    ): array
    {
        $response = $this->postAppApiV3UserSaveuserRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postAppApiV3UserSaveuserResult(
    )
    {
        return $this->getSuccessfulContent(...$this->postAppApiV3UserSaveuser());
    }
    //endregion

    //region postCreateUser
    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     */
    public function postCreateUserRaw(
    ): ResponseInterface
    {
        $request = $this->createRequest('POST', '/api/v1/user/create-user', [], []);
        return $this->httpClient->sendRequest($request);
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     */
    public function postCreateUser(
    ): array
    {
        $response = $this->postCreateUserRaw();
        $responseContent = null;
        $contentStrategy = null;
        $contentValidator = null;
        switch ($response->getStatusCode())
        {
            default:
                /*  */
                break;
        }
        $this->parseBody($response, $responseContent, $contentStrategy, $contentValidator);
        return [$responseContent, $response->getHeaders(), $response->getStatusCode(), $response->getReasonPhrase()];
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws DT\Exception\InvalidData
     * @throws OAGAC\Exception\InvalidResponseBodySchema
     * @throws OAGAC\Exception\UnsuccessfulResponse
     */
    public function postCreateUserResult(
    )
    {
        return $this->getSuccessfulContent(...$this->postCreateUser());
    }
    //endregion
}

