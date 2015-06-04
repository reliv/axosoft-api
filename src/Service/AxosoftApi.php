<?php

namespace Reliv\AxosoftApi\Service;

use GuzzleHttp\Exception\RequestException;
use Reliv\AxosoftApi\Exception\AxosoftApiException;
use Reliv\AxosoftApi\Model\ApiAccessResponse;
use Reliv\AxosoftApi\Model\ApiError;
use Reliv\AxosoftApi\Model\ApiRequest;
use Reliv\AxosoftApi\Model\ApiResponse;

/**
 * Class AxosoftApi
 *
 * AxosoftApi Service Facade
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class AxosoftApi
{
    /**
     * @var \Reliv\AxosoftApi\Model\ApiRequest
     */
    protected $authRequest;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * @var null|string
     */
    protected $accessToken = null;

    /**
     * @var array
     */
    protected $methodMap
        = [
            'POST' => 'post',
            'GET' => 'get',
            'DELETE' => 'delete'
        ];

    /**
     * @param $httpClient
     * @param $authRequest
     */
    public function __construct($httpClient, $authRequest)
    {
        $this->setHttpClient($httpClient);
        $this->authRequest = $authRequest;
    }

    /**
     * setHttpClient
     *
     * @param $httpClient
     *
     * @return void
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * getAccessToken
     *
     * @todo Implement local storage to hold this if configured
     *
     * @param bool $refresh
     *
     * @return null|string
     */
    public function getAccessToken($refresh = false)
    {
        if (empty($this->accessToken) || $refresh) {
            $this->accessToken = null;

            $response = $this->get($this->authRequest);

            if ($response instanceof ApiError) {
                //throw new AxosoftApiException('Authorization failed');
                $this->accessToken = null;
            }

            if ($response instanceof ApiAccessResponse) {
                $this->accessToken = $response->getAccessToken();
            }
        }

        return $this->accessToken;
    }

    /**
     * send
     *
     * @param ApiRequest $apiRequest
     * @param bool       $refreshAccess
     *
     * @return \Reliv\AxosoftApi\Model\ApiResponse
     * @throws AxosoftApiException
     */
    public function send(ApiRequest $apiRequest, $refreshAccess = false)
    {
        $accessToken = $this->getAccessToken($refreshAccess);

        $method = $this->getRequestMethod($apiRequest);

        return $this->$method($apiRequest, $accessToken);
    }

    /**
     * get
     *
     * @param ApiRequest $apiRequest
     *
     * @return \Reliv\AxosoftApi\Model\ApiResponse
     */
    public function get(ApiRequest $apiRequest)
    {
        $this->prepareRequest($apiRequest);

        $data = $this->doRequest(
            'GET',
            $apiRequest->getRequestUrl(),
            [
                'headers' => $apiRequest->getRequestHeaders(),
            ]
        );

        return $apiRequest->getResponse($data);
    }

    /**
     * post
     *
     * @param ApiRequest $apiRequest
     *
     * @return \Reliv\AxosoftApi\Model\ApiResponse
     */
    public function post(ApiRequest $apiRequest)
    {
        $this->prepareRequest($apiRequest);

        $data = $this->doRequest(
            'POST',
            $apiRequest->getRequestUrl(),
            [
                'headers' => $apiRequest->getRequestHeaders(),
                'body' => json_encode($apiRequest->getRequestData())
            ]
        );

        return $apiRequest->getResponse($data);
    }

    /**
     * delete
     *
     * @param ApiRequest $apiRequest
     *
     * @return \Reliv\AxosoftApi\Model\ApiResponse
     */
    public function delete(ApiRequest $apiRequest)
    {
        $this->prepareRequest($apiRequest);

        $data = $this->doRequest(
            'DELETE',
            $apiRequest->getRequestUrl(),
            [
                'headers' => $apiRequest->getRequestHeaders(),
            ]
        );

        return $apiRequest->getResponse($data);
    }

    /**
     * doRequest
     *
     * @param string $method
     * @param string $url
     * @param array  $options
     *
     * @return array
     */
    public function doRequest($method, $url, $options)
    {
        $request = $this->httpClient->createRequest($method, $url, $options);

        try {
            $response = $this->httpClient->send($request);
            $return = $response->json();
        } catch (\Exception $exception) {
            $return = $this->handleHttpClientError($exception);
        }

        return $return;
    }

    /**
     * hasError - check if a response in and error response
     *
     * @param ApiResponse $response
     *
     * @return bool
     */
    public function hasError(ApiResponse $response)
    {
        return ($response instanceof ApiError);
    }

    /**
     * handleHttpClientError
     *
     * @param \Exception $exception
     *
     * @return mixed
     */
    public function handleHttpClientError(\Exception $exception)
    {

        if ($exception instanceof RequestException) {
            return $exception->getResponse()->json();
        }

        return [
            'error' => $exception->getCode(),
            'error_description' => $exception->getMessage()
        ];
    }

    /**
     * prepareRequest
     *
     * @param ApiRequest $apiRequest
     *
     * @return ApiRequest
     */
    protected function prepareRequest(ApiRequest $apiRequest)
    {
        // @todo this only supports V5 of the Auth header
        // may not be an issue if it does not change
        if (!empty($this->accessToken)) {
            $apiRequest->setRequestHeader(
                'Authorization',
                'Bearer ' . $this->accessToken
            );
            $apiRequest->setRequestHeader(
                'X-Authorization',
                'Bearer ' . $this->accessToken
            );
        }

        $apiRequest->setRequestHeader('Content-Type', 'application/json');

        return $apiRequest;
    }

    /**
     * getRequestMethod
     *
     * @param ApiRequest $apiRequest
     *
     * @return string
     * @throws AxosoftApiException
     */
    protected function getRequestMethod(ApiRequest $apiRequest)
    {
        $methodKey = $apiRequest->getRequestMethod();

        if (empty($methodKey)) {
            throw new AxosoftApiException(
                'Request Method not defined for ' . get_class($apiRequest)
            );
        }

        if (isset($this->methodMap[$methodKey])) {
            return $this->methodMap[$methodKey];
        }

        throw new AxosoftApiException('Method is not supported.');
    }
}
