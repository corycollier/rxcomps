<?php
/**
 * Application Bootstrapper
 *
 * This class sets up all other classes for use in the dispatch loop
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Bootstrap
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Application Bootstrapper
 *
 * This class sets up all other classes for use in the dispatch loop
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Bootstrap
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Bootstrap
    extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * _initAutoloader()
     *
     * global implementation of the initAutoLoader hook
     */
    protected function _initAutoloader ( )
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->setFallbackAutoloader(true);
        $loader->registerNamespace('Rx_');

    } // END function _initAutoloader

    /**
     * _initControllers()
     *
     * Initializes the controllers for the dispatch
     */
    protected function _initControllers ( )
    {
        Zend_Controller_Action_HelperBroker::addPrefix(
            'Rx_Controller_Action_Helper'
        );

    } // END function _initControllers

    /**
     * _initViewHelpers()
     *
     * Initializes the view helper paths for use
     */
    protected function _initViewHelpers ( )
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers/', 'App_View_Helper_');

    } // END function _initViewHelpers


    /**
     * _initAcl()
     *
     * Initializes the ACL object, and sets it into the registry for global use
     */
    protected function _initAcl ( )
    {
        $acl = new Zend_Acl;

        $guest = $acl->addRole(new Zend_Acl_Role('guest'));
        $admin = $acl->addRole(new Zend_Acl_Role('admin'));

        $acl->addResource(new Zend_Acl_Resource('index'));
        $acl->addResource(new Zend_Acl_Resource('error'));
        $acl->addResource(new Zend_Acl_Resource('users'));
        $acl->addResource(new Zend_Acl_Resource('scores'));
        $acl->addResource(new Zend_Acl_Resource('events'));
        $acl->addResource(new Zend_Acl_Resource('athletes'));
        $acl->addResource(new Zend_Acl_Resource('competitions'));

        $acl->allow('guest', null, array(
            'index', 'view', 'error', 'denied', 'login', 'logout', 'success',
        ));

        $acl->allow('admin');

        Zend_Registry::getInstance()->set('acl', $acl);

    } // END function _initAcl

    protected function _initPlugins ( )
    {
        $this->bootstrap('frontcontroller');
        $front = $this->getResource('frontcontroller');
        $front->registerPlugin(new App_Plugin_Navigation);
    }

} // END class Bootstrap
