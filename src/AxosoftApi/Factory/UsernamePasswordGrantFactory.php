<?php

namespace Reliv\AxosoftApi\Factory;

use Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiRequest;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class UsernamePasswordGrantFactory
 *
 * UsernamePasswordGrantFactory
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

class UsernamePasswordGrantFactory implements FactoryInterface
{
    /**
     * createService
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return Config
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $configRoot = $serviceLocator->get('Config');

        $apiRequest = new ApiRequest();
        $apiRequest->setUsername($configRoot['AxosoftApi']['UsernamePasswordGrant']['username']);
        $apiRequest->setPassword($configRoot['AxosoftApi']['UsernamePasswordGrant']['password']);
        $apiRequest->setClientId($configRoot['AxosoftApi']['UsernamePasswordGrant']['clientId']);
        $apiRequest->setClientSecret($configRoot['AxosoftApi']['UsernamePasswordGrant']['clientSecret']);
        $apiRequest->setScope($configRoot['AxosoftApi']['UsernamePasswordGrant']['scope']);

        return $apiRequest;
    }
}