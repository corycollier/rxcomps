<?php
/**
 * Auth View Helper
 *
 * This view helper really provides a way for view scripts to access the auth instance
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Auth View Helper
 *
 * This view helper really provides a way for view scripts to access the auth instance
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_Auth
    extends Zend_View_Helper_Abstract
{
    /**
     * auth()
     *
     * Main entry point into the authentication view helper
     *
     * @return Zend_Auth
     */
    public function auth ( )
    {
        return Zend_Auth::getInstance();

    } // END function auth

} // END class App_View_Helper_Auth