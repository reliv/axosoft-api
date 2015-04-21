<?php

namespace AxosoftApi\Service;

use AxosoftApi\Model\AbstractApiError;
use AxosoftApi\Model\ApiRequestInterface;
use AxosoftApi\Model\Connection;
use AxosoftApi\V5\UsernamePasswordGrant\ApiError;
use AxosoftApi\V5\UsernamePasswordGrant\ApiResponse;
use Guzzle\Http\Client;

/**
 * Class AxosoftApi
 *
 * LongDescHere
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
     * @var
     */
    protected $authRequest;

    /**
     * @var null
     */
    protected $httpClient;

    /**
     * @var null
     */
    protected $accessToken = null;

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
            $response = $this->get($this->authRequest);

            if ($response instanceof AbstractApiError) {
                //throw new \Exception('Authorization failed');
                $this->accessToken = null;
            }
            if ($response instanceof ApiResponse) {
                $this->accessToken = $response->getAccessToken();
            }
        }

        return $this->accessToken;
    }

    /**
     * send
     *
     * @param ApiRequestInterface $apiRequest
     *
     * @return mixed
     * @throws \Exception
     */
    public function send(ApiRequestInterface $apiRequest, $refreshAccess = false)
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
     * @param ApiRequestInterface $apiRequest
     * @param null                $accessToken
     *
     * @return \AxosoftApi\Model\AbstractApiResponse
     */
    public function get(ApiRequestInterface $apiRequest, $accessToken = null)
    {
        $headers = $this->buildHeaders($apiRequest, $accessToken);

        $response = $this->httpClient->get(
            $apiRequest->getUrl(),
            [
                'headers' => $headers,
            ]
        );

        $data = $response->json();

        return $apiRequest->getResponse($data);
    }

    /**
     * post
     *
     * @param ApiRequestInterface $apiRequest
     * @param null                $accessToken
     *
     * @return \AxosoftApi\Model\AbstractApiResponse
     */
    public function post(ApiRequestInterface $apiRequest, $accessToken = null)
    {
        $headers = $this->buildHeaders($apiRequest, $accessToken);
        $response = $this->httpClient->post(
            $apiRequest->getUrl(),
            [
                'headers' => $headers,
                'body' => $apiRequest->getRequestData()
            ]
        );

        $data = $response->json();

        return $apiRequest->getResponse($data);
    }

    /**
     * delete
     *
     * @param ApiRequestInterface $apiRequest
     * @param null                $accessToken
     *
     * @return \AxosoftApi\Model\AbstractApiResponse
     */
    public function delete(ApiRequestInterface $apiRequest, $accessToken = null)
    {
        $headers = $this->buildHeaders($apiRequest, $accessToken);

        $response = $this->httpClient->delete(
            $apiRequest->getUrl(),
            [
                'headers' => $headers,
            ]
        );

        $data = $response->json();

        return $apiRequest->getResponse($data);
    }

    /**
     * buildHeaders
     *
     * @param ApiRequestInterface $apiRequest
     * @param null                $accessToken
     *
     * @return array
     */
    protected function buildHeaders(ApiRequestInterface $apiRequest, $accessToken = null)
    {
        $headers = $apiRequest->getRequestHeaders();

        if($accessToken){
            $headers['Authorization'] = 'Bearer ' . $accessToken;
        }

        return $headers;
    }

    /**
     * getRequestMethod
     *
     * @param ApiRequestInterface $apiRequest
     *
     * @return string
     */
    protected function getRequestMethod(ApiRequestInterface $apiRequest)
    {
        return strtolower($apiRequest->getRequestMethod());
    }

}