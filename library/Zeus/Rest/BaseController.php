<?php

/**
 * @category   Zeus
 * @package    Zeus_Rest
 * @copyright  Copyright (c) 2011 ideaPHP (http://www.ideaphp.com)
 */
abstract class Zeus_Rest_BaseController extends Zend_Controller_Action
{

    public function init()
    {

        parent::init();

        // set the response on the view
        $this->view->response = $this->getResponse();

    }

    /**
     * (non-PHPdoc)
     * @see Zend_Controller_Action::_getParam()
     */
    protected function _getParam($paramName, $default = null)
    {

        return $this->_helper->params->hasBodyParam($paramName)
            ? $this->_helper->params->getBodyParam($paramName, $default)
            : parent::_getParam($paramName, $default);

    }

    /**
     * (non-PHPdoc)
     * @see Zend_Controller_Action::_setParam()
     */
    protected function _setParam($paramName, $value)
    {

        $this->_helper->params->setBodyParam($paramName, $value);
        parent::_setParam($paramName, $value);

    }

    /**
     * (non-PHPdoc)
     * @see Zend_Controller_Action::_hasParam()
     */
    protected function _hasParam($paramName)
    {

        return $this->_helper->params->hasBodyParam($paramName)
            ? true : parent::_hasParam($paramName);

    }

    /**
     * (non-PHPdoc)
     * @see Zend_Controller_Action::_getAllParams()
     */
    protected function _getAllParams()
    {

        return $this->_helper->params->hasBodyParams()
            ? $this->_helper->params() : parent::_getAllParams();

    }

}
