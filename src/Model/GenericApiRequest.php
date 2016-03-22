<?php


namespace Reliv\AxosoftApi\Model;

use Reliv\AxosoftApi\Validator\Validator;

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
     * getResponse
     *
     * @param $responseData
     *
     * @return \Reliv\AxosoftApi\Model\AbstractApiResponse
     */
    public function getResponse($responseData)
    {
        if (isset($responseData['error']) || isset($responseData['error_description'])) {
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
     */
    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * getValidator
     *
     * @return null|Validator
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
        $validator = $this->getValidator();

        if (!empty($validator)) {
            $validator->setData($this->getRequestParameters());
            return $validator->isValid();
        }

        return parent::isValid();
    }
}
