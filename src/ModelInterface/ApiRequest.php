<?php


namespace Reliv\AxosoftApi\ModelInterface;


/**
 * Interface ApiRequest
 *
 * ApiRequest
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

interface ApiRequest
{
    /**
     * Get Request URL formatted per API request requirements
     *
     * @return string
     */
    public function getRequestUrl();

    /**
     * getRequestMethod
     *
     * @return string
     */
    public function getRequestMethod();

    /**
     * getRequestData
     *
     * @return array
     */
    public function getRequestData();

    /**
     * getRequestParameter
     *
     * @param string $name
     * @param string $value
     *
     * @return mixed
     */
    public function setRequestParameter($name, $value);

    /**
     * getRequestParameters
     *
     * @return array
     */
    public function getRequestParameters();

    /**
     * setRequestHeader
     *
     * @param string $name
     * @param string $value
     *
     * @return mixed
     */
    public function setRequestHeader($name, $value);

    /**
     * getRequestHeaders
     *
     * @return array
     */
    public function getRequestHeaders();

    /**
     * getResponse
     *
     * @param $responseData
     *
     * @return \Reliv\AxosoftApi\ModelInterface\ApiResponse
     */
    public function getResponse($responseData);

    /**
     * Validation of request data
     *
     * @return bool
     */
    public function isValid();
}