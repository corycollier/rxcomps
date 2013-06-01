<?php
/**
 * Rx Controller Plugin
 *
 * This plugin class provides some common functionality that's missing from the
 * base Zend_Controller_Plugin_Abstract class
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Controller_Plugin
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Rx Controller Plugin
 *
 * This plugin class provides some common functionality that's missing from the
 * base Zend_Controller_Plugin_Abstract class
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Controller_Plugin
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

abstract class Rx_Controller_Plugin_Abstract
    extends Zend_Controller_Plugin_Abstract
{
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
     * _getAuth
     *
     * Gets the global authentication
     *
     * @return Zend_Auth
     */
    protected function _getAuth ( )
    {
        return Zend_Auth::getInstance();

    } // END function _getAuth

    /**
     * getView()
     *
     * Gets the view from the front controller
     *
     * @return Zend_View
     */
    public function getView ( )
    {
        $front = $this->getFrontController();
        $bootstrap = $front->getParam('bootstrap');
        $view = $bootstrap->getResource('view');

        return $view;

    } // END function getView

} // END class Rx_Controller_Plugin_Abstract
