<?php
/**
 * Scores Model
 *
 * This model represents individual events of the application
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
 * Scores Model
 *
 * This model represents individual events of the application
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_Score
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
        return 'scores';
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
        $event = $this->getModel('Event');
        $event->load($this->row->findParentRow('App_Model_DbTable_Competition')->event_id);
        return $event;
    }

}// END class App_Model_Score

