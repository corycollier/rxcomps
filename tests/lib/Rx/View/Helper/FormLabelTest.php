<?php
/**
 * Unit Test Suite for the Rx_View_Helper_FormLabel class
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormLabel class
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
 * Unit Test Suite for the Rx_View_Helper_FormLabel
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormLabel class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_View_Helper_FormLabelTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_formLabel()
     *
     * Tests the formLabel method of the Rx_View_Helper_FormLabel class
     *
     * @covers Rx_View_Helper_FormLabel::formLabel
     * @dataProvider provide_formLabel
     */
    public function test_formLabel ($expected, $name, $value = null, $attribs = null)
    {
        $subject = new Rx_View_Helper_FormLabel;
        $view = new Zend_View;
        $subject->view = $view;

        $result = $subject->formLabel($name, $value, $attribs);

        $this->assertEquals($expected, $result);

    } // END function test_formLabel

    /**
     * provide_formLabel()
     *
     * Provides data to use for testing the formLabel method of
     * the Rx_View_Helper_FormLabel class
     *
     * @return array
     */
    public function provide_formLabel ( )
    {
        return array(
            'simple test' => array(
                'expected'  => '<span>label value</span>',
                'name'      => 'name does not matter',
                'label'     => 'label value',
            ),

            'disabled attribute test' => array(
                'expected'  => '',
                'name'      => 'name does not matter',
                'label'     => 'label value',
                array(
                    'disable'   => true,
                )
            ),
        );

    } // END function provide_formLabel

} // END class Tests_Rx_View_Helper_FormLabelTest
