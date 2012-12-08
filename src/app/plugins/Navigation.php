<?php
/**
 * Navigation Plugin
 *
 * This plugin contains all of the logic for determining which pages show up
 * in navigation
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Navigation Plugin
 *
 * This plugin contains all of the logic for determining which pages show up
 * in navigation
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Plugin_Navigation
    extends Zend_Controller_Plugin_Abstract
{
    /**
     * preDispatch()
     *
     * Implementation of the preDispatch hook
     */
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        // if this is an ajax request, don't bother
        if ($request->isXmlHttpRequest()) {
            return;
        }

        $view = Zend_Layout::getMvcInstance()->getView();

        $container = new Zend_Navigation(array(
            'events' => array(
                'label'         => 'Events',
                'controller'    => 'events',
                'action'        => 'list',
            ),
            // 'leaderboards' => array(
            //     'label'         => 'Leaderboards',
            //     'controller'    => 'leaderboards',
            // ),
        ));

        $this->_addExtraPages($container);

        $this->_addAuthenticationPages($container);

        $view->navigation()->setContainer($container);

    } // END function preDispatch

    /**
     * _addExtraPages()
     *
     * Adds additional pages to the container, if the user is logged in
     *
     * @param Zend_Navigation $container
     */
    protected function _addExtraPages ($container)
    {
        $auth = $this->_getAuth();
        // if ($auth->hasIdentity()) {
            $container->addPage(array(
                'label'         => 'Competitions',
                'controller'    => 'competitions',
                'action'        => 'list',
            ));
            $container->addPage(array(
                'label'         => 'Athletes',
                'controller'    => 'athletes',
                'action'        => 'list',
            ));
            $container->addPage(array(
                'label'         => 'Scores',
                'controller'    => 'scores',
                'action'        => 'list',
            ));
        // }

    } // END function _addExtraPages

    /**
     * _addAuthenticationPages()
     *
     * Method to add login/logout pages if the user is authenticated
     *
     * @param Zend_Navigation $container
     */
    protected function _addAuthenticationPages ($container)
    {
        $auth = $this->_getAuth();

        if ($auth->hasIdentity()) {
            $container->addPage(array(
                'label'         => 'Logout',
                'controller'    => 'users',
                'action'        => 'logout',
            ));
        } else {
            $container->addPage(array(
                'label'         => 'Login',
                'controller'    => 'users',
                'action'        => 'login',
            ));
        }

    } // END function _addAuthenticationPages

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

} // END class App_Plugin_Navigation