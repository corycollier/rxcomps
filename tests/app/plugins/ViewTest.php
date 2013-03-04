<?php
/**
 * Unit Tests for View
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Plugin_View class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Unit Tests for View
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Plugin_View class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Plugin_View
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_preDispatch()
     *
     * Tests the preDispatch of the App_Plugin_View
     *
     * @covers          App_Plugin_View::preDispatch
     * @dataProvider    provide_preDispatch
     */
    public function test_preDispatch ($params = array())
    {
        $subject = $this->getMockBuilder('App_Plugin_View')
            ->setMethods(array('getFrontController'))
            ->disableOriginalConstructor()
            ->getMock();

        $front = $this->getMockBuilder('Zend_Controller_Front')
            ->setMethods(array('getParam'))
            ->disableOriginalConstructor()
            ->getMock();

        $bootstrap = $this->getMockBuilder('App_Bootstrap')
            ->setMethods(array('getResource'))
            ->disableOriginalConstructor()
            ->getMock();

        $request = new Zend_Controller_Request_HttpTestCase;
        $view = new Zend_View;

        $bootstrap->expects($this->once())
            ->method('getResource')
            ->with($this->equalTo('view'))
            ->will($this->returnValue($view));

        $front->expects($this->once())
            ->method('getParam')
            ->with($this->equalTo('bootstrap'))
            ->will($this->returnValue($bootstrap));

        $subject->expects($this->once())
            ->method('getFrontController')
            ->will($this->returnValue($front));

        $request->setParams($params);

        $subject->preDispatch($request);

    } // END function test_preDispatch

    /**
     * provide_preDispatch()
     *
     * Provides data for the preDispatch method of the
     * App_Plugin_View class
     */
    public function provide_preDispatch ( )
    {
        return array(
            'object value in params' => array(
                array(
                    'key' => (object)array(
                        'id'    => 1,
                    )
                )
            ),

            'array value in params' => array(
                array(
                    'key' => array(
                        'id'    => 1,
                    )
                )
            ),

        );

    } // END function provide_preDispatch

    /**
     * test_getFrontController()
     *
     * Tests the getFrontController of the App_Plugin_View
     *
     * @covers          App_Plugin_View::getFrontController
     */
    public function test_getFrontController ( )
    {
        $subject = new App_Plugin_View;

        $result = $subject->getFrontController();

        $this->assertInstanceOf('Zend_Controller_Front', $result);

    } // END function test_getFrontController


} // END class Tests_App_Plugin_View