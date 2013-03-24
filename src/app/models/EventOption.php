<?php
/**
 * Event Option Model
 *
 * This model represents individual events of the application
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
 * Events Model
 *
 * This model represents individual events of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_Model_EventOption
    extends Rx_Model_Abstract
    implements Zend_Acl_Resource_Interface, App_Model_Interface_Eventable
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
        return 'event-options';
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

}// END class App_Model_Events
