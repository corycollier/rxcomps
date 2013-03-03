<?php
/**
 * Rx_Filter_SecondstoTime Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Rx_Filter_SecondstoTime class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Filter
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Rx_Filter_SecondstoTime Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Rx_Filter_SecondstoTime class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Filter
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_Filter_SecondstoTimeTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_filter()
     *
     * Tests the filter of the Rx_Filter_SecondstoTime
     *
     * @covers          Rx_Filter_SecondstoTime::filter
     * @dataProvider    provide_filter
     */
    public function test_filter ($expected, $value)
    {
        $subject = new Rx_Filter_SecondstoTime;

        $result = $subject->filter($value);

        $this->assertEquals($expected, $result);

    } // END function test_filter

    /**
     * provide_filter()
     *
     * Provides data for the filter method of the
     * Rx_Filter_SecondstoTime class
     */
    public function provide_filter ( )
    {
        return array(
            array('1:05:00', 3900),
            array('1:05:01', 3901),
            array('5:00', 300),
            array('5:05', 305),
            array('0:00', 0),
        );

    } // END function provide_filter
}