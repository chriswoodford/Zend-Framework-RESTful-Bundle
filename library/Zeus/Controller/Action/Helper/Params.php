<?php

/**
 * @category   Zeus
 * @package    Zeus_Controller
 * @copyright  Copyright (c) 2011 ideaPHP (http://www.ideaphp.com)
 */
class Zeus_Controller_Action_Helper_Params
    extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Parameters detected in raw content body
     * @var array
     */
    protected $_bodyParams = array();

    /**
     * Do detection of content type, and retrieve parameters from raw body if
     * present
     *
     * @return void
     */
    public function init()
    {

        // NB: if apache_request_headers() is not on the server, the
        // zend framework request cannot find the Content-Type header
        // this is a work-around so that the Content-Type header will
        // be found if apache_request_headers() are not available
        if (array_key_exists('CONTENT_TYPE', $_SERVER)) {
            $_SERVER['HTTP_CONTENT_TYPE'] = $_SERVER['CONTENT_TYPE'];
        }

        $request = $this->getRequest();
        $contentType = $request->getHeader('Content-Type');
        $rawBody = $request->getRawBody();

        if (!$rawBody) {
            return;
        }

        switch (true) {

            case (strstr($contentType, 'application/json')):
                $this->setBodyParams(Zend_Json::decode($rawBody));
                break;
            case (strstr($contentType, 'application/xml')):
                $config = new Zend_Config_Xml($rawBody);
                $this->setBodyParams($config->toArray());
                break;
            default:
                if ($request->isPut()) {
                    parse_str($rawBody, $params);
                    $this->setBodyParams($params);
                }
                break;
        }

    }

    /**
     * Set body params
     *
     * @param  array $params
     * @return Zeus_Controller_Action
     */
    public function setBodyParams(array $params)
    {

        $this->_bodyParams = $params;
        return $this;

    }

    /**
     * set a single body param
     *
     * @param string $paramName
     * @param mixes $value
     */
    public function setBodyParam($paramName, $value)
    {

        $this->_bodyParams[$paramName] = $value;

    }

    /**
     * Retrieve body parameters
     *
     * @return array
     */
    public function getBodyParams()
    {

        return $this->_bodyParams;

    }

    /**
     * Get body parameter
     *
     * @param  string $name
     * @param  string $default
     * @return mixed
     */
    public function getBodyParam($name, $default = null)
    {

        if ($this->hasBodyParam($name)) {
            return $this->_bodyParams[$name];
        }

        return $default;

    }

    /**
     * Is the given body parameter set?
     *
     * @param  string $name
     * @return bool
     */
    public function hasBodyParam($name)
    {

        if (isset($this->_bodyParams[$name])) {
            return true;
        }

        return false;

    }

    /**
     * Do we have any body parameters?
     *
     * @return bool
     */
    public function hasBodyParams()
    {

        if (!empty($this->_bodyParams)) {
            return true;
        }

        return false;

    }

    /**
     * Get submit parameters
     *
     * @return array
     */
    public function getSubmitParams()
    {

        if ($this->hasBodyParams()) {
            return $this->getBodyParams();
        }

        return $this->getRequest()->getPost();

    }

    public function direct()
    {

        return $this->getSubmitParams();

    }

}