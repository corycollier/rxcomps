<?php
/**
 * Event Admin Controller
 *
 * This controller gives a user access to administrate an event
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
 * Admin Controller
 *
 * This controller gives a user access to administrate an event
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class EventAdminController
    extends Rx_Controller_Action
{
    /**
     * indexAction()
     *
     * The default action for this controller
     */
    public function indexAction ( )
    {
        $form = new App_Form_EventAdmin;
        $model = new App_Model_Event;
        $request = $this->getRequest();

        $model->load($request->getParam('event_id'));

        $form->injectDependencies($model, $model->getChildren('EventOption'));


        if ($request->isPost()) {
            // do stuff
        }

        $this->view->form = $form;

    } // END function indexAction


} // END class AdminController
