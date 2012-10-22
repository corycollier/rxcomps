<?php
/**
 * Users Controller
 *
 * The controller for handling requests that involve users
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Users Controller
 *
 * The controller for handling requests that involve users
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class UsersController
    extends Rx_Controller_Action
{
    /**
     * indexAction()
     *
     * The default action for this controller
     */
    public function indexAction ( )
    {
        // action body

    } // END function indexAction

    /**
     * loginAction()
     *
     * Method to allow users the ability to login to the application
     */
    public function loginAction ( )
    {
        // specify the needed classes
        $user = $this->getModel('User');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $user->login($request->getParams());
            $this->getHelper('Redirector')->gotoRoute(array(
                'module'        => 'default',
                'controller'    => 'index',
                'action'        => 'index',
            ));
        }

        $this->view->form = $user->getForm();

    } // END fucntion loginAction

    /**
     * logoutAction()
     *
     * Method to allow users the ability to logout of the application
     */
    public function logoutAction ( )
    {
        // specify the needed classes
        $user = $this->getModel('User');
        $user->logout();

    } // END function logoutAction

    /**
     * editAction()
     *
     * Edit the user
     */
    public function editAction ( )
    {


    } // END function editAction


} // END class UsersController

