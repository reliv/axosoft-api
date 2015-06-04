<?php


namespace Reliv\AxosoftApi\V5\Items;

require_once(__DIR__ . '/../../autoload.php');

/**
 * Class ApiRequestListTest
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
class ApiRequestListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testGeneral
     *
     * @return void
     */
    public function testGeneral()
    {
        $unit = new ApiRequestList();

        $response = $unit->getResponse([]);

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\V5\Items\ApiResponseList',
            $response
        );

        $response = $unit->getResponse(['error' => true]);

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\Model\AbstractApiError',
            $response
        );
    }
}
