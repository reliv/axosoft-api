<?php


namespace Reliv\AxosoftApi\Model;


 /**
 * Class ApiRequestInterface
 *
 * LongDescHere
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

interface ApiRequestInterface extends \JsonSerializable {

    /**
     * Get URL formatted per API request requirements
     *
     * @return string
     */
    public function getUrl();

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
     * @return AbstractApiResponse
     */
    public function getResponse($responseData);

    /**
     * Validation of request data
     *
     * @return bool
     */
    public function isValid();
}