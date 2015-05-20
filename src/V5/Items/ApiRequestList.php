<?php

namespace Reliv\AxosoftApi\V5\Items;

use Reliv\AxosoftApi\V5\ApiList\AbstractApiRequestList;

/**
 * Class ApiRequestList
 *
 * ApiRequestList
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ApiRequestList extends AbstractApiRequestList
{
    /**
     * @var string
     */
    protected $requestUrl = '/api/v5/items';

    /**
     * @var string
     */
    protected $requestMethod = 'GET';

    /**
     * getResponse
     *
     * @param $responseData
     *
     * @return \Reliv\AxosoftApi\Model\AbstractApiResponse
     */
    public function getResponse($responseData)
    {
        if (isset($responseData['error'])) {
            return new ApiError($responseData);
        }

        return new ApiResponse($responseData);
    }
}
