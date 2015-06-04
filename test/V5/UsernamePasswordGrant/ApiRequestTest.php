<?php


namespace Reliv\AxosoftApi\V5\UsernamePasswordGrant;

require_once(__DIR__ . '/../../autoload.php');

class ApiRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testGeneral
     *
     * @return void
     */
    public function testGeneral()
    {
        $data = [
            'username' => 'TESTusername',
            'password' => 'TESTpassword',
            'client_id' => 'TESTclient_id',
            'client_secret' => 'TESTclient_secret',
            'scope' => 'TESTscope'
        ];

        $unit = new ApiRequest();

        $unit->setUsername($data['username']);
        $unit->setPassword($data['password']);
        $unit->setClientId($data['client_id']);
        $unit->setClientSecret($data['client_secret']);
        $unit->setScope($data['scope']);

        $requestData = $unit->getRequestParameters();

        $this->assertEquals(
            $data['username'],
            $requestData['username']
        );
        $this->assertEquals($data['password'], $requestData['password']);
        $this->assertEquals($data['client_id'], $requestData['client_id']);
        $this->assertEquals($data['client_secret'], $requestData['client_secret']);
        $this->assertEquals($data['scope'], $requestData['scope']);

        $response = $unit->getResponse([]);

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiResponse',
            $response
        );

        $response = $unit->getResponse(['error' => true]);

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\Model\GenericApiError',
            $response
        );
    }
}
