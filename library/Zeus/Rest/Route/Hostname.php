<?php

class Zeus_Rest_Route_Hostname extends Zend_Controller_Router_Route_Hostname
{

    /**
     * (non-PHPdoc)
     * @see Zend_Controller_Router_Route_Abstract::chain()
     */
    public function chain(Zend_Controller_Router_Route_Abstract $route, $separator = '/')
    {

        $chain = new Zeus_Rest_Route_Chain();
        $chain->chain($this)->chain($route, $separator);

        return $chain;

    }

    public static function getInstance(Zend_Config $config)
    {
        $reqs   = ($config->reqs instanceof Zend_Config) ? $config->reqs->toArray() : array();
        $defs   = ($config->defaults instanceof Zend_Config) ? $config->defaults->toArray() : array();
        $scheme = (isset($config->scheme)) ? $config->scheme : null;
        return new self($config->route, $defs, $reqs, $scheme);
    }

}
