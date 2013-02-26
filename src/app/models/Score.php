<?php
/**
 * Scores Model
 *
 * This model represents individual events of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Scores Model
 *
 * This model represents individual events of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_Score
    extends Rx_Model_Abstract
    implements Zend_Acl_Resource_Interface
{
    /**
     * getResourceId()
     *
     * Gets the resource id
     *
     * @return string
     */
    public function getResourceId ( )
    {
        return 'scores';
    }

}// END class App_Model_Score

