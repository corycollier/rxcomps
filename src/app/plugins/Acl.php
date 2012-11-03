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
    extends Zend_Controller_Plugin_Abstract
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

        $guest = $acl->addRole(new Zend_Acl_Role('guest'));
        $admin = $acl->addRole(new Zend_Acl_Role('admin'));

        $acl->addResource(new Zend_Acl_Resource('index'));
        $acl->addResource(new Zend_Acl_Resource('error'));
        $acl->addResource(new Zend_Acl_Resource('users'));
        $acl->addResource(new Zend_Acl_Resource('scores'));
        $acl->addResource(new Zend_Acl_Resource('events'));
        $acl->addResource(new Zend_Acl_Resource('scales'));
        $acl->addResource(new Zend_Acl_Resource('athletes'));
        $acl->addResource(new Zend_Acl_Resource('competitions'));
        $acl->addResource(new Zend_Acl_Resource('leaderboards'));

        $acl->allow('guest', null, array(
            'index',
            'view',
            'error',
            'denied',
            'login',
            'logout',
            'success',
            'full-screen',
        ));

        $acl->allow('guest', 'events', 'list');

        $acl->allow('admin');

        Zend_Registry::getInstance()->set('acl', $acl);
    }

} // END class App_Plugin_Acl