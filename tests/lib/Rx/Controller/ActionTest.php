<?php
/**
 * Rx_Controller_Action
 *
 * This unit test suite should test all of the functionality behind the
 * Rx_Controller_Action class, which acts as the base controller
 * class for all projects utilizing the Rx library
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Controller
 * @copyright   Copyright (c) 2012 Rx Gym, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Rx_Controller_Action
 *
 * This unit test suite should test all of the functionality behind the
 * Rx_Controller_Action class, which acts as the base controller
 * class for all projects utilizing the Rx library
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Controller
 * @copyright   Copyright (c) 2012 Rx Gym, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_Rx_Controller_ActionTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_preDispatch()
     *
     * Tests the preDispatch of the Rx_Controller_Action
     *
     * @covers            Rx_Controller_Action::preDispatch
     * @dataProvider    provide_preDispatch
     */
    public function test_preDispatch ( )
    {
        $request = new Zend_Controller_Request_HttpTestCase;
        $aclHelper = $this->getBuiltMock('Rx_Controller_Action_Helper_Acl', array('check'));
        $controller = $this->getBuiltMock('Rx_Controller_Action', array('getHelper', 'getRequest'));

        $aclHelper->expects($this->once())
            ->method('check')
            ->with($this->equalTo($request));

        $controller->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $controller->expects($this->once())
            ->method('getHelper')
            ->with($this->equalTo('Acl'))
            ->will($this->returnValue($aclHelper));

        $controller->preDispatch();

    } // END function test_preDispatch

    /**
     * provide_preDispatch()
     *
     * Provides data for the preDispatch method of the
     * Rx_Controller_Action class
     */
    public function provide_preDispatch ( )
    {
        return array(
            array(),
        );

    } // END function provide_preDispatch

    /**
     * test_getModel()
     *
     * Tests the getModel of the Rx_Controller_Action
     *
     * @covers            Rx_Controller_Action::getModel
     * @dataProvider    provide_getModel
     */
    public function test_getModel ($expected, $model)
    {
        $controller = new Rx_Controller_Action(
            new Zend_Controller_Request_HttpTestCase,
            new Zend_Controller_Response_HttpTestCase
        );

        $result = $controller->getModel($model);

        $this->assertInstanceOf($expected, $result);

    } // END function test_getModel

    /**
     * provide_getModel()
     *
     * Provides data for the getModel method of the
     * Rx_Controller_Action class
     */
    public function provide_getModel ( )
    {
        return array(
            array('App_Model_User', 'User'),
        );

    } // END function provide_getModel

    /**
     * test_getTable()
     *
     * Tests the getTable of the Rx_Controller_Action
     *
     * @covers            Rx_Controller_Action::getTable
     * @dataProvider    provide_getTable
     */
    public function test_getTable ($expected, $model)
    {
        $controller = new Rx_Controller_Action(
            new Zend_Controller_Request_HttpTestCase,
            new Zend_Controller_Response_HttpTestCase
        );

        $result = $controller->getTable($model);

        $this->assertInstanceOf($expected, $result);

    } // END function test_getTable

    /**
     * provide_getTable()
     *
     * Provides data for the getTable method of the
     * Rx_Controller_Action class
     */
    public function provide_getTable ( )
    {
        return array(
            array('App_Model_DbTable_User', 'User'),
        );

    } // END function provide_getTable

    /**
     * test_getLog()
     *
     * Tests the getLog of the Rx_Controller_Action
     *
     * @covers          Rx_Controller_Action::getLog
     * @dataProvider    provide_getLog
     */
    public function test_getLog ($expected, $hasResource = false)
    {
        $bootstrap = $this->getBuiltMock('App_Bootstrap', array('hasResource', 'getResource'));

        $controller = $this->getBuiltMock('Rx_Controller_Action', array('getInvokeArg'));

        if ($hasResource) {
            $bootstrap->expects($this->once())
                ->method('getResource')
                ->with($this->equalTo('Log'))
                ->will($this->returnValue($expected));
        }

        $bootstrap->expects($this->once())
            ->method('hasResource')
            ->with($this->equalTo('Log'))
            ->will($this->returnValue($hasResource));

        $controller->expects($this->once())
            ->method('getInvokeArg')
            ->with($this->equalTo('bootstrap'))
            ->will($this->returnValue($bootstrap));

        $result = $controller->getLog();

        $this->assertEquals($expected, $result);


    } // END function test_getLog

    /**
     * provide_getLog()
     *
     * Provides data for the getLog method of the
     * Rx_Controller_Action class
     */
    public function provide_getLog ( )
    {
        return array(
            'has resource is true, expect something' => array(
                'expected', true,
            ),
            'has resource is false, expect false' => array(
                false, false,
            ),
        );

    } // END function provide_getLog

    /**
     * test_getModel()
     *
     * Tests the postDispatch method of the Rx_Controller_Action
     *
     * @covers Rx_Controller_Action::postDispatch
     * @dataProvider    provide_postDispatch
     */
    public function test_postDispatch ($expected)
    {
        $controller = $this->getMockBuilder('Rx_Controller_Action')
            ->setConstructorArgs(array(
                new Zend_Controller_Request_HttpTestCase,
                new Zend_Controller_Response_HttpTestCase,
            ))
            ->setMethods(array('getHelper'))
            ->getMock();

        $controller->expects($this->once())
            ->method('getHelper')
            ->with($this->equalTo('FlashMessenger'))
            ->will($this->returnValue($expected));

        $controller->view = new Zend_View;

        $controller->postDispatch();

        $this->assertSame(
            $expected,
            $controller->view->flashMessenger
        );

        // $this->view->flashMessenger = $this->getHelper('FlashMessenger');

    } // END function test_getModel

    /**
     * provide_postDispatch()
     *
     * Provides data for the postDispatch method of the
     * Rx_Controller_Action class
     */
    public function provide_postDispatch ( )
    {
        return array(
            array('expected value'),
        );

    } // END function provide_postDispatch


} // END class Tests_Rx_Controller_Action