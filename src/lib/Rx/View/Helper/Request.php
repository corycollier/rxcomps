<?php
/**
 * Request View Helper
 *
 * This view helper gives access to the request object
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.6
 * @since       File available since release 1.0.6
 * @filesource
 */

/**
 * Request View Helper
 *
 * This view helper gives access to the request object
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.6
 * @since       Class available since release 1.0.6
 */

class Rx_View_Helper_Request
    extends Zend_View_Helper_Abstract
{
    /**
     * request()
     *
     * Returns the request instance
     */
    public function request ( )
    {
        return Zend_Controller_Front::getInstance()->getRequest();
    }

} // END class Rx_View_Helper_Request