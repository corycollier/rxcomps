<?php
/**
 * Unit Tests for Cache
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Plugin_Cache class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.1.0
 * @since       File available since release 1.1.0
 * @filesource
 */

/**
 * Unit Tests for Cache
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Plugin_Cache class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.1.0
 * @since       Class available since release 1.1.0
 */

class Tests_App_Plugin_Cache
    extends PHPUnit_Framework_TestCase
{

    /**
     * test_dispatchLoopStartup()
     *
     * Tests the dispatchLoopStartup of the App_Plugin_Cache
     *
     * @covers App_Plugin_Cache::dispatchLoopStartup
     */
    public function test_dispatchLoopStartup ( )
    {
        $subject = $this->getMockBuilder('App_Plugin_Cache')
            ->setMethods(array('getCache'))
            ->disableOriginalConstructor()
            ->getMock();

        $cache = $this->getMockBuilder('Zend_Cache')
            ->setMethods(array('start'))
            ->disableOriginalConstructor()
            ->getMock();

        $request = new Zend_Controller_Request_HttpTestCase;

        // $cache->expects($this->once())->method('start');

        $subject->expects($this->once())
            ->method('getCache')
            ->will($this->returnValue($cache));

        $subject->dispatchLoopStartup($request);

    } // END function test_dispatchLoopStartup

    /**
     * test_getCache()
     *
     * Tests the getCache of the App_Plugin_Cache
     *
     * @covers App_Plugin_Cache::getCache
     */
    public function test_getCache ( )
    {
        // create actors
        $subject = $this->getMockBuilder('App_Plugin_Cache')
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

        // set expectations
        $manager = $this->getMockBuilder('Zend_Cache_Manager')
            ->setMethods(array('getCache'))
            ->disableOriginalConstructor()
            ->getMock();

        $cache = $this->getMockBuilder('Zend_Cache')
            ->disableOriginalConstructor()
            ->getMock();

        $manager->expects($this->once())
            ->method('getCache')
            ->with($this->equalTo('page'))
            ->will($this->returnValue($cache));

        $bootstrap->expects($this->once())
            ->method('getResource')
            ->with($this->equalTo('cachemanager'))
            ->will($this->returnValue($manager));

        $front->expects($this->once())
            ->method('getParam')
            ->with($this->equalTo('bootstrap'))
            ->will($this->returnValue($bootstrap));

        $subject->expects($this->once())
            ->method('getFrontController')
            ->will($this->returnValue($front));

        // run the results and assert expectations
        $result = $subject->getCache();

        $this->assertEquals($cache, $result);

    } // END function test_getCache

} // END class Tests_App_Plugin_Cache