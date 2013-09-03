<?php
/**
 * Events Database Table
 *
 * This model represents a database table of events to the application
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Events Database Table
 *
 * This model represents a database table of events to the application
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_DbTable_Event
    extends Rx_Model_DbTable_Abstract
{
    /**
     * The name of the database table to use for this class
     *
     * @var string
     */
    protected $_name = 'events';

    protected $_dependentTables = array(
        'App_Model_DbTable_Competition',
        'App_Model_DbTable_Athlete',
        'App_Model_DbTable_Scale',
        'App_Model_DbTable_Registration',
    );

} // END class App_Model_DbTable_Events
