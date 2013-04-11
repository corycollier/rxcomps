<?php
/**
 * Unit Test Suite for the Rx_View_Helper_FormText class
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormText class
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
 * Unit Test Suite for the Rx_View_Helper_FormText
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormText class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_View_Helper_FormTextTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_formText()
     *
     * Tests the formText method of the Rx_View_Helper_FormText class
     *
     * @covers Rx_View_Helper_FormText::formText
     * @dataProvider provide_formText
     */
    public function test_formText ($expected, $name, $value = null, $attribs = null)
    {
        $subject = new Rx_View_Helper_FormText;
        $view = new Zend_View;
        $subject->view = $view;

        $result = $subject->formText($name, $value, $attribs);

        $this->assertEquals($expected, $result);

    } // END function test_formText

    /**
     * provide_formText()
     *
     * Provides data to use for testing the formText method of
     * the Rx_View_Helper_FormText class
     *
     * @return array
     */
    public function provide_formText ( )
    {
        return array(
            'simple test' => array(
                'expected'  => '<input type="text" name="name_value" id="name_value" value="" class=" input">',
                'name'      => 'name_value',
                'value'     => null,
                'attribs'   => null,
            ),
        );

    } // END function provide_formText

} // END class Tests_Rx_View_Helper_FormTextTest