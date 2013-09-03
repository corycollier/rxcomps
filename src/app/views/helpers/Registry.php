<?php
/**
 * Zend_Registry View Helper
 *
 * This view helper really provides a way for view scripts to access the Zend_Registry instance
 *
 * @category    RxComps
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Zend_Registry View Helper
 *
 * This view helper really provides a way for view scripts to access the Zend_Registry instance
 *
 * @category    RxComps
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_View_Helper_Registry
    extends Zend_View_Helper_Abstract
{
    /**
     * auth()
     *
     * Main entry point into the authentication view helper
     *
     * @return Zend_User
     */
    public function registry ( )
    {
        return Zend_Registry::getInstance();

    } // END function auth

} // END class App_View_Helper_User