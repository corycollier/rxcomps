<?php
/**
 * Site Options] Plugin
 *
 * This plugin handles setting up Site Options
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
 * Site Options Plugin
 *
 * This plugin handles setting up Site Options
 *
 * @category    InfidelThrowdown
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2012 Firebase Gym, Inc (http://www.infidelthrowdown.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Plugin_SiteOptions
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
        $table = $this->getOptionsTable();

        $options = $table->fetchAll();

        $this->getRegistry()->set('options', $options);
    }

    public function getOptionsTable ( )
    {
        return new App_Model_DbTable_Option;
    }

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

} // END class App_Plugin_Acl