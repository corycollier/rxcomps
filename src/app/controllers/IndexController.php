<?php
/**
 * Index Controller
 *
 * The controller to handle errors
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
 * Index Controller
 *
 * The controller to handle errors
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 */

 class IndexController
    extends Rx_Controller_Action
{
    /**
     * init()
     *
     * local override of the init hook
     */
    public function init ( )
    {
        $this->getHelper('ContextSwitch')
            ->addActionContext('get-user-role-id', array('json'))
            ->initContext();

    } // END function init

    /**
     * indexController()
     *
     * The default action for the controller
     */
    public function indexAction ( )
    {

    } // END function indexController

    /**
     * termsOfUseAction()
     *
     * The terms-of-use page
     */
    public function termsOfUseAction ( )
    {

    } // END function termsOfUseAction

    /**
     * getUserRoleId()
     *
     * Method to show a user's role id
     */
    public function getUserRoleIdAction ( )
    {
        // specify the needed classes
        $this->view->role = $this->getModel('User')->fromSession()->getRoleId();

    } // END function getUserRoleId

} // END function indexController