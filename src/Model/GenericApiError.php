<?php


namespace Reliv\AxosoftApi\Model;

/**
 * Class GenericApiError
 *
 * GenericApiError
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

class GenericApiError extends AbstractApiError
{

    /**
     * @param $responseData
     */
    public function __construct($responseData)
    {
        $this->setResponseData($responseData);
    }

    /**
     * getError
     *
     * @return null
     */
    public function getError()
    {
        return $this->getResponseProperty('error', null);
    }

    /**
     * getDescription
     *
     * @return null
     */
    public function getDescription()
    {
        return $this->getResponseProperty('error_description', null);
    }

    /**
     * getMessage
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->getResponseProperty('error_description', "An error has occured");
    }
}
