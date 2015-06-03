<?php

namespace Reliv\AxosoftApi\V5\Items\Incidents;

use Reliv\AxosoftApi\Model\GenericApiError;
use Reliv\AxosoftApi\Model\GenericApiResponse;
use Reliv\AxosoftApi\V5\ApiCreate\AbstractApiRequestCreate;

/**
 * Class ApiRequestCreate
 *
 * ApiRequestCreate
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
class ApiRequestCreate extends AbstractApiRequestCreate
{
    /**
     * @var string
     */
    protected $requestUrl = '/api/v5/incidents';

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
            return new GenericApiError($responseData);
        }

        return new GenericApiResponse($responseData);
    }
}
