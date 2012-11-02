<?php
/**
 * Competitions Controller Unit Test
 *
 * The unit test suite for the controller to user requests. This test suite
 * should test all of the custom functionality provided by the events
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
 * Competitions Controller Unit Test
 *
 * The unit test suite for the controller to user requests. This test suite
 * should test all of the custom functionality provided by the events
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

class CompetitionsControllerTest
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
     * Unit test for the indexAction of the CompetitionsController class
     *
     * @covers CompetitionsController::indexAction
     */
    public function test_dispatchIndexAction ( )
    {
        $params = array(
            'action'    => 'index',
            'controller'=> 'competitions',
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
     * test_indexAction()
     *
     * Tests the indexAction method of the CompetitionsController class
     *
     * @covers CompetitionsController::indexAction
     * @dataProvider provide_indexAction
     */
    public function test_indexAction ( )
    {
        $subject = new CompetitionsController(
            new Zend_Controller_Request_HttpTestCase,
            new Zend_Controller_Response_HttpTestCase
        );

        $subject->indexAction();

    } // END function test_indexAction

    /**
     * provide_indexAction()
     *
     * Provides data to use for testing the indexAction method of
     * the CompetitionsController class
     *
     * @return array
     */
    public function provide_indexAction ( )
    {
        return array(
            array(),
        );

    } // END function provide_indexAction

    /**
     * test_leaderboardsAction()
     *
     * Tests the leaderboardsAction method of the CompetitionsController class
     *
     * @covers CompetitionsController::leaderboardsAction
     * @dataProvider provide_leaderboardsAction
     */
    public function test_leaderboardsAction ($id, $scaleId, $leaderboards = array())
    {
        $subject = $this->getMockBuilder('CompetitionsController')
            ->setMethods(array('getModel', 'getRequest'))
            ->disableOriginalConstructor()
            ->getMock();

        $request = $this->getMockBuilder('Zend_Controller_Request_Http')
            ->setMethods(array('getParam'))
            ->disableOriginalConstructor()
            ->getMock();

        $model = $this->getMockBuilder('App_Model_Competition')
            ->setMethods(array('getLeaderboards', 'load'))
            ->disableOriginalConstructor()
            ->getMock();

        $request->expects($this->any())
            ->method('getParam')
            ->will($this->returnValueMap(array(
                array('id', $id),
                array('scale_id', $scaleId),
            )));

        $model->expects($this->once())
            ->method('getLeaderboards')
            // ->with($this->equalTo($scaleId))
            ->will($this->returnValue($leaderboards));

        $model->expects($this->once())
            ->method('load')
            // ->with($this->equalTo($id))
        ;

        $subject->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $subject->expects($this->once())
            ->method('getModel')
            ->with($this->equalTo('Competition'))
            ->will($this->returnValue($model));

        $subject->leaderboardsAction();

    } // END function test_leaderboardsAction

    /**
     * provide_leaderboardsAction()
     *
     * Provides data to use for testing the leaderboardsAction method of
     * the CompetitionsController class
     *
     * @return array
     */
    public function provide_leaderboardsAction ( )
    {
        return array(
            array(1, 1, array(

            )),

            array(2, 1, array(

            )),
        );

    } // END function provide_leaderboardsAction

    /**
     * test_dispatchLeaderboardsAction()
     *
     * Tests the dispatchLeaderboardsAction method of the CompetitionsController class
     *
     * @covers CompetitionsController::leaderboardsAction
     */
    public function test_dispatchLeaderboardsAction ( )
    {
        $params = array(
            'action'    => 'leaderboards',
            'controller'=> 'competitions',
            'module'    => 'default',
            'id'        => 1,
            'scale_id'  => 1,
        );

        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);

    } // END function test_dispatchLeaderboardsAction

} // END class CompetitionsControllerTest

