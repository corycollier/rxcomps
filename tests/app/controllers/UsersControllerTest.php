<?php
/**
 * Users Controller Unit Test
 *
 * The unit test suite for the controller to user requests. This test suite
 * should test all of the custom functionality provided by the users
 * controller class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Users Controller Unit Test
 *
 * The unit test suite for the controller to user requests. This test suite
 * should test all of the custom functionality provided by the users
 * controller class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class UsersControllerTest
    extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * setUp()
     *
     * Local implementation of the setUp hook
     */
    public function setUp ( )
    {
        $this->bootstrap = new Zend_Application(
            APPLICATION_ENV, ROOT_PATH . '/etc/application.ini'
        );

        parent::setUp();
    }

    /**
     * test_indexAction()
     *
     * Unit test for the indexAction of the UsersController class
     *
     * @covers UsersController::indexAction
     */
    public function test_indexAction ( )
    {
        $params = array(
            'action'    => 'index',
            'controller' => 'users',
            'module'    => 'default'
        );

        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
    }

    /**
     * test_logoutAction()
     *
     * Unit test for the logoutAction of the UsersController class
     *
     * @covers UsersController::logoutAction
     */
    public function test_logoutAction ( )
    {
        $params = array(
            'action'    => 'logout',
            'controller' => 'users',
            'module'    => 'default'
        );

        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
    }

    /**
     * test_loginAction()
     *
     * Unit test for the loginAction of the UsersController class
     *
     * @covers UsersController::loginAction
     */
    public function test_loginAction ( )
    {
        $params = array(
            'action'    => 'login',
            'controller' => 'users',
            'module'    => 'default'
        );

        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
    }

    /**
     * test_editAction()
     *
     * Unit test for the editAction of the UsersController class
     *
     * @covers UsersController::editAction
     */
    public function test_editAction ( )
    {
        $params = array(
            'action'    => 'edit',
            'controller' => 'users',
            'module'    => 'default'
        );

        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
    }

} // END class UsersControllerTest



