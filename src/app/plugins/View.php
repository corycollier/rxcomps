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
    extends Rx_Controller_Plugin_Abstract
{
    /**
     * preDispatch()
     *
     * Local implementation of the preDispatch hook, to setup view assets
     */
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $view = $this->getView();

        $registry = $this->getRegistry();

        $options = isset($registry['options']) ?
            $registry['options']
            : array();

        foreach ($options as $option) {
            $name = $this->variablize($option->name);
            $view->$name = $option->value;
        }

        $view->user = new App_Model_User;

        $view->navigation()
            ->setAcl($this->getRegistry()->get('acl'))
            ->setRole($this->getRegistry()->get('user')->getRoleId());

    } // END function preDispatch

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

} // END class App_Plugin_View