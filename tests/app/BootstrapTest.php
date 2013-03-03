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
    extends Rx_PHPUnit_TestCase
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
        $subject = $this->getBuiltMock('App_Bootstrap');

        $this->getMethod('App_Bootstrap', '_initAutoloader')->invoke($subject);

        $namespaces = Zend_Loader_Autoloader::getInstance()->getRegisteredNamespaces();

        $this->assertTrue(in_array('Rx_', $namespaces));


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
        $subject = $this->getBuiltMock('App_Bootstrap');

        $this->getMethod('App_Bootstrap', '_initControllers')
            ->invoke($subject);

        $stack = Zend_Controller_Action_HelperBroker::getPluginLoader()->getPaths();

        $this->assertTrue(array_key_exists('Rx_Controller_Action_Helper_', $stack));

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
        $subject = $this->getBuiltMock('App_Bootstrap', array('bootstrap', 'getResource'));
        $front = $this->getBuiltMock('Zend_Controller_Front', array('registerPlugin'));

        $front->expects($this->exactly(3))
            ->method('registerPlugin');

        $subject->expects($this->once())
            ->method('bootstrap')
            ->with($this->equalTo('frontcontroller'));

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

    /**
     * test__initAcl()
     *
     * Tests the _initAcl of the App_Bootstrap
     *
     * @covers          App_Bootstrap::_initAcl
     */
    public function test__initAcl ( )
    {
        $subject = $this->getBuiltMock('App_Bootstrap');

        $method = new ReflectionMethod('App_Bootstrap', '_initAcl');
        $method->setAccessible(true);
        $method->invoke($subject);


    } // END function test__initAcl


} // END class Tests_App_Bootstrap