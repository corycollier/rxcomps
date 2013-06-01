<?php
/**
 * Error Controller Unit Test
 *
 * The unit test suite for the controller to Error requests. This test suite
 * should test all of the custom functionality provided by the Error
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
 * Error Controller Unit Test
 *
 * The unit test suite for the controller to Error requests. This test suite
 * should test all of the custom functionality provided by the Error
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

class ErrorControllerTest
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

    } // END function setUp

    /**
     * test_indexAction()
     *
     * Unit test for the indexAction of the ErrorController class
     *
     * @covers ErrorController::errorAction
     */
    public function test_errorAction ( )
    {
        $params = array(
            'action'    => 'error',
            'controller'=> 'error',
            'module'    => 'default'
        );

        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);

    } // END function test_indexAction

    /**
     * test_deniedAction()
     *
     * Unit test for the indexAction of the ErrorController class
     *
     * @covers ErrorController::deniedAction
     */
    public function test_deniedAction ( )
    {
        $params = array(
            'action'    => 'denied',
            'controller'=> 'error',
            'module'    => 'default'
        );

        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);

    } // END function test_deniedAction

} // END class ErrorControllerTest
