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
        $leaderboards = $this->getModel('Leaderboard');

        $this->view->items = $leaderboards->load($this->getRequest()->getParam('competition_id'));

    } // END function viewAction

    /**
     * eventAction()
     *
     * Action to display the aggregeate leaderboards for an event
     */
    public function eventAction ( )
    {
        $leaderboards = $this->getModel('Leaderboard');

        $this->view->items = $leaderboards->event($this->getRequest()->getParam('event_id'));

    } // END function eventAction

} // END class App_Controller_className