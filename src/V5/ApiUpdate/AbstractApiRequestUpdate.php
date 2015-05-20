<?php

namespace Reliv\AxosoftApi\V5\ApiUpdate;

use Reliv\AxosoftApi\V5\ApiCreate\AbstractApiRequestCreate;

/**
 * Class AbstractApiRequestUpdate
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
class AbstractApiRequestUpdate extends AbstractApiRequestCreate
{
    /**
     * @var string
     */
    protected $requestMethod = 'POST';
}
