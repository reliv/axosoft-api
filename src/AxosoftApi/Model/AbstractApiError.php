<?php


namespace Reliv\AxosoftApi\Model;


/**
 * Class AbstractApiError
 *
 * AbstractApiError
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
class AbstractApiError extends AbstractApiResponse
{
    /**
     * getMessage
     *
     * @return string
     */
    public function getMessage()
    {
        return "An error has occured";
    }
}