<?php
/**
 * Scorings Database Table
 *
 * This model represents a database table of scoring mechanisms to the application
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
 * Scorings Database Table
 *
 * This model represents a database table of scoring mechanisms to the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_DbTable_Scoring
    extends Rx_Model_DbTable_Abstract
{
    /**
     * The name of the database table to use for this class
     *
     * @var string
     */
    protected $_name = 'scorings';

    /**
     * The name of the database table that this table depends upon
     *
     * @var string
     */
    protected $_referenceMap    = array(
        'Competition' => array(
            'columns'           => array('competition_id'),
            'refTableClass'     => 'App_Model_DbTable_Competition',
            'refColumns'        => array('id'),
        ),
    );

} // END class App_Model_DbTable_Scorings
