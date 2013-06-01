<?php
/**
 * Unit Test Suite for the Rx_View_Helper_FormTextarea class
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormTextarea class
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
 * Unit Test Suite for the Rx_View_Helper_FormTextarea
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormTextarea class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_View_Helper_FormTextareaTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_formTextarea()
     *
     * Tests the formTextarea method of the Rx_View_Helper_FormTextarea class
     *
     * @covers Rx_View_Helper_FormTextarea::formTextarea
     * @dataProvider provide_formTextarea
     */
    public function test_formTextarea ($expected, $name, $value = null, $attribs = null)
    {
        $subject = new Rx_View_Helper_FormTextarea;
        $view = new Zend_View;
        $subject->view = $view;

        $result = $subject->formTextarea($name, $value, $attribs);

        $this->assertEquals($expected, $result);

    } // END function test_formTextarea

    /**
     * provide_formTextarea()
     *
     * Provides data to use for testing the formTextarea method of
     * the Rx_View_Helper_FormTextarea class
     *
     * @return array
     */
    public function provide_formTextarea ( )
    {
        return array(
            'simple test' => array(
                'expected'  => '<textarea name="name_value" id="name_value" class=" input textarea" rows="5" cols="80"></textarea>',
                'name'      => 'name_value',
                'value'     => null,
                'attribs'   => null,
            ),
        );

    } // END function provide_formTextarea

} // END class Tests_Rx_View_Helper_FormTextareaTest