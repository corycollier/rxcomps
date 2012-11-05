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
            'action'            => 'view',
            'controller'        => 'leaderboards',
            'module'            => 'default',
            'event_id'          => 1,
            'scale_id'          => 1,
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
     * test_fullScreenAction()
     *
     * Tests the fullScreenAction method of the LeaderboardsController class
     *
     * @covers LeaderboardsController::fullScreenAction
     */
    public function test_fullScreenAction ( )
    {
        $this->markTestIncomplete('need to figure out the issue with _forward');
        $subject = $this->getMockBuilder('LeaderboardsController')
            ->setMethods(array('getHelper', '_forward'))
            ->disableOriginalConstructor()
            ->getMock();

        $helper = $this->getMockBuilder('Zend_Layout_Controller_Action_Helper_Layout')
            ->setMethods(array('getLayoutInstance'))
            ->disableOriginalConstructor()
            ->getMock();

        $layout = $this->getMockBuilder('Zend_Layout')
            ->setMethods(array('setLayout'))
            ->disableOriginalConstructor()
            ->getMock();

        $layout->expects($this->once())
            ->method('setLayout')
            ->with($this->equalTo('full-screen'));

        $helper->expects($this->once())
            ->method('getLayoutInstance')
            ->will($this->returnValue($layout));

        $subject->expects($this->once())
            ->method('getHelper')
            ->with($this->equalTo('Layout'))
            ->will($this->returnValue($helper));

        $subject->expects($this->once())
            ->method('_forward')
            ->with($this->equalTo('view'));

        $subject->fullScreenAction();

    } // END function test_fullScreenAction

    /**
     * test_dispatchFullScreenAction()
     *
     * Tests the fullScreenAction method of the LeaderboardsController class
     *
     * @covers LeaderboardsController::fullScreenAction
     * @dataProvider provide_dispatchFullScreenAction
     */
    public function test_dispatchFullScreenAction ( )
    {
        $params = array(
            'action'            => 'full-screen',
            'controller'        => 'leaderboards',
            'module'            => 'default',
            'event_id'          => 1,
            'scale_id'          => 1,
        );

        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction('view');

    } // END function test_dispatchFullScreenAction

    /**
     * provide_dispatchFullScreenAction()
     *
     * Provides data to use for testing the fullScreenAction method of
     * the LeaderboardsController class
     *
     * @return array
     */
    public function provide_dispatchFullScreenAction ( )
    {
        return array(
            array(),
        );

    } // END function provide_dispatchFullScreenAction

} // END class Tests_App_Controller_LeaderboardsControllerTest