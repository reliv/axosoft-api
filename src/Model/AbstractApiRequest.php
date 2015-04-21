<?php


namespace Reliv\AxosoftApi\Model;


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

abstract class AbstractApiRequest implements ApiRequestInterface
{
    /**
     * @var string
     */
    protected $url;

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
     * getUrl
     *
     * @return string
     * @throws \Exception
     */
    public function getUrl()
    {
        if (empty($this->url)) {
            throw new \Exception('URL has not been set for ' . get_class($this));
        }

        $url = $this->url;

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

    /**
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *       which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->getRequestData();
    }
}