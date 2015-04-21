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
        $summary = 'Test Anti Dup';
        /** @var \Reliv\AxosoftApi\Service\AxosoftApi $api */
        $api = $this->getServiceLocator()->get('Reliv\AxosoftApi\Service\AxosoftApi');

        $request = new ApiRequestList();
        $request->setProjectId(10);
        $request->setSearchString($summary);
        $request->setSearchField('name');
        $request->setPage(1);
        $request->setPageSize(1);

        //var_dump('ApiRequest.data: ', $request->getRequestData());

        /** @var \Reliv\AxosoftApi\ModelInterface\ApiResult $response */
        $response = $api->send($request);

        //var_dump('ApiResponse.data: ', $response->getResponseData());

        $data = $response->getData();

        //var_dump('ApiList\ApiResponse.data: ', $data);

        if(count($data) === 0){
            // Add a new defect
            $request = new ApiRequestCreate();
            var_dump('ApiRequestCreate.data: ', $request->getRequestData());

            $request->setDescription('New Description');
            $request->setName($summary);
            $request->setNotes('New Note');

            $response = $api->send($request);
            var_dump('ApiResponseCreate.data: ', $response->getResponseData());
        } else {

            $updateData = [];

            $updateDate = new \DateTime();
            $updateData['notify_customer'] = false;
            $updateData['item'] = []; //$data[0];

            $updateData['item']['description'] = $data[0]['description'] . "<br/>-This has been added on " . $updateDate->format(\DateTime::W3C);

            //$updateData['item']['notes'] = $data[0]['notes'] . "/n-This has been added on " . $updateDate->format(\DateTime::W3C);
            $updateData['item']['id'] = $data[0]['id'];

            $updateUrl = '/api/v5/'.$data[0]['item_type'] . '/' . $data[0]['id'];

            $request = new GenericApiRequest($updateUrl, 'POST', $updateData);
            var_dump('ApiRequestUpdate.data: ', $request->getRequestData());

            $response = $api->send($request);
            var_dump('ApiResponseUpdate.data: ', $response->getResponseData());
        }

        die;
    }
}