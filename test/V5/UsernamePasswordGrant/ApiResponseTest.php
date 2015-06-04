<?php


namespace Reliv\AxosoftApi\V5\UsernamePasswordGrant;

require_once(__DIR__ . '/../../autoload.php');

class ApiResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testGeneral
     *
     * @return void
     */
    public function testGeneral()
    {
        $data = [
            'access_token' => 'TESTaccess_token',
            'token_type' => 'TESTtoken_type',
            'data' => [
                'some' => 'TESTdata'
            ]
        ];

        $unit = new ApiResponse($data);

        $this->assertEquals($data['access_token'], $unit->getAccessToken());
        $this->assertEquals($data['token_type'], $unit->getTokenType());
        $this->assertEquals($data['data'], $unit->getData());
    }
}
