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
        $resourceLoader->addResourceType('modelInterfaces', 'models/interfaces/', 'Model_Interface_');

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
        $front->registerPlugin(new App_Plugin_EventOptions);
        $front->registerPlugin(new App_Plugin_Navigation);
        $front->registerPlugin(new App_Plugin_View);
        $front->registerPlugin(new App_Plugin_Cache);
        $front->registerPlugin(new App_Plugin_User);
    }

    // protected function _initPageCache ( )
    // {
    //     /*
    //     resources.cachemanager.page.frontend.options.regexps./leaderboards/.cache = true
    //     resources.cachemanager.page.frontend.options.regexps./events\/view/.cache = true
    //     */
    //     $this->bootstrap('cachemanager');

    //     $front = $this->getResource('frontController');
    //     $front->setParam('disableOutputBuffering', true);
    //     $manager = $this->getResource('cachemanager');

    //     $options = $manager->getCacheTemplate('page');
    //     $options['frontend']['options']['regexps'] = array(
    //         '/leaderboards/' => array('cache' => true),
    //         '^/events\/view/' => array(
    //             'cache' => true,
    //             'cache_with_get_variables'      => true,
    //             'cache_with_post_variables'     => true,
    //             'cache_with_session_variables'  => true,
    //             'cache_with_files_variables'    => true,
    //             'cache_with_cookie_variables'   => true,
    //             'make_id_with_get_variables'    => true,
    //             'make_id_with_post_variables'   => true,
    //             'make_id_with_session_variables'=> true,
    //             'make_id_with_files_variables'  => true,
    //             'make_id_with_cookie_variables' => true,
    //         ),
    //     );

    //     // var_dump($options); die;

    //     $manager->setTemplateOptions('page', $options);
    // }

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
