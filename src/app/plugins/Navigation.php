<?php
/**
 * Navigation Plugin
 *
 * This plugin contains all of the logic for determining which pages show up
 * in navigation
 *
 * @category    RxComps
 * @package     App
 * @subpackage  View
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
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
 * @category    RxComps
 * @package     App
 * @subpackage  View
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Plugin_Navigation
    extends Rx_Controller_Plugin_Abstract
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

        $view = $this->getView();

        $pages = array(
            'events' => array(
                'label'         => 'Events',
                'controller'    => 'events',
                'action'        => 'list',
            ),
        );

        $eventPages = $this->_getEventSubNavigation($request);
        if ($eventPages) {
            $pages['events']['pages'] = $eventPages;
        }

        $container = new Zend_Navigation($pages);

        $this->_addAuthenticationPages($container);

        $view->navigation()->setContainer($container);

    } // END function preDispatch

    protected function _getEventSubNavigation ($request)
    {
        $eventId = $request->getParam("event_id");

        if (! $eventId) {
            return array();
        }

        return array(
            array(
                'label'         => 'Leaderboards',
                'controller'    => 'leaderboards',
                'resource'      => 'leaderboards',
                'privilege'     => 'all',
                'action'        => 'all',
                'params' => array(
                    'event_id'      => $eventId,
                ),
                'fragment'      => 'leaderboards',
            ),
            array(
                'label'         => 'Competitions',
                'controller'    => 'competitions',
                'resource'      => 'competitions',
                'privilege'     => 'list',
                'action'        => 'list',
                'params' => array(
                    'event_id'      => $eventId,
                ),
            ),
            array(
                'label'         => 'Athletes',
                'controller'    => 'athletes',
                'resource'      => 'athletes',
                'privilege'     => 'list',
                'action'        => 'list',
                'params' => array(
                    'event_id'      => $eventId,
                ),
                'fragment'      => 'athletes',
            ),
            array(
                'label'         => 'Divisions',
                'controller'    => 'scales',
                'resource'      => 'scales',
                'privilege'     => 'list',
                'action'        => 'list',
                'params' => array(
                    'event_id'      => $eventId,
                ),
            ),
            array(
                'label'         => 'Registrations',
                'controller'    => 'registrations',
                'resource'      => 'registrations',
                'privilege'     => 'list',
                'action'        => 'list',
                'params' => array(
                    'event_id'      => $eventId,
                ),
            ),
            // array(
            //     'label'         => 'Options',
            //     'controller'    => 'event-options',
            //     'resource'      => 'event-options',
            //     'privilege'     => 'list',
            //     'action'        => 'list',
            //     'params' => array(
            //         'event_id'      => $eventId,
            //     ),
            // ),
            array(
                'label'         => 'Admin',
                'controller'    => 'admin',
                'resource'      => 'admin',
                'privilege'     => 'edit',
                'action'        => 'index',
                'params' => array(
                    'event_id'      => $eventId,
                ),
            ),
        );

    }

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

} // END class App_Plugin_Navigation