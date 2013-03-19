<?php
/**
 * Event Options Plugin
 *
 * This plugin handles setting up Event Options
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Event Options Plugin
 *
 * This plugin handles setting up Event Options
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Plugin_EventOptions
    extends Rx_Controller_Plugin_Abstract
{
    /**
     * routeStartup()
     *
     * Implementation of the routeStartup hook. Trying to get the ACL in the
     * registry as soon as possible
     */
    public function routeShutdown (Zend_Controller_Request_Abstract $request)
    {
        $eventId = $request->getParam('event_id');
        $table = $this->getOptionsTable();
        $select = $table->select();

        if (! $eventId) {
            return;
        }

        $select->where('event_id = ?', $request->getParam('event_id'));

        $options = $table->fetchAll($select);

        $this->getRegistry()->set('options', $options);
    }

    /**
     * getOptionsTable()
     *
     * Gets the options table
     *
     * @return App_Model_DbTable_Option
     */
    public function getOptionsTable ( )
    {
        return new App_Model_DbTable_EventOption;
    }

} // END class App_Plugin_Acl