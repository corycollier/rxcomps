<?php
/**
 * Admin Controller
 *
 * This controller gives a user access to administrate the system
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
 * This controller gives a user access to administrate the system
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class AdminController
    extends Rx_Controller_Action
{
    /**
     * indexAction()
     *
     * The default action for this controller
     */
    public function indexAction ( )
    {

    } // END function indexAction

    /**
     * eventOptionsAction()
     *
     * Action to allow the editing of event options
     */
    public function eventOptionsAction ( )
    {
        $form = new App_Form_EventOption;
        $request = $this->getRequest();

        if ($request->isPost()) {
            $params = array_merge($request->getParams(), $request->getPost());

            var_dump($params); die;

        }

        $this->view->form = $form;


    } // END function eventOptionsAction

} // END class AdminController
