<?php
/**
 * EventsUsers Database Table
 *
 * This model represents a database table of events_users to the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       File available since release 2.1.0
 * @filesource
 */

/**
 * EventsUsers Database Table
 *
 * This model represents a database table of events_users to the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 */

class App_Model_DbTable_EventsUsers
    extends Rx_Model_DbTable_Abstract
{
    /**
     * The name of the database table to use for this class
     *
     * @var string
     */
    protected $_name = 'events_users';

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
        'User' => array(
            'columns'           => array('user_id'),
            'refTableClass'     => 'App_Model_DbTable_User',
            'refColumns'        => array('id'),
        ),
    );

} // END class App_Model_DbTable_Athletes
