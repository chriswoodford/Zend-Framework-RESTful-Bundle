<?php

/**
 * @category   Zeus
 * @package    Zeus_Controller
 * @copyright  Copyright (c) 2011 ideaPHP (http://www.ideaphp.com)
 */
class Zeus_Controller_Plugin_AcceptHandler
    extends Zend_Controller_Plugin_Abstract
{

    /**
     * (non-PHPdoc)
     * @see Zend_Controller_Plugin_Abstract::dispatchLoopStartup()
     */
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {

        if (!$request instanceof Zend_Controller_Request_Http) {
            return;
        }

        $header = $request->getHeader('Accept');

        switch (true) {
            case (strstr($header, 'application/json')):
                $request->setParam('format', 'json');
                break;
            case (strstr($header, 'application/xml')
                && (!strstr($header, 'html'))
            ):
                $request->setParam('format', 'xml');
                break;
            default:
                break;
        }

    }

}
