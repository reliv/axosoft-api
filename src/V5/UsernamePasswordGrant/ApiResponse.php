<?php


namespace Reliv\AxosoftApi\V5\UsernamePasswordGrant;

use Reliv\AxosoftApi\Model\AbstractApiResponse;
use Reliv\AxosoftApi\ModelInterface\ApiAccessResponse;

/**
 * Class ApiResponse
 *
 * ApiResponse
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\AxosoftApi\V5\UsernamePasswordGrant
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ApiResponse extends AbstractApiResponse implements ApiAccessResponse
{

    /**
     * @param $responseData
     * {
     * "access_token" : "10101010-1010-1010-1010-101010101010",
     * "token_type" : "bearer",
     * "data" : {
     * "id" : 7,
     * "first_name" : "Cathy",
     * "last_name" : "O'Reilly (Dev)",
     * "email" : "Cathy.Oreilly@mycompany.com"
     * }
     * }
     */
    public function __construct($responseData)
    {
        $this->setResponseData($responseData);
    }

    /**
     * getAccessToken
     *
     * @return null|string
     */
    public function getAccessToken()
    {
        return $this->getResponseProperty('access_token', null);
    }

    /**
     * getTokenType
     *
     * @return null|string
     */
    public function getTokenType()
    {
        return $this->getResponseProperty('token_type', null);
    }

    /**
     * getData
     *
     * @return array
     */
    public function getData()
    {
        return $this->getResponseProperty('data', []);
    }
}