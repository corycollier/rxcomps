<?php
/**
 * Unit Tests for Abstract
 *
 * This unit test should test all of the custom functionality provided by the
 * Rx_Controller_Plugin_Abstract class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Controller_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.1.0
 * @since       File available since release 1.1.0
 * @filesource
 */

/**
 * Unit Tests for Abstract
 *
 * This unit test should test all of the custom functionality provided by the
 * Rx_Controller_Plugin_Abstract class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Controller_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.1.0
 * @since       Class available since release 1.1.0
 */

class Tests_Rx_Controller_Plugin_Abstract
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_getRegistry()
     *
     * Tests the getRegistry of the Rx_Controller_Plugin_Abstract
     *
     * @covers Rx_Controller_Plugin_Abstract::getRegistry
     */
    public function test_getRegistry ( )
    {
        $subject = $this->getMockForAbstractClass('Rx_Controller_Plugin_Abstract');

        $result = $subject->getRegistry();

        $this->assertInstanceOf("Zend_Registry", $result);

    } // END function test_getRegistry

    /**
     * test_getFrontController()
     *
     * Tests the getFrontController of the Rx_Controller_Plugin_Abstract
     *
     * @covers Rx_Controller_Plugin_Abstract::getFrontController
     */
    public function test_getFrontController ( )
    {
        $subject = $this->getMockForAbstractClass('Rx_Controller_Plugin_Abstract');

        $result = $subject->getFrontController();

        $this->assertInstanceOf("Zend_Controller_Front", $result);

    } // END function test_getFrontController

    /**
     * test__getAuth()
     *
     * Tests the _getAuth of the Rx_Controller_Plugin_Abstract
     *
     * @covers Rx_Controller_Plugin_Abstract::_getAuth
     */
    public function test__getAuth ( )
    {
        $subject = $this->getMockForAbstractClass('Rx_Controller_Plugin_Abstract');

        $method = new ReflectionMethod('Rx_Controller_Plugin_Abstract', '_getAuth');
        $method->setAccessible(true);
        $result = $method->invoke($subject);

        $this->assertInstanceOf("Zend_Auth", $result);

    } // END function test__getAuth

    /**
     * test_getView()
     *
     * Tests the getView of the Rx_Controller_Plugin_Abstract
     *
     * @covers Rx_Controller_Plugin_Abstract::getView
     */
    public function test_getView ( )
    {
        $subject = $this->getMockBuilder('Rx_Controller_Plugin_Abstract')
            ->setMethods(array('getFrontController'))
            ->disableOriginalConstructor()
            ->getMock();

        $front = $this->getMockBuilder('Zend_Controller_Front')
            ->setMethods(array('getParam'))
            ->disableOriginalConstructor()
            ->getMock();

        $bootstrap = $this->getMockBuilder('Zend_Application_Bootstrap_Bootstrap')
            ->setMethods(array('getResource'))
            ->disableOriginalConstructor()
            ->getMock();

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

        $result = $subject->getView();

        $this->assertSame($view, $result);

    } // END function test_getView



} // END class Tests_Rx_Controller_Plugin_Abstract