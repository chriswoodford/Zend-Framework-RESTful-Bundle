<?php

/**
 * @category   Zeus
 * @package    Zeus_Rest
 * @copyright  Copyright (c) 2011 ideaPHP (http://www.ideaphp.com)
 */
class Zeus_Rest_Route extends Zend_Controller_Router_Route
{

    /**
     * Create a new chain
     *
     * @param  Zend_Controller_Router_Route_Abstract $route
     * @param  string                                $separator
     * @return Zend_Controller_Router_Route_Chain
     */
    public function chain(Zend_Controller_Router_Route_Abstract $route, $separator = '/')
    {

        $chain = new Zeus_Rest_Route_Chain();
        $chain->chain($this)->chain($route, $separator);

        return $chain;

    }

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
