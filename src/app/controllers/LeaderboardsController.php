<?php
/**
 * Leaderboards Controller
 *
 * This controller handles all of the displaying an routing of requests for
 * leaderboard information
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
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
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
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

    } // END function viewAction

    public function allAction ( )
    {
        $request = $this->getRequest();
        $eventId = $request->getParam('event_id');
        $eventsTable = $this->getTable('Event');
        $scalesTable = $this->getTable('Scale');
        $athletesTable = $this->getTable('Athlete');

        if ($eventId) {
            $event = $eventsTable->fetchRow(
                $eventsTable->select()->where(sprintf('id = %d', $eventId))
            );

            $this->view->competitions = $event->findDependentRowset('App_Model_DbTable_Competition');
            $this->view->scales = $event->findDependentRowset('App_Model_DbTable_Scale');
            $this->view->genders = $athletesTable->fetchAll(
                $athletesTable->select()
                    ->where('event_id = ?', $eventId)
                    ->group('gender')
            );
        }

    }


} // END class App_Controller_className