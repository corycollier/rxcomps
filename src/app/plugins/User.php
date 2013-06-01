<?php
/**
 * User Plugin
 *
 * This plugin contains code to store the current user in the registry for use
 * globally
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * User Plugin
 *
 * This plugin contains code to store the current user in the registry for use
 * globally
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class App_Plugin_User
    extends Rx_Controller_Plugin_Abstract
{
    /**
     * routeStartup()
     *
     * Implementation of the routeStartup hook. Trying to get the User in the
     * registry as soon as possible
     */
    public function routeStartup (Zend_Controller_Request_Abstract $request)
    {
        $registry = $this->getRegistry();
        $user = new App_Model_User;
        $user->fromSession();
        $registry->set('user', $user);

    }

} // END class App_Plugin_Cache