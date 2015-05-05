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

        try {
            // Get Response
            $response = $axosoftApi->send($request);
        } catch(\Exception $exception){
            return ['output' => "Call Failed with exception: \n" . var_export($exception, true)];
        }

        // Handle error
        if ($axosoftApi->hasError($response)) {
            return ['output' => "Call Failed: \n" . var_export($response, true)];
        }

        $dataArray = $response->getResponseData();

        return ['output' => "Call Success: \n" . var_export($dataArray, true)];
    }
}