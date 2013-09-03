<?php
/**
 * Athletes Database Table
 *
 * This model represents a database table of athletes to the application
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
 * Athletes Database Table
 *
 * This model represents a database table of athletes to the application
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_DbTable_Athlete
    extends Rx_Model_DbTable_Abstract
{
    /**
     * The name of the database table to use for this class
     *
     * @var string
     */
    protected $_name = 'athletes';

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
        'Scale' => array(
            'columns'           => array('scale_id'),
            'refTableClass'     => 'App_Model_DbTable_Scale',
            'refColumns'        => array('id'),
        ),
    );

    protected $_dependentTables = array(
        'App_Model_DbTable_Registration',
    );


    /**
     * getScaleCount()
     *
     * Gets the number of athletes for a given scale.
     * Important to note: scaleIds are unique per event
     *
     * @param integer|string $scaleId
     * @return integer
     */
    public function getScaleCount ($scaleId)
    {
        return $this->fetchRow(
            $this->select()
                ->from($this, array('count(1) as count'))
                ->where('scale_id = ?', $scaleId)

        )->count;

    } // END function getScaleCount


} // END class App_Model_DbTable_Athletes
