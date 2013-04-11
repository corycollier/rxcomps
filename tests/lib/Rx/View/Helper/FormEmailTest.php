<?php
/**
 * Unit Test Suite for the Rx_View_Helper_FormEmail class
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormEmail class
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
 * Unit Test Suite for the Rx_View_Helper_FormEmail
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormEmail class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_View_Helper_FormEmailTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_formEmail()
     *
     * Tests the formEmail method of the Rx_View_Helper_FormEmail class
     *
     * @covers Rx_View_Helper_FormEmail::formEmail
     * @dataProvider provide_formEmail
     */
    public function test_formEmail ($expected, $name, $value = null, $attribs = null)
    {
        $subject = new Rx_View_Helper_FormEmail;
        $subject->view = new Zend_View;

        $result = $subject->formEmail($name, $value, $attribs);
        $this->assertEquals($expected, $result);


    } // END function test_formEmail

    /**
     * provide_formEmail()
     *
     * Provides data to use for testing the formEmail method of
     * the Rx_View_Helper_FormEmail class
     *
     * @return array
     */
    public function provide_formEmail ( )
    {
        return array(
            'simple test' => array(
                'expected'  => '<input type="email" name="test_name" id="test_name" value="test-value" class=" input email" />',
                'name'      => 'test_name',
                'value'     => 'test-value',
            ),

            'disabled attribute test' => array(
                'expected'  => '<input type="email" name="test_name" id="test_name" value="test-value" disabled="disabled" class=" input email" />',
                'name'      => 'test_name',
                'value'     => 'test-value',
                array(
                    'disable' => true,
                )
            ),
        );

    } // END function provide_formEmail

} // END class Tests_Rx_View_Helper_FormEmailTest