<?php
/**
 * Competition Controller
 *
 * This controller handles all necessary steps to create view and modify Competitions
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Competition Controller
 *
 * This controller handles all necessary steps to create view and modify Competitions
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class CompetitionsController
    extends Rx_Controller_Model
{
    /**
     * Specify the name of the model to be used
     *
     * @var string
     */
    protected $_modelName = 'Competition';

    /**
     * indexAction()
     *
     * This is the main action for the Competitions controller
     */
    public function indexAction ( )
    {

    } // END function indexAction

    /**
     * leaderboardsAction()
     *
     * The leaderboards for a specific competition
     */
    public function leaderboardsAction ( )
    {
        $model = $this->getModel('Competition');
        $request = $this->getRequest();

        $eventId = $request->getParam('event_id');
        $scaleId = $request->getParam('scale_id');
        $gender = $request->getParam('gender');


        $items = array();

        $model->load($request->getParam('id'));

        try {
            $items = $model->getLeaderboards($scaleId, $gender);
        } catch (Zend_Exception $exception) {
            // nothing to see here
        }

        $this->view->model = $model;
        $this->view->items = $items;
        $this->view->eventId = $eventId;

    } // END function leaderboardsAction

    public function allLeaderboardsAction ( )
    {
        $request = $this->getRequest();
        $eventId = $request->getParam('event_id');
        $athletesTable = $this->getTable('Athlete');
        $eventsTable = $this->getTable('Event');

        $event = $eventsTable->fetchRow(
            $eventsTable->select()->where(sprintf('id = %d', $eventId))
        );

        $genders = $athletesTable->fetchAll(
            $athletesTable->select()
                ->where('event_id = ?', $eventId)
                ->group('gender')
        );

        $scales = $event->findDependentRowset('App_Model_DbTable_Scale');

        $this->view->scales = $scales;
        $this->view->genders = $genders;
        $this->view->eventId = $eventId;
    }

} // END class App_Controller_CompetitionsController