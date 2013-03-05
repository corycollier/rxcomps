<?php
/**
 * Tests_Rx_View_Helper_FormSubmitTest Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Tests_Rx_View_Helper_FormSubmitTest class
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
 * Tests_Rx_View_Helper_FormSubmitTest Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Tests_Rx_View_Helper_FormSubmitTest class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 */

class Tests_Rx_View_Helper_FormSubmitTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_formSubmit()
     *
     * Tests the formSubmit method of the Tests_Rx_View_Helper_FormSubmitTest class
     *
     * @covers Rx_View_Helper_FormSubmit::formSubmit
     * @dataProvider provide_formSubmit
     */
    public function test_formSubmit ($expected, $name, $value = null, $attribs = null)
    {
        $subject = new Rx_View_Helper_FormSubmit;
        $view = new Zend_View;
        $subject->view = $view;

        $result = $subject->formSubmit($name, $value, $attribs);

        $this->assertEquals($expected, $result);

    } // END function test_formSubmit

    /**
     * provide_formSubmit()
     *
     * Provides data to use for testing the formSubmit method of
     * the Tests_Rx_View_Helper_FormSubmitTest class
     *
     * @return array
     */
    public function provide_formSubmit ( )
    {
        return array(
            'simple test' =>array(
                '<p  class=" btn"><a href="#">value</a></p>', 'name', 'value',
            ),

            'disable test' =>array(
                '<p  class=" btn"><a href="#">value</a></p>', 'name', 'value', array(
                    'disable' => true
                )
            ),
        );

    } // END function provide_formSubmit

} // END class Tests_Rx_View_Helper_Csv