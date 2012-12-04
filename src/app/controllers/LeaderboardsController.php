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
        $filters = $request->getParam('filters');

        $items = array();

        if ($eventId && $scaleId) {
            $items = $leaderboards->load($eventId, $scaleId, $filters);
        }

        $eventsTable = $this->getTable('Event');
        $scalesTable = $this->getTable('Scale');

        $this->view->event = $eventsTable->fetchRow(
            $eventsTable->select()->where(sprintf('id = %d', $eventId))
        )->toArray();

        $scale = $scalesTable->fetchRow(
            $scalesTable->select()->where(sprintf('id = %d', $scaleId))
        );

        if ($scale){
            $this->view->scale = $scale->toArray();
        }

        $this->view->items = $items;

    } // END function viewAction

    /**
     * fullScreenAction()
     *
     * Allows for viewing of the leaderboards on a full screen
     */
    public function fullScreenAction ( )
    {
        $this->getHelper('Layout')->getLayoutInstance()->setLayout('full-screen');
        $this->_forward('view');

    } // END function fullScreenAction


} // END class App_Controller_className