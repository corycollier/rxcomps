<?php
/**
 * Unit Test Suite for the Scale class
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Model_Scale class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the Scale
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Model_Scale class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Model_ScaleTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_getResourceId()
     *
     * Tests the getResourceId of the App_Model_Scale
     *
     * @covers          App_Model_Scale::getResourceId
     */
    public function test_getResourceId ( )
    {
        $subject = new App_Model_Scale;

        $result = $subject->getResourceId();

        $this->assertEquals('scales', $result);

    } // END function test_getResourceId

    /**
     * test_getEvent()
     *
     * Tests the getEvent of the App_Model_Scale
     *
     * @covers          App_Model_Scale::getEvent
     */
    public function test_getEvent ( )
    {
        $subject = $this->getMockBuilder('App_Model_Scale')
            ->setMethods(array('getParent'))
            ->disableOriginalConstructor()
            ->getMock();

        $event = $this->getMockBuilder('App_Model_Event')
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('getParent')
            ->with($this->equalTo('Event'))
            ->will($this->returnValue($event));

        $result = $subject->getEvent();

        $this->assertSame($event, $result);

    } // END function test_getEvent

}