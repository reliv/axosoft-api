<?php

namespace Reliv\AxosoftApi\Model;

require_once(__DIR__ . '/../autoload.php');

/**
 * Class GenericApiErrorTest
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\AxosoftApi\Model
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class GenericApiErrorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * testCase
     *
     * @return void
     */
    public function testCase()
    {
        $testData = [
            'error' => true,
            'error_description' => 'TEST ERR',
        ];

        $unit = new GenericApiError($testData);

        $this->assertTrue($unit->getError());

        $this->assertEquals($testData['error_description'], $unit->getDescription());

        $this->assertEquals($testData['error_description'], $unit->getMessage());

        $this->assertTrue(is_string($unit->getMessage()));
    }
}
