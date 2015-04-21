<?php

namespace Reliv\AxosoftApi\Controller;

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
        $api = $this->getServiceLocator()->get('Reliv\AxosoftApi\Service\AxosoftApi');

        var_dump($api);die;
    }
}