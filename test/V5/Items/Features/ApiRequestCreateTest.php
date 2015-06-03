<?php

namespace Reliv\AxosoftApi\V5\Items\Features;

require_once(__DIR__ . '/../../../autoload.php');

/**
 * Class ApiRequestCreateTest
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\AxosoftApi\V5\Items
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ApiRequestCreateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testGeneral
     *
     * @return void
     */
    public function testGeneral()
    {
        $unit = new ApiRequestCreate();

        $response = $unit->getResponse([]);

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\Model\GenericApiResponse',
            $response
        );

        $response = $unit->getResponse(['error' => true]);

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\Model\GenericApiError',
            $response
        );
    }
}
