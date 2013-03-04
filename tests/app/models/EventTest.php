<?php
/**
 * Unit Test Suite for the Event class
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Model_Event class
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
 * Unit Test Suite for the Event
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Model_Event class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Model_EventTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_getResourceId()
     *
     * Tests the getResourceId of the App_Model_Event
     *
     * @covers          App_Model_Event::getResourceId
     */
    public function test_getResourceId ( )
    {
        $subject = new App_Model_Event;

        $result = $subject->getResourceId();

        $this->assertEquals('events', $result);

    } // END function test_getResourceId

}