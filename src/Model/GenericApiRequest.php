<?php


namespace Reliv\AxosoftApi\Model;


/**
 * Class GenericApiRequest
 *
 * GenericApiRequest
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\AxosoftApi\Model
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */

class GenericApiRequest extends AbstractApiRequest
{
    /**
     * @var string
     */
    protected $requestUrl;

    /**
     * @var string
     */
    protected $requestMethod = 'GET';

    /**
     * @var array
     */
    protected $requestData = [];

    /**
     * @var array
     */
    protected $requestParameters = [];

    /**
     * @var object|null
     */
    protected $validator = null;

    /**
     * @param string $requestUrl
     * @param string $requestMethod
     * @param array  $properties
     * @param array  $parameters
     */
    public function __construct($requestUrl, $requestMethod = 'GET', $properties = [], $parameters = [])
    {
        $this->requestUrl = (string)$requestUrl;
        $this->requestMethod = (string)$requestMethod;
        $this->requestData = (array)$properties;
        $this->requestParameters = (array)$parameters;
    }

    /**
     * setRequestDataProperty
     *
     * @param $name
     * @param $value
     *
     * @return void
     */
    public function setRequestDataProperty($name, $value)
    {
        $this->requestData[$name] = $value;
    }

    /**
     * setRequestParameter
     *
     * @param $name
     * @param $value
     *
     * @return void
     */
    public function setRequestParameter($name, $value)
    {
        $this->requestParameters[$name] = $value;
    }

    /**
     * getResponse
     *
     * @param $responseData
     *
     * @return \Reliv\AxosoftApi\Model\AbstractApiResponse
     */
    public function getResponse($responseData)
    {
        if(isset($responseData['error'])){

            return new GenericApiError($responseData);
        }

        return new GenericApiResponse($responseData);
    }

    /**
     * setValidator
     *
     * @param $validator
     *
     * @return void
     * @throws \Exception
     */
    public function setValidator($validator)
    {
        // this implies an interface like ZF2s input filter
        // Is here to prevent a ZF2 dependency, but still support ZF2's inputFilter
        if (!method_exists($validator, 'isValid')
            || !method_exists(
                $validator,
                'getMessages'
            )
        ) {
            throw new \Exception(
                'Validator must contain "setData", "isValid" and "getMessages" methods'
            );
        }

        $this->validator = $validator;
    }

    /**
     * getValidator
     *
     * @return null|object
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Validation of request data
     *
     * @return bool
     */
    public function isValid()
    {
        if (!empty($this->validator)) {
            $this->validator->setData($this->parameters);
            return $this->validator->isValid();
        }

        return true;
    }
}