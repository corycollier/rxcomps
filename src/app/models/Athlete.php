<?php
/**
 * Athletes Model
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
 * Athletes Model
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

class App_Model_Athlete
    extends Rx_Model_Abstract
    implements Zend_Acl_Resource_Interface,
        App_Model_Interface_Eventable,
        App_Model_Interface_Searchable
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
        return 'athletes';
    }

    /**
     * getEventId()
     *
     * This method gets the event id
     *
     * @return integer
     */
    public function getEvent ( )
    {
        $event = $this->getParent('Event');
        return $event;
    }

    /**
     * getSearchFields()
     *
     * Gets the search fields for this model
     *
     * @return array
     */
    public function getSearchFields ( )
    {
        return array(
            // 'athlete_id'    => 'Text',
            'id'            => 'UnIndexed',
            'name'          => 'Text',
            'gym'           => 'Text',
            'event_id'      => 'Text',
        );

    } // END function getSearchFields

}// END class App_Model_Athletes

