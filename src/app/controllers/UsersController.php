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
    extends Rx_Controller_Model
{
    /**
     * Message to indicate a successful login
     */
    const MSG_LOGIN_SUCCESS = 'Login Successful';

    /**
     * Message to indicate a successful logout
     */
    const MSG_LOGOUT_SUCCESS = 'Logout Successful';

    /**
     * Specify the model associated with this controller
     *
     * @var string
     */
    protected $_modelName = 'User';

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
        $redirector = $this->getHelper('Redirector');
        $flash = $this->getHelper('FlashMessenger');

        if ($request->isPost()) {
            try {
                $user->login($request->getParams());
                $flash->addMessage(self::MSG_LOGIN_SUCCESS, 'success');
                $redirector->gotoRoute(array(
                    'module'        => 'default',
                    'controller'    => 'index',
                    'action'        => 'index',
                ));
            } catch (Zend_Exception $exception) {
                $flash->addMessage($exception->getMessage(), 'error');
                $redirector->gotoRoute(array(
                    'module'        => 'default',
                    'controller'    => 'users',
                    'action'        => 'login',
                ));
            }
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
        $redirector = $this->getHelper('Redirector');
        $flash = $this->getHelper('FlashMessenger');

        $user->logout();
        $flash->addMessage(self::MSG_LOGOUT_SUCCESS, 'success');
        $redirector->gotoRoute(array(
            'module'        => 'default',
            'controller'    => 'index',
            'action'        => 'index',
        ));

    } // END function logoutAction

} // END class UsersController

