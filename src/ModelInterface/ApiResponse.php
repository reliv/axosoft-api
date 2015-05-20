<?php


namespace Reliv\AxosoftApi\ModelInterface;

/**
 * Class ApiResponse
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\AxosoftApi\ModelInterface
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */

interface ApiResponse
{
    /**
     * setResponseData
     *
     * @param array $responseData
     *
     * @return void
     */
    public function setResponseData($responseData);

    /**
     * getResponseData
     *
     * @return array
     */
    public function getResponseData();

    /**
     * getRequestDataProperty
     *
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function getResponseProperty($name, $default = null);
}
