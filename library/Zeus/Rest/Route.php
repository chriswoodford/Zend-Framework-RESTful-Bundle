<?php

/**
 * @category   Zeus
 * @package    Zeus_Rest
 * @copyright  Copyright (c) 2011 ideaPHP (http://www.ideaphp.com)
 */
class Zeus_Rest_Route extends Zend_Controller_Router_Route
{

    /**
     * Instantiates route based on passed Zend_Config structure
     *
     * @param Zend_Config $config Configuration object
     * @return Zeus_Rest_Route
     */
    public static function getInstance(Zend_Config $config)
    {

        $reqs = ($config->reqs instanceof Zend_Config) ? $config->reqs->toArray() : array();
        $defs = ($config->defaults instanceof Zend_Config) ? $config->defaults->toArray() : array();
        return new self($config->route, $defs, $reqs);

    }

}
