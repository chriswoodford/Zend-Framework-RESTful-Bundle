<?php

class Zeus_Rest_Route_Chain extends Zend_Controller_Router_Route_Chain
{

    public static function getInstance(Zend_Config $config)
    {

        $defs = ($config->defaults instanceof Zend_Config) ? $config->defaults->toArray() : array();
        return new self($config->route, $defs);

    }

}
