<?php

namespace Reliv\AxosoftApi\Controller;

use Reliv\AxosoftApi\Model\GenericApiRequest;
use Reliv\AxosoftApi\V5\Items\Defects\ApiRequestCreate;
use Reliv\AxosoftApi\V5\Items\ApiRequestList;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class IndexController
 *
 * Test controlle
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
class IndexController extends AbstractActionController
{

    /**
     * getConfig
     *
     * @return mixed
     */
    public function getConfig()
    {

        $config = $this->getServiceLocator()
            ->get('config');

        return $config['Reliv\AxosoftApi'];
    }

    /**
     * getApi
     *
     * @return array|object
     */
    public function getApi()
    {

        return $this->getServiceLocator()
            ->get('Reliv\AxosoftApi\Service\AxosoftApi');
    }

    /**
     * getProjectIdParam
     *
     * @param int $default
     *
     * @return mixed
     */
    protected function getProjectIdParam($default = null)
    {
        return $this->params()->fromQuery('projectId', $default);
    }

    /**
     * readTestAction
     *
     * @return array|\Zend\Stdlib\ResponseInterface
     */
    public function readTestAction()
    {
        $config = $this->getConfig();

        if ($config['AllowTest'] !== true) {
            $res = $this->getResponse();
            $res->setStatusCode(404);

            return $res;
        }

        // Build request
        $request = new GenericApiRequest('/api/v5/projects');

        return $this->getOutput($request);
    }

    /**
     * writeTestAction
     *
     * @return \Zend\Stdlib\ResponseInterface
     * @throws AxosoftLoggerException
     */
    public function writeTestAction()
    {
        $config = $this->getConfig();

        if ($config['AllowTest'] !== true) {
            $res = $this->getResponse();
            $res->setStatusCode(404);

            return $res;
        }

        $request = new ApiRequestCreate();
        $dateTime = new \DateTime();

        $request->setDescription('TEST ISSUE - submited: ' . $dateTime->format(DATE_W3C));
        $request->setName('TEST ISSUE - submited: ' . $dateTime->format(DATE_W3C));
        $request->setProject($this->getProjectIdParam(0));

        return $this->getOutput($request);
    }

    /**
     * getOutput
     *
     * @param $request
     *
     * @return array
     */
    public function getOutput($request)
    {
        $axosoftApi = $this->getApi();

        $reqOutput = "Request: \n" . var_export($request,
            true);

        try {
            // Get Response
            $response = $axosoftApi->send($request);
        } catch (\Exception $exception) {
            return [
                'output' => $reqOutput . "Call Failed with exception: \n" . var_export($exception,
                        true)
            ];
        }

        // Handle error
        if ($axosoftApi->hasError($response)) {
            return ['output' => $reqOutput . "Call Failed: \n" . var_export($response, true)];
        }

        $dataArray = $response->getResponseData();

        return ['output' => $reqOutput . "Call Success: \n" . var_export($dataArray, true) . var_export($this->getConfig(), true)];
    }
}