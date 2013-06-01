<?php
/**
 * Rx_Filter_TimeToSeconds Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Rx_Filter_TimeToSeconds class
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
 * Rx_Filter_TimeToSeconds Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Rx_Filter_TimeToSeconds class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Filter
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_Filter_TimeToSecondsTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_filter()
     *
     * Tests the filter of the Rx_Filter_TimeToSeconds
     *
     * @covers          Rx_Filter_TimeToSeconds::filter
     * @dataProvider    provide_filter
     */
    public function test_filter ($expected, $value)
    {
        $subject = new Rx_Filter_TimeToSeconds;

        $result = $subject->filter($value);

        $this->assertEquals($expected, $result);

    } // END function test_filter

    /**
     * provide_filter()
     *
     * Provides data for the filter method of the
     * Rx_Filter_TimeToSeconds class
     */
    public function provide_filter ( )
    {
        return array(
            array(3900, '1:5:00'),
            array(3900, '1:05:00'),
            array(3901, '1:05:01'),
            array(3901, '1:05:1'),
            array(3901, '1:5:1'),
            array(300, '5:00'),
            array(0, ':00'),
            array(0, '00'),
            array(0, '0'),
        );

    } // END function provide_filter

} // END class Tests_2.0.0_Rx_Filter_TimeToSeconds