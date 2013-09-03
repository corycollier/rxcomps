<?php
/**
 * Leaderboards Controller
 *
 * This controller handles all of the displaying an routing of requests for
 * leaderboard information
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Leaderboards Controller
 *
 * This controller handles all of the displaying an routing of requests for
 * leaderboard information
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class LeaderboardsController
    extends Rx_Controller_Action
{
    /**
     * init()
     *
     * Local override of the init hook
     */
    public function init ( )
    {
        $helper = $this->_helper->getHelper('contextSwitch');

        if (! $helper->hasContext('remote')) {
            $helper->addContexts(array(
                'remote'  => array(
                    'suffix'    => 'remote',
                    'headers'   => array('Content-Type' => 'text/html'),
                )
            ));
            $helper->addActionContext('view', 'json')
                ->addActionContext('view', 'remote')
                ->initContext();
        }
    }

    /**
     * indexAction()
     *
     * Default action for the leaderboards controller
     */
    public function indexAction ( )
    {

    } // END function indexAction

    /**
     * viewAction()
     *
     * The action to view leaderboards for a specific competition
     */
    public function viewAction ( )
    {
        $request = $this->getRequest();
        $leaderboards = $this->getModel('Leaderboard');
        $scale = $this->getModel('Scale');

        $eventId = $request->getParam('event_id');
        $scaleId = $request->getParam('scale_id');
        $gender = $request->getParam('gender');
        $filters = $request->getParam('filters');

        $items = array();

        try {
            $items = $leaderboards->populate($eventId, $scaleId, $gender, $filters);
        } catch (Zend_Exception $exception) {
            // nothing to see here
        }

        $this->view->items = $items;
        $this->view->model = $scale->load($scaleId);

        $scaleTable = $this->getTable('Scale');
        $this->view->scale = $scaleTable->fetchRow(
            $scaleTable->select()->where(sprintf('id = %d', $scaleId))
        );

    } // END function viewAction

    public function allAction ( )
    {
        $request = $this->getRequest();
        $eventId = $request->getParam('event_id');
        $eventsTable = $this->getTable('Event');
        $leaderboards = $this->getModel('Leaderboard');

        if ($eventId) {
            $event = $eventsTable->fetchRow(
                $eventsTable->select()
                    ->where(sprintf('id = %d', $eventId))
            );

            $this->view->leaderboards = $leaderboards->getActiveLeaderboards($event);
        }

    }


} // END class App_Controller_className