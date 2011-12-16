<?php

/**
 * @category   Zeus
 * @package    Zeus_Application
 * @copyright  Copyright (c) 2011 ideaPHP (http://www.ideaphp.com)
 */
class Zeus_Application_Resource_Zeus
	extends Zend_Application_Resource_ResourceAbstract
{

	public function init()
	{

		$options = $this->getOptions();

		if ($this->getBootstrap()->hasResource('frontController')) {
    		$this->getBootstrap()->bootstrap('frontController');
    		$front = $this->getBootstrap()->getResource('frontController');
		} else {
		    $front = Zend_Controller_Front::getInstance();
		}

		$front->registerPlugin(new Zeus_Controller_Plugin_RestfulRoutes());
		$front->registerPlugin(new Zeus_Controller_Plugin_AcceptHandler());

	}

}
