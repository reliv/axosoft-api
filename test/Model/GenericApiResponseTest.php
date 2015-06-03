<?php


namespace Reliv\AxosoftApi\Model;

require_once(__DIR__ . '/../autoload.php');

class GenericApiResponseTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $data = [
            'some' => 'data'
        ];
        $unit = new GenericApiResponse($data);

        // Test Abstract too

        $this->assertEquals($unit->getResponseData(), $data);

        $this->assertEquals($data['some'], $unit->getResponseProperty('some'));
        $this->assertEquals(null, $unit->getResponseProperty('nope'));
        $this->assertEquals(
            'default',
            $unit->getResponseProperty('nope', 'default')
        );
    }
}
