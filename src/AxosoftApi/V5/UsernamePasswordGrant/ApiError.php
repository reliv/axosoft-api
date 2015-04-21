<?php


namespace AxosoftApi\V5\UsernamePasswordGrant;

use AxosoftApi\Model\AbstractApiError;


/**
 * Class ApiError
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   AxosoftApi\V5\UsernamePasswordGrant
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ApiError extends AbstractApiError
{
    /**
     * getMessage
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->responseData['error_description'];
    }
}