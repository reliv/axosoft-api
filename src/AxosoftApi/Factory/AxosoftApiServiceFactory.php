<?php

namespace Reliv\AxosoftApi\Factory;

use Reliv\AxosoftApi\Service\AxosoftApi;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AxosoftApiServiceFactory
 *
 * AxosoftApiServiceFactory
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

class AxosoftApiServiceFactory implements FactoryInterface
{
    /**
     * createService
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return AxosoftApi
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $configRoot = $serviceLocator->get('Config');

        $httpClient = $serviceLocator->get('AxosoftApi\Service\HttpClient');

        $authRequest = $serviceLocator->get('AxosoftApi\Grant\ApiRequest');

        return new AxosoftApi($httpClient, $authRequest);
    }
}