<?php
/**
 * Competitions Database Table
 *
 * This model represents a database table of competitions to the application
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
 * Competitions Database Table
 *
 * This model represents a database table of competitions to the application
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_DbTable_Competition
    extends Rx_Model_DbTable_Abstract
{
    /**
     * The name of the database table to use for this class
     *
     * @var string
     */
    protected $_name = 'competitions';

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
    );

    protected $_dependentTables = array(
        'App_Model_DbTable_Score',
        'App_Model_DbTable_Scoring',
    );

} // END class App_Model_DbTable_Competitions
