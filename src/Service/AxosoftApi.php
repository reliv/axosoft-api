<?php

namespace Reliv\AxosoftApi\Service;

use Reliv\AxosoftApi\Model\AbstractApiRequest;
use Reliv\AxosoftApi\Model\GenericApiRequest;
use Reliv\AxosoftApi\ModelInterface\ApiAccessResponse;
use Reliv\AxosoftApi\ModelInterface\ApiError;
use Reliv\AxosoftApi\ModelInterface\ApiRequest;
use Reliv\AxosoftApi\ModelInterface\ApiResponse;

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
     * @var \Reliv\AxosoftApi\ModelInterface\ApiRequest
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
        $this->httpClient = $httpClient;
        $this->authRequest = $authRequest;
    }

    /**
     * getAccessToken
     *
     * @param bool $refresh
     *
     * @return null
     * @throws \Exception
     */
    public function getAccessToken($refresh = false)
    {
        if (empty($this->accessToken) || $refresh) {

            $this->accessToken = null;

            $response = $this->get($this->authRequest);

            if ($response instanceof ApiError) {
                //throw new \Exception('Authorization failed');
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
     * @return mixed
     * @throws \Exception
     */
    public function send(ApiRequest $apiRequest, $refreshAccess = false)
    {
        $accessToken = $this->getAccessToken($refreshAccess);

        $method = $this->getRequestMethod($apiRequest);

        if (!method_exists($this, $method)) {
            throw new \Exception('Method is not supported.');
        }

        return $this->$method($apiRequest, $accessToken);
    }

    /**
     * get
     *
     * @param ApiRequest $apiRequest
     *
     * @return \Reliv\AxosoftApi\ModelInterface\ApiResponse
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
     * @return \Reliv\AxosoftApi\ModelInterface\ApiResponse
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
     * @return \Reliv\AxosoftApi\Model\AbstractApiResponse
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
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function doRequest($method, $url, $options)
    {
        $request = $this->httpClient->createRequest($method, $url, $options);

        try {
            $response = $this->httpClient->send($request);
            $return = $response->json();

        } catch (\Exception $e) {
            $return = [
                'error' => $e->getCode(),
                'error_description' => $e->getMessage()
            ];

        }

        return $return;
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
     * @throws \Exception
     */
    protected function getRequestMethod(ApiRequest $apiRequest)
    {
        $methodKey = $apiRequest->getRequestMethod();

        if (empty($methodKey)) {
            throw new \Exception(
                'Request Method not defined for ' . get_class($apiRequest)
            );
        }

        if (isset($this->methodMap[$methodKey])) {
            return $this->methodMap[$methodKey];
        }
        // default to get
        return 'get';
    }

}