<?php
/**
 * Csv Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Csv class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       File available since release 2.1.0
 * @filesource
 */

/**
 * Csv Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Csv class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 */

class Tests_Rx_View_Helper_Csv
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_csv()
     *
     * Tests the csv of the Rx_View_Helper_Csv
     *
     * @covers Rx_View_Helper_Csv::csv
     * @dataProvider provide_csv
     */
    public function test_csv ($expected, $data)
    {
        $subject = new Rx_View_Helper_Csv;

        $result = $subject->csv($data);

        $this->assertEquals($expected, $result);

    } // END function test_csv

    /**
     * provide_csv()
     *
     * Provides data for the csv method of the
     * Rx_View_Helper_Csv class
     */
    public function provide_csv ( )
    {
        return array(
            array(
                'expected' => implode(PHP_EOL, array(
                    '"id", "name", "desc"',
                    '"value 1", "value 2", "value 3"',
                )),
                'data' => array(
                    array(
                        'id'    => 'value 1',
                        'name'  => 'value 2',
                        'desc'  => 'value 3'
                    ),
                ),
            ),
        );

    } // END function provide_csv

    /**
     * test__filter()
     *
     * Tests the _filter method of the Rx_View_Helper_Csv class
     *
     * @covers Rx_View_Helper_Csv::_filter
     * @dataProvider provide__filter
     */
    public function test__filter ($expected, $data)
    {
        $subject = new Rx_View_Helper_Csv;

        $method = new ReflectionMethod('Rx_View_Helper_Csv', '_filter');
        $method->setAccessible(true);

        $result = $method->invoke($subject, $data);

        $this->assertEquals($expected, $result);

    } // END function test__filter

    /**
     * provide__filter()
     *
     * Provides data to use for testing the _filter method of
     * the Rx_View_Helper_Csv class
     *
     * @return array
     */
    public function provide__filter ( )
    {
        return array(
            'simple test' => array(
                array(''),
                array(''),
            ),

            'strip new lines' => array(
                array('testword'),
                array('test' . PHP_EOL . 'word'),
            ),

            'remove double quotes' => array(
                array('testword'),
                array('"test"' . PHP_EOL . '"word"'),
            ),
        );

    } // END function provide__filter

} // END class Tests_Rx_View_Helper_Csv