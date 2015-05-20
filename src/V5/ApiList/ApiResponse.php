<?php


namespace Reliv\AxosoftApi\V5\ApiList;

use Reliv\AxosoftApi\Model\AbstractApiResponse;

/**
 * Class ApiResponse
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\AxosoftApi\V5\Items
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ApiResponse extends AbstractApiResponse
{
    /**
     * @param $responseData
     */
    public function __construct($responseData)
    {
        $this->setResponseData($responseData);
    }

    /**
     * getData
     *
     * @return array
     */
    public function getData()
    {
        return $this->responseData['data'];

    }

    /**
     * getMetaData
     *
     * @return array
     */
    public function getMetaData()
    {
        return $this->responseData['metadata'];
    }
}
