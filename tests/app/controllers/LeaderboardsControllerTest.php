<?php
/**
 * Unit Test Suite for the LeaderboardsController class
 *
 * This unit test suite should test all of the custom functionality provided by
 * the LeaderboardsController class
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
 * Unit Test Suite for the LeaderboardsController
 *
 * This unit test suite should test all of the custom functionality provided by
 * the LeaderboardsController class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Controller_LeaderboardsControllerTest
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
     * Tests the dispatching of the indexAction method of the LeaderboardsController class
     *
     * @covers LeaderboardsController::indexAction
     */
    public function test_dispatchIndexAction ( )
    {
        $params = array(
            'action'    => 'index',
            'controller'=> 'leaderboards',
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


    /**
     * test_dispatchViewAction()
     *
     * Tests the dispatching of the viewAction method of the LeaderboardsController class
     *
     * @covers LeaderboardsController::viewAction
     */
    public function test_dispatchViewAction ( )
    {
        $params = array(
            'action'        => 'view',
            'controller'    => 'leaderboards',
            'module'        => 'default',
            'event_id'      => 1,
            'scale_id'      => 1,
            'gender'        => 'male'
        );

        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);

    } // END function test_dispatchViewAction

    /**
     * test_init()
     *
     * Tests the init of the LeaderboardsController
     *
     * @covers          LeaderboardsController::init
     * @dataProvider    provide_init
     */
    public function test_init ( )
    {
        $subject = new LeaderboardsController(
            new Zend_Controller_Request_HttpTestCase,
            new Zend_Controller_Response_HttpTestCase
        );

    } // END function test_init

    /**
     * provide_init()
     *
     * Provides data for the init method of the
     * LeaderboardsController class
     */
    public function provide_init ( )
    {
        return array(
            array(),
        );

    } // END function provide_init

} // END class Tests_App_Controller_LeaderboardsControllerTest
