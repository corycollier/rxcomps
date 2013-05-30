<?php
/**
 * Unit Test Suite for the Score class
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Model_Score class
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
 * Unit Test Suite for the Score
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Model_Score class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Model_ScoreTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_getResourceId()
     *
     * Tests the getResourceId of the App_Model_Score
     *
     * @covers          App_Model_Score::getResourceId
     */
    public function test_getResourceId ( )
    {
        $subject = new App_Model_Score;

        $result = $subject->getResourceId();

        $this->assertEquals('scores', $result);

    } // END function test_getResourceId

    /**
     * test_getEvent()
     *
     * Tests the getEvent of the App_Model_Score
     *
     * @covers          App_Model_Score::getEvent
     */
    public function test_getEvent ( )
    {
        $subject = $this->getMockBuilder('App_Model_Score')
            ->setMethods(array('getModel'))
            ->disableOriginalConstructor()
            ->getMock();

        $event = $this->getMockBuilder('App_Model_Event')
            ->setMethods(array('load'))
            ->disableOriginalConstructor()
            ->getMock();

        $row = $this->getMockBuilder('App_Model_DbTable_Score')
            ->setMethods(array('findParentRow'))
            ->disableOriginalConstructor()
            ->getMock();

        $rowResult = (object)array('event_id'   => 1);

        $row->expects($this->once())
            ->method('findParentRow')
            ->with($this->equalTo('App_Model_DbTable_Competition'))
            ->will($this->returnValue($rowResult));

        $subject->row = $row;

        $event->expects($this->once())
            ->method('load')
            ->with($this->equalTo($rowResult->event_id));

        $subject->expects($this->once())
            ->method('getModel')
            ->with($this->equalTo('Event'))
            ->will($this->returnValue($event));


        $result = $subject->getEvent();

        $this->assertSame($event, $result);

    } // END function test_getEvent


}