<?php
/**
 * Registration Shirts Database Table
 *
 * This model represents a database table of registration-shirts to the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Registration Shirts Database Table
 *
 * This model represents a database table of registration-shirts to the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_Model_DbTable_Registration
    extends Rx_Model_DbTable_Abstract
{
    /**
     * The name of the database table to use for this class
     *
     * @var string
     */
    protected $_name = 'registration-shirts';

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
    );

} // END class App_Model_DbTable_Registrations


//registration_shirts