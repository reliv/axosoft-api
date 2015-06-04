<?php


namespace Reliv\AxosoftApi\Model;

use Reliv\AxosoftApi\Exception\AxosoftApiException;

require_once(__DIR__ . '/../autoload.php');

class GenericApiRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testCase
     *
     * @return void
     */
    public function testGeneral()
    {
        $testData = [
            'requestUrl' => '//test/url',
            'requestMethod' => 'SOMEMETHOD',
            'requestData' => [
                'some' => 'data'
            ],
            'parameters' => [
                'some' => 'param'
            ]
        ];

        $unit = new GenericApiRequest(
            $testData['requestUrl'],
            $testData['requestMethod'],
            $testData['requestData'],
            $testData['parameters']
        );

        $this->assertEquals(
            $testData['requestData']['some'],
            $unit->getRequestProperty('some')
        );
        $this->assertEquals(null, $unit->getRequestProperty('nope'));
        $this->assertEquals('default', $unit->getRequestProperty('nope', 'default'));

        $this->assertEquals(
            $testData['parameters']['some'],
            $unit->getRequestParameter('some')
        );
        $this->assertEquals(null, $unit->getRequestParameter('nope'));
        $this->assertEquals(
            'default',
            $unit->getRequestParameter('nope', 'default')
        );

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\Model\GenericApiResponse',
            $unit->getResponse([])
        );

        $this->assertInstanceOf(
            '\Reliv\AxosoftApi\Model\GenericApiError',
            $unit->getResponse(['error' => true])
        );

        $this->assertTrue($unit->isValid());

        // Test Abstract too

        $unit->setRequestDataProperty('more', 'data');
        $this->assertEquals('data', $unit->getRequestProperty('more'));

        $unit->setRequestParameter('more', 'param');
        $this->assertEquals('param', $unit->getRequestParameter('more'));

        $this->assertTrue(is_string($unit->getRequestUrl()));

        $this->assertTrue(is_string($unit->getRequestMethod()));

        $this->assertTrue(is_array($unit->getRequestData()));

        $this->assertTrue(is_array($unit->getRequestParameters()));

        $unit->setRequestHeader('some', 'header');

        $this->assertTrue(is_array($unit->getRequestHeaders()));

        $this->assertTrue($unit->isValid());
    }

    /**
     * testValidate
     *
     * @return void
     */
    public function testValidate()
    {
        $mockValidator = $this->getMockBuilder(
            '\Reliv\AxosoftApi\Validator\Validator'
        )
            ->disableOriginalConstructor()
            ->getMock();

        $mockValidator->expects($this->any())
            ->method('isValid')
            ->will(
                $this->returnValue(false)
            );

        $testData = [
            'requestUrl' => null,
            'requestMethod' => 'SOMEMETHOD',
            'requestData' => [
                'some' => 'data'
            ],
            'parameters' => [
                'some' => 'param'
            ]
        ];

        $unit = new GenericApiRequest(
            $testData['requestUrl'],
            $testData['requestMethod'],
            $testData['requestData'],
            $testData['parameters']
        );

        $unit->setValidator($mockValidator);

        $this->assertFalse($unit->isValid());

        // Test Abstract too

        $hasException = false;

        try {
            $unit->getRequestUrl();
        } catch (AxosoftApiException $exception) {
            $hasException = true;
        }

        $this->assertTrue($hasException);
    }
}
