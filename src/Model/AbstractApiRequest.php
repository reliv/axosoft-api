<?php


namespace Reliv\AxosoftApi\Model;

use Reliv\AxosoftApi\ModelInterface\ApiRequest;


/**
 * Abstract Class AbstractApiRequest
 *
 * Base Class for api requests
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\AxosoftApi\Model
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */

abstract class AbstractApiRequest implements ApiRequest
{
    /**
     * @var string
     */
    protected $requestUrl;

    /**
     * @var string
     */
    protected $requestMethod = 'GET';

    /**
     * @var array
     */
    protected $requestData = [];

    /**
     * @var array
     */
    protected $requestParameters = [];

    /**
     * @var array
     */
    protected $requestHeaders = [];

    /**
     * getRequestUrl
     *
     * @return string
     * @throws \Exception
     */
    public function getRequestUrl()
    {
        if (empty($this->requestUrl)) {
            throw new \Exception('Request Url has not been set for ' . get_class($this));
        }

        $url = $this->requestUrl;

        if(!empty($this->requestParameters)){
            $url = $url . '?' . $this->buildQueryString();
        }

        // FORMAT URL LOGIC HERE

        return $url;
    }

    /**
     * getRequestMethod
     *
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * getData
     *
     * @return array
     */
    public function getRequestData()
    {
        return $this->requestData;
    }

    /**
     * getRequestDataProperty
     *
     * @param      $name
     * @param null $default
     *
     * @return null
     */
    public function getRequestProperty($name, $default = null)
    {
        if ($this->requestData[$name]) {

            return $this->requestData[$name];
        }

        return $default;
    }

    /**
     * getRequestParameter
     *
     * @param string $name
     * @param string $value
     *
     * @return mixed
     */
    public function setRequestParameter($name, $value)
    {
        $name = (string) $name;
        $this->requestParameters[$name] = (string) $value;
    }

    /**
     * getRequestParameters
     *
     * @return array
     */
    public function getRequestParameters()
    {
        return $this->requestParameters;
    }

    /**
     * getParameter
     *
     * @param      $name
     * @param null $default
     *
     * @return null
     */
    public function getParameter($name, $default = null)
    {
        if ($this->requestParameters[$name]) {

            return $this->requestParameters[$name];
        }

        return $default;
    }

    /**
     * setRequestHeader
     *
     * @param string $name
     * @param string $value
     *
     * @return mixed
     */
    public function setRequestHeader($name, $value)
    {
        $name = (string) $name;
        $this->requestHeaders[$name] = (string) $value;
    }

    /**
     * getRequestHeaders
     *
     * @return array
     */
    public function getRequestHeaders()
    {
        return $this->requestHeaders;
    }

    /**
     * getQueryString
     *
     * @return string
     */
    protected function buildQueryString()
    {
        return http_build_query($this->requestParameters);
    }

    /**
     * getResponse - Override this
     *
     * @param $responseData
     *
     * @return AbstractApiResponse
     * @throws \Exception
     */
    public function getResponse($responseData)
    {
        throw new \Exception('No response created');
    }

    /**
     * isValid
     *
     * @return bool
     */
    public function isValid()
    {
        return true;
    }
}