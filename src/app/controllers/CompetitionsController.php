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

        $competitionId = $request->getParam('id');
        $scaleId = $request->getParam('scale_id');

        $model->load($competitionId);

        $this->view->model = $model;
        $this->view->leaderboards = $model->getLeaderboards($scaleId);

    } // END function leaderboardsAction

} // END class App_Controller_CompetitionsController