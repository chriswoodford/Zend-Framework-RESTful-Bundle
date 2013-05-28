<?php

/**
 * @category   Zeus
 * @package    Zeus_Controller
 * @copyright  Copyright (c) 2011 ideaPHP (http://www.ideaphp.com)
 */
class Zeus_Controller_Plugin_RestfulRoutes
    extends Zend_Controller_Plugin_Abstract
{

    /**
     * (non-PHPdoc)
     * @see Zend_Controller_Plugin_Abstract::routeShutdown()
     */
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {

        if (!$request instanceof Zend_Controller_Request_Http) {
            return;
        }

        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();

        $currentRoute = $router->getCurrentRoute();

        if (!$currentRoute instanceof Zeus_Rest_Route
            && !$currentRoute instanceof Zeus_Rest_Route_Chain
            && !$currentRoute instanceof Zeus_Rest_Route_Hostname
        ) {
            return;
        }

        $method = strtolower($request->getMethod());
        $id = $request->getParam('id', null);

        if (strcasecmp($request->getMethod(), Zend_Http_Client::GET) === 0
            && ($id === null || $id === '')
        ) {
            $method = 'index';
        } elseif (strcasecmp($request->getMethod(), Zend_Http_Client::POST) === 0
            && $id !== null && $id !== ''
        ) {
            $method = 'put';
        }

        $request->setActionName($method);

    }

}

