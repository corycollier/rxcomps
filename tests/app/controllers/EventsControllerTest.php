<?php
/**
 * Events Controller Unit Test
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
 * Events Controller Unit Test
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

class EventsControllerTest
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
     * Unit test for the indexAction of the EventsController class
     *
     * @covers EventsController::indexAction
     */
    public function test_dispatchIndexAction ( )
    {
        $params = array(
            'action'    => 'index',
            'controller'=> 'events',
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
     * Tests the indexAction method of the EventsController class
     *
     * @covers EventsController::indexAction
     * @dataProvider provide_indexAction
     */
    public function test_indexAction ( )
    {
        $subject = new EventsController(
            new Zend_Controller_Request_HttpTestCase,
            new Zend_Controller_Response_HttpTestCase
        );

        $subject->indexAction();

    } // END function test_indexAction

    /**
     * provide_indexAction()
     *
     * Provides data to use for testing the indexAction method of
     * the EventsController class
     *
     * @return array
     */
    public function provide_indexAction ( )
    {
        return array(
            array(),
        );

    } // END function provide_indexAction


} // END class EventsControllerTest

