<?php
/**
 * Users Controller
 *
 * The controller for handling requests that involve users
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
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
 * @category    RxComps
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
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
     * Indicates the data given to login with is not valid
     */
    const MSG_LOGIN_INVALID = 'Login data is invalid';

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

        if ($request->isPost()) {
            try {
                $user->login($request->getParams());
                $this->flashAndRedirect(self::MSG_LOGIN_SUCCESS, 'success', array(
                    'module'        => 'default',
                    'controller'    => 'index',
                    'action'        => 'index',
                ));
            } catch (Zend_Exception $exception) {
                $this->flashAndRedirect($exception->getMessage(), 'error', array(
                    'module'        => 'default',
                    'controller'    => 'users',
                    'action'        => 'login',
                ));
            }
        }

        $this->view->form = $user->getLoginForm();

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

        $this->flashAndRedirect(self::MSG_LOGOUT_SUCCESS, 'success', array(
            'module'        => 'default',
            'controller'    => 'index',
            'action'        => 'index',
        ));

    } // END function logoutAction

} // END class UsersController

