<?php


namespace Reliv\AxosoftApi\Service;

use Reliv\AxosoftApi\Exception\AxosoftApiException;
use Reliv\AxosoftApi\Model\GenericApiError;
use Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiRequest;

require_once(__DIR__ . '/../autoload.php');

/**
 * Class AxosoftApiTest
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\AxosoftApi\Service
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class AxosoftApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * getMockHttpRequest
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockHttpRequest()
    {
        $mockRequest = $this->getMockBuilder(
            '\GuzzleHttp\Message\RequestInterface'
        )
            ->disableOriginalConstructor()
            ->getMock();

        return $mockRequest;
    }

    /**
     * getMockHttpResponse
     *
     * @param array $httpData
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockHttpResponse(
        $httpData = [
            'error' => 1,
            'error_description' => 'TESTERR'
        ]
    ) {
        $httpBody = json_encode($httpData);



        $mockResponseBody = $this->getMockBuilder(
            '\GuzzleHttp\Psr7\Stream'
        )
            ->disableOriginalConstructor()
            ->getMock();

        $mockResponseBody->expects($this->any())
            ->method('getContents')
            ->will(
                $this->returnValue($httpBody)
            );

        $mockResponse = $this->getMockBuilder(
            '\GuzzleHttp\Psr7\Response'
        )
            ->disableOriginalConstructor()
            ->getMock();

        $mockResponse->expects($this->any())
            ->method('getBody')
            ->will(
                $this->returnValue($mockResponseBody)
            );

        return $mockResponse;
    }

    /**
     * getMockHttpClient
     *
     * @param int   $hasError
     * @param array $httpResponseData
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockHttpClient(
        $hasError = 0,
        $httpResponseData
        = [
            'error' => 1,
            'error_description' => 'TESTERR'
        ]
    ) {
        $mockRequest = $this->getMockHttpRequest();
        $mockResponse = $this->getMockHttpResponse($httpResponseData);

        $sendCallback = function () use ($mockResponse) {
            return $mockResponse;
        };

        if ($hasError == 1) {
            $sendCallback = function ($mockRequest) use ($mockResponse) {
                throw new \GuzzleHttp\Exception\RequestException(
                    'TESTGUZERR',
                    $mockRequest,
                    $mockResponse
                );
            };
        }
        if ($hasError == 2) {
            $sendCallback = function ($mockRequest) use ($mockResponse) {
                throw new \Exception(
                    'TESTGENERR',
                    500
                );
            };
        }

        $mockHttpClient = $this->getMockBuilder(
            '\GuzzleHttp\Client'
        )
            ->disableOriginalConstructor()
            ->getMock();
        $mockHttpClient->expects($this->any())
            ->method('request')
            ->will(
                $this->returnCallback($sendCallback)
            );

        return $mockHttpClient;
    }

    /**
     * getMockApiRequest
     *
     * @param array $mockData
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockApiRequest(
        $mockData
        = [
            'request' => [
                'class' => '\Reliv\AxosoftApi\Model\ApiRequest',
                'requestMethod' => 'GET'
            ],
            'response' => [
                'class' => '\Reliv\AxosoftApi\Model\ApiResponse',
                'data' => [
                    'error' => 1,
                    'error_description' => 'TESTERR'
                ]
            ]
        ]
    ) {

        $mockApiResponse = $this->getMockBuilder(
            $mockData['response']['class']
        )
            ->disableOriginalConstructor()
            ->getMock();

        $mockApiResponse->expects($this->any())
            ->method('getResponseData')
            ->will(
                $this->returnValue($mockData['response']['data'])
            );

        if (isset($mockData['response']['data']['access_token'])) {
            $mockApiResponse->expects($this->any())
                ->method('getAccessToken')
                ->will(
                    $this->returnValue($mockData['response']['data']['access_token'])
                );
        }
        ////

        $mockApiRequest = $this->getMockBuilder(
            $mockData['request']['class']
        )
            ->disableOriginalConstructor()
            ->getMock();

        $mockApiRequest->expects($this->any())
            ->method('getRequestMethod')
            ->will(
                $this->returnValue($mockData['request']['requestMethod'])
            );

        $mockApiRequest->expects($this->any())
            ->method('getResponse')
            ->will(
                $this->returnValue($mockApiResponse)
            );

        return $mockApiRequest;
    }

    /**
     * testService
     *
     * @return void
     */
    public function testSendAccess()
    {
        //// Success Access

        $mockHttpClient = $this->getMockHttpClient();

        $mockGrantApiRequest = $this->getMockApiRequest(
            [
                'request' => [
                    'class' => '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiRequest',
                    'requestMethod' => 'POST'
                ],
                'response' => [
                    'class' => '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiResponse',
                    'data' => [
                        'access_token' => 'TESTTOKEN'
                    ]
                ]
            ]
        );

        $unit = new AxosoftApi($mockHttpClient, $mockGrantApiRequest);

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiResponse',
            $unit->send($mockGrantApiRequest)
        );

        //// Error send

        $mockHttpClient = $this->getMockHttpClient(1);

        $mockGrantApiRequest = $this->getMockApiRequest(
            [
                'request' => [
                    'class' => '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiRequest',
                    'requestMethod' => 'GET'
                ],
                'response' => [
                    'class' => '\Reliv\AxosoftApi\Model\GenericApiError',
                    'data' => [
                        'error' => 1,
                        'error_description' => 'TESTERR'
                    ]
                ]
            ]
        );

        $unit = new AxosoftApi($mockHttpClient, $mockGrantApiRequest);

        $errResponse = $unit->send($mockGrantApiRequest);

        $this->assertTrue(
            $unit->hasError($errResponse)
        );

        //// Error send 2

        $mockHttpClient = $this->getMockHttpClient(2);

        $mockGrantApiRequest = $this->getMockApiRequest(
            [
                'request' => [
                    'class' => '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiRequest',
                    'requestMethod' => 'GET'
                ],
                'response' => [
                    'class' => '\Reliv\AxosoftApi\Model\GenericApiError',
                    'data' => [
                        'error' => 1,
                        'error_description' => 'TESTERR'
                    ]
                ]
            ]
        );

        $unit = new AxosoftApi($mockHttpClient, $mockGrantApiRequest);

        $errResponse = $unit->send($mockGrantApiRequest);

        $this->assertTrue(
            $unit->hasError($errResponse)
        );

        ////

        $mockHttpClient = $this->getMockHttpClient();

        $mockGrantApiRequest = $this->getMockApiRequest(
            [
                'request' => [
                    'class' => '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiRequest',
                    'requestMethod' => 'GET'
                ],
                'response' => [
                    'class' => '\Reliv\AxosoftApi\Model\GenericApiError',
                    'data' => [
                        'error' => 1,
                        'error_description' => 'TESTERR'
                    ]
                ]
            ]
        );

        $unit = new AxosoftApi($mockHttpClient, $mockGrantApiRequest);

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\Model\GenericApiError',
            $unit->send($mockGrantApiRequest)
        );

        ////

        $mockHttpClient = $this->getMockHttpClient();

        $mockGrantApiRequest = $this->getMockApiRequest(
            [
                'request' => [
                    'class' => '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiRequest',
                    'requestMethod' => 'DELETE'
                ],
                'response' => [
                    'class' => '\Reliv\AxosoftApi\Model\GenericApiError',
                    'data' => [
                        'error' => 1,
                        'error_description' => 'TESTERR'
                    ]
                ]
            ]
        );

        $unit = new AxosoftApi($mockHttpClient, $mockGrantApiRequest);

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\Model\GenericApiError',
            $unit->send($mockGrantApiRequest)
        );

        ////

        $mockHttpClient = $this->getMockHttpClient();

        $mockGrantApiRequest = $this->getMockApiRequest(
            [
                'request' => [
                    'class' => '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiRequest',
                    'requestMethod' => ''
                ],
                'response' => [
                    'class' => '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiResponse',
                    'data' => []
                ]
            ]
        );

        $unit = new AxosoftApi($mockHttpClient, $mockGrantApiRequest);

        $hasException = false;

        try {
            $unit->send($mockGrantApiRequest);
        } catch (AxosoftApiException $exception) {
            $hasException = true;
        }

        $this->assertTrue($hasException);

        ////

        $mockHttpClient = $this->getMockHttpClient();

        $mockGrantApiRequest = $this->getMockApiRequest(
            [
                'request' => [
                    'class' => '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiRequest',
                    'requestMethod' => 'NOPE'
                ],
                'response' => [
                    'class' => '\Reliv\AxosoftApi\V5\UsernamePasswordGrant\ApiResponse',
                    'data' => []
                ]
            ]
        );

        $unit = new AxosoftApi($mockHttpClient, $mockGrantApiRequest);

        $hasException = false;

        try {
            $unit->send($mockGrantApiRequest);
        } catch (AxosoftApiException $exception) {
            $hasException = true;
        }

        $this->assertTrue($hasException);
    }
}
