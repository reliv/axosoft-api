<?php


namespace Reliv\AxosoftApi\ModelInterface;


/**
 * Interface ApiAccessResponse
 *
 * ApiAccessResponse
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

interface ApiAccessResponse extends ApiResponse
{
    /**
     * getAccessToken
     *
     * @return null|string
     */
    public function getAccessToken();

    /**
     * getTokenType
     *
     * @return null|string
     */
    public function getTokenType();
}