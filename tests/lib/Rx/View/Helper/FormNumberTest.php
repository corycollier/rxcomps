<?php
/**
 * Unit Test Suite for the Rx_View_Helper_FormNumber class
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormNumber class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the Rx_View_Helper_FormNumber
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormNumber class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_View_Helper_FormNumberTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_formNumber()
     *
     * Tests the formNumber method of the Rx_View_Helper_FormNumber class
     *
     * @covers Rx_View_Helper_FormNumber::formNumber
     * @dataProvider provide_formNumber
     */
    public function test_formNumber ($expected, $name, $value = null, $attribs = null)
    {
        $subject = new Rx_View_Helper_FormNumber;
        $subject->view = new Zend_View;

        $result = $subject->formNumber($name, $value, $attribs);
        $this->assertEquals($expected, $result);


    } // END function test_formNumber

    /**
     * provide_formNumber()
     *
     * Provides data to use for testing the formNumber method of
     * the Rx_View_Helper_FormNumber class
     *
     * @return array
     */
    public function provide_formNumber ( )
    {
        return array(
            'simple test' => array(
                'expected'  => '<input type="number" name="test_name" id="test_name" value="test-value" />',
                'name'      => 'test_name',
                'value'     => 'test-value',
            ),

            'disabled attribute test' => array(
                'expected'  => '<input type="number" name="test_name" id="test_name" value="test-value" disabled="disabled" />',
                'name'      => 'test_name',
                'value'     => 'test-value',
                array(
                    'disable' => true,
                )
            ),
        );

    } // END function provide_formNumber

} // END class Tests_Rx_View_Helper_FormNumberTest