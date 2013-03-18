<?php
/**
 * AthletesRegistrations Database Table
 *
 * This model represents a database table of athletes_registrations to the application
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
 * AthletesRegistrations Database Table
 *
 * This model represents a database table of athletes_registrations to the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 */

class App_Model_DbTable_AthletesRegistrations
    extends Rx_Model_DbTable_Abstract
{
    /**
     * The name of the database table to use for this class
     *
     * @var string
     */
    protected $_name = 'athletes_registrations';

    /**
     * The name of the database table that this table depends upon
     *
     * @var string
     */
    protected $_referenceMap    = array(
        'Registration' => array(
            'columns'           => array('registration_id'),
            'refTableClass'     => 'App_Model_DbTable_Registration',
            'refColumns'        => array('id'),
        ),
        'Athlete' => array(
            'columns'           => array('athlete_id'),
            'refTableClass'     => 'App_Model_DbTable_Athlete',
            'refColumns'        => array('id'),
        ),
    );

} // END class App_Model_DbTable_Athletes
