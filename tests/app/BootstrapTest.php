<?php
/**
 * Unit Tests for Bootstrap
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Bootstrap class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Unit Tests for Bootstrap
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Bootstrap class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Bootstrap
    extends PHPUnit_Framework_TestCase
{

    /**
     * test__initAutoloader()
     *
     * Tests the _initAutoloader of the App_Bootstrap
     *
     * @covers          App_Bootstrap::_initAutoloader
     * @dataProvider    provide__initAutoloader
     */
    public function test__initAutoloader ( )
    {
        $subject = $this->getMockBuilder('App_Bootstrap')
            ->disableOriginalConstructor()
            ->getMock();

        $method = new ReflectionMethod('App_Bootstrap', '_initAutoloader');
        $method->setAccessible(true);
        $method->invoke($subject);

    } // END function test__initAutoloader

    /**
     * provide__initAutoloader()
     *
     * Provides data for the _initAutoloader method of the
     * App_Bootstrap class
     */
    public function provide__initAutoloader ( )
    {
        return array(
            array(),
        );

    } // END function provide__initAutoloader

    /**
     * test__initControllers()
     *
     * Tests the _initControllers of the App_Bootstrap
     *
     * @covers          App_Bootstrap::_initControllers
     * @dataProvider    provide__initControllers
     */
    public function test__initControllers ( )
    {
        $subject = $this->getMockBuilder('App_Bootstrap')
            ->disableOriginalConstructor()
            ->getMock();

        $method = new ReflectionMethod('App_Bootstrap', '_initControllers');
        $method->setAccessible(true);
        $method->invoke($subject);

    } // END function test__initControllers

    /**
     * provide__initControllers()
     *
     * Provides data for the _initControllers method of the
     * App_Bootstrap class
     */
    public function provide__initControllers ( )
    {
        return array(
            array(),
        );

    } // END function provide__initControllers

    /**
     * test__initPlugins()
     *
     * Tests the _initPlugins of the App_Bootstrap
     *
     * @covers          App_Bootstrap::_initPlugins
     * @dataProvider    provide__initPlugins
     */
    public function test__initPlugins ( )
    {
        $this->markTestIncomplete("not ready yet");
        $subject = $this->getMockBuilder('App_Bootstrap')
            ->setMethods(array('bootstrap', 'getResource'))
            ->disableOriginalConstructor()
            ->getMock();

        $front = $this->getMockBuilder('Zend_Controller_Front')
            ->setMethods(array('registerPlugin'))
            ->disableOriginalConstructor()
            ->getMock();

        $front->expects($this->exactly(3))
            ->method('registerPlugin');

        $subject->expects($this->once())
            ->method('bootstrap')
            ->with($this->equalTo('frontcontroller'))
            ->will($this->returnSelf());

        $subject->expects($this->once())
            ->method('getResource')
            ->with($this->equalTo('frontcontroller'))
            ->will($this->returnValue($front));

        $method = new ReflectionMethod('App_Bootstrap', '_initPlugins');
        $method->setAccessible(true);
        $method->invoke($subject);

    } // END function test__initPlugins

    /**
     * provide__initPlugins()
     *
     * Provides data for the _initPlugins method of the
     * App_Bootstrap class
     */
    public function provide__initPlugins ( )
    {
        return array(
            array(),
        );

    } // END function provide__initPlugins

} // END class Tests_App_Bootstrap