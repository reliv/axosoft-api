<?php

namespace Reliv\AxosoftApi\Validator;

/**
 * interface Validator
 *
 * Validator interface
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
interface Validator
{
    /**
     * setData - Data to validate
     *
     * @param $data
     *
     * @return mixed
     */
    public function setData($data);

    /**
     * getData return data that is validated
     *
     * @return mixed
     */
    public function getData();

    /**
     * getMessages
     *
     * @return array
     */
    public function getMessages();

    /**
     * isValid
     *
     * @return boolean
     */
    public function isValid();
}
