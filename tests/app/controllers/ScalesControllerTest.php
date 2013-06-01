<?php
/**
 * Unit Test Suite for the ScalesController class
 *
 * This unit test suite should test all of the custom functionality provided by
 * the ScalesController class
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
 * Unit Test Suite for the ScalesController
 *
 * This unit test suite should test all of the custom functionality provided by
 * the ScalesController class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Controller_ScalesControllerTest
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
     * test_dispatchIndexAction()
     *
     * Tests the dispatching of the indexAction method of the ScalesController class
     *
     * @covers ScalesController::indexAction
     */
    public function test_dispatchIndexAction ( )
    {
        $params = array(
            'action'    => 'index',
            'controller'=> 'scales',
            'module'    => 'default'
        );

        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);

    } // END function test_dispatchIndexAction

} // END class Tests_App_Controller_ScalesControllerTest