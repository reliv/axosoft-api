<?php

namespace Reliv\AxosoftApi\Model;

/**
 * Class GenericApiResponse
 *
 * GenericApiResponse
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
class GenericApiResponse extends AbstractApiResponse
{
    /**
     * @param $responseData
     */
    public function __construct($responseData)
    {
        $this->setResponseData($responseData);
    }
}
