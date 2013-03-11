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

        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
            'namespace' => 'App',
            'basePath'  => APPLICATION_PATH,
        ));

        $resourceLoader->addResourceType('assertions', 'models/assertions/', 'Model_Assertion_');

        $loader->pushAutoloader($resourceLoader);

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
     * _initPlugins()
     *
     * Initialize plugins to the front controller
     */
    protected function _initPlugins ( )
    {
        $this->bootstrap('frontcontroller');
        $front = $this->getResource('frontcontroller');
        $front->registerPlugin(new App_Plugin_Acl);
        $front->registerPlugin(new App_Plugin_SiteOptions);
        $front->registerPlugin(new App_Plugin_Navigation);
        $front->registerPlugin(new App_Plugin_View);
        $front->registerPlugin(new App_Plugin_Cache);
    }

    /**
     * _initAcl()
     *
     * Initialize the ACL model in the registry. Plugins will do the work
     * of updating it to be useful
     */
    protected function _initAcl ( )
    {
        $acl = new Zend_Acl;
        Zend_Registry::set('acl', $acl);
    }

} // END class Bootstrap
