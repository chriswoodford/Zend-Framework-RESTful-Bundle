<?php

/**
 * @category   Zeus
 * @package    Zeus_Controller
 * @copyright  Copyright (c) 2011 ideaPHP (http://www.ideaphp.com)
 */
class Zeus_Controller_Action_Helper_RestContexts
    extends Zend_Controller_Action_Helper_Abstract
{

    protected $_contexts = array(
        'xml',
        'json',
    );

    public function preDispatch()
    {

        $controller = $this->getActionController();

        if (!$controller instanceof Zeus_Rest_Controller
            && !$controller instanceof Zend_Rest_Controller
        ) {
            return;
        }

        $this->_initContexts();

        // Set a Vary response header based on the Accept header
        $this->getResponse()->setHeader('Vary', 'Accept');

    }

    protected function _initContexts()
    {

        $cs = $this->getActionController()->getHelper('contextSwitch');
        $cs->setAutoJsonSerialization(false);

        foreach ($this->_contexts as $context) {

            foreach (array('index', 'post', 'get', 'put', 'delete') as $action) {
                $cs->addActionContext($action, $context);
            }

        }

        $cs->initContext();

    }

}
