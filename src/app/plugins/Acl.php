<?php
/**
 * Acl Plugin
 *
 * This plugin handles setting up the ACL
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
 * Acl Plugin
 *
 * This plugin handles setting up the ACL
 *
 * @category    InfidelThrowdown
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2012 Firebase Gym, Inc (http://www.infidelthrowdown.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Plugin_Acl
    extends Rx_Controller_Plugin_Abstract
{
    /**
     * routeStartup()
     *
     * Implementation of the routeStartup hook. Trying to get the ACL in the
     * registry as soon as possible
     */
    public function routeStartup (Zend_Controller_Request_Abstract $request)
    {
        $acl = new Zend_Acl;

        $guest  = $acl->addRole(new Zend_Acl_Role('guest'));
        $user   = $acl->addRole(new Zend_Acl_Role('user'), array('guest'));
        $user   = $acl->addRole(new Zend_Acl_Role('judge'), array('user'));
        $admin  = $acl->addRole(new Zend_Acl_Role('admin'), array('judge'));

        $acl->addResource(new Zend_Acl_Resource('admin'));
        $acl->addResource(new Zend_Acl_Resource('event-admin'));
        $acl->addResource(new Zend_Acl_Resource('index'));
        $acl->addResource(new Zend_Acl_Resource('error'));
        $acl->addResource(new Zend_Acl_Resource('leaderboards'));

        $acl->addResource(new App_Model_User);
        $acl->addResource(new App_Model_Score);
        $acl->addResource(new App_Model_Event);
        $acl->addResource(new App_Model_Scale);
        $acl->addResource(new App_Model_Athlete);
        $acl->addResource(new App_Model_Competition);
        $acl->addResource(new App_Model_Registration);
        $acl->addResource(new App_Model_EventOption);

        $acl->allow('guest', array('index', 'error', 'leaderboards'));

        $acl->allow('guest', null, array(
            'index',
            'view',
            'error',
            'denied',
            'login',
            'logout',
            'success',
            'search',
            // 'list',
            'leaderboards',
            'all',
            'all-leaderboards',
        ));

        // $acl->allow('guest', 'registrations', 'create');
        $acl->allow('guest', 'events', 'list');
        $acl->allow('guest', 'athletes', 'list');
        $acl->allow('guest', 'competitions', 'list');
        $acl->allow('guest', 'scores', 'list');

        $acl->allow(new App_Model_User, null, null, new App_Model_Assertion_Event);

        $acl->allow('user', 'scores', null, new App_Model_Assertion_IsOwnScore);

        $acl->allow('admin');

        $this->getRegistry()->set('acl', $acl);
    }



} // END class App_Plugin_Acl