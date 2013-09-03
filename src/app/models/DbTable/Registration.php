<?php
/**
 * Registrations Database Table
 *
 * This model represents a database table of scores to the application
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
 * Registrations Database Table
 *
 * This model represents a database table of scores to the application
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_DbTable_Registration
    extends Rx_Model_DbTable_Abstract
{
    /**
     * The name of the database table to use for this class
     *
     * @var string
     */
    protected $_name = 'registrations';

    /**
     * The name of the database table that this table depends upon
     *
     * @var string
     */
    protected $_referenceMap    = array(
        'Event' => array(
            'columns'           => array('event_id'),
            'refTableClass'     => 'App_Model_DbTable_Event',
            'refColumns'        => array('id'),
        ),
        'Athlete' => array(
            'columns'           => array('athlete_id'),
            'refTableClass'     => 'App_Model_DbTable_Athlete',
            'refColumns'        => array('id'),
        ),
        'User' => array(
            'columns'           => array('user_id'),
            'refTableClass'     => 'App_Model_DbTable_User',
            'refColumns'        => array('id'),
        ),
    );

} // END class App_Model_DbTable_Registrations
