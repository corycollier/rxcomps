<?php
/**
 * View Plugin
 *
 * This plugin initializes all of the items necessary for the view
 *
 * @category    InfidelThrowdown
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2012 Firebase Gym, Inc (http://www.infidelthrowdown.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * View Plugin
 *
 * This plugin initializes all of the items necessary for the view
 *
 * @category    InfidelThrowdown
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2012 Firebase Gym, Inc (http://www.infidelthrowdown.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Plugin_View
    extends Zend_Controller_Plugin_Abstract
{
    /**
     * preDispatch()
     *
     * Local implementation of the preDispatch hook, to setup view assets
     */
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $front = $this->getFrontController();
        $view = $front->getParam('bootstrap')->getResource('view');

        $params = $request->getParams();
        foreach ($params as $key => $value) {
            if (is_object($value) || is_array($value)) {
                unset($params[$key]);
            }
        }

        $options = $this->getRegistry()->get('options');

        foreach ($options as $option) {
            $name = $this->variablize($option->name);
            $view->$name = $option->value;
        }

    } // END function preDispatch

    public function postDispatch ( )
    {

    }

    /**
     * variablize()
     *
     * Method to turn a volitile string into a suitable variable name
     *
     * @param string $string
     * @return string
     */
    public function variablize ($string)
    {
        $filter = new Zend_Filter;

        return $filter->filter($string);

    } // END function variablize

    /**
     * getFrontController()
     *
     * Gets the front controller instance
     *
     * @return Zend_Controller_Front
     */
    public function getFrontController ( )
    {
        return Zend_Controller_Front::getInstance();

    } // END function getFrontController

    /**
     * getRegistry()
     *
     * Gets the registry instance
     *
     * @return Zend_Registry
     */
    public function getRegistry ( )
    {
        return Zend_Registry::getInstance();

    } // END function getRegistry

} // END class App_Plugin_View