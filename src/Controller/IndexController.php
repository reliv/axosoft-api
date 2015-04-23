<?php

namespace Reliv\AxosoftApi\Controller;

use Reliv\AxosoftApi\Model\GenericApiRequest;
use Reliv\AxosoftApi\V5\Items\Defects\ApiRequestCreate;
use Reliv\AxosoftApi\V5\Items\ApiRequestList;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class IndexController
 *
 * LongDescHere
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

class IndexController extends AbstractActionController {

    public function indexAction()
    {
        //var_dump('test');

        // Get AxosoftApi from ZF2 service manager
        $axosoftApi = $this->getServiceLocator()->get('Reliv\AxosoftApi\Service\AxosoftApi');

        // Build request
        $request = new GenericApiRequest('/api/v5/projects');

        // Get Response
        $response = $axosoftApi->send($request);

        // Handle error
        if ($axosoftApi->hasError($response)) {
            throw new \Exception('Call Failed.');
        }

        $dataArray = $response->getResponseData();

        //var_dump($dataArray);

        return [];
    }
}