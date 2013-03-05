<?php
/**
 * Tests_Rx_View_Helper_FormSelectTest Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Tests_Rx_View_Helper_FormSelectTest class
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
 * Tests_Rx_View_Helper_FormSelectTest Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Tests_Rx_View_Helper_FormSelectTest class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 */

class Tests_Rx_View_Helper_FormSelectTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_formSelect()
     *
     * Tests the formSelect method of the Tests_Rx_View_Helper_FormSelectTest class
     *
     * @covers Rx_View_Helper_FormSelect::formSelect
     * @dataProvider provide_formSelect
     */
    public function test_formSelect ($expected, $name, $value = null, $attribs = null)
    {
        $subject = new Rx_View_Helper_FormSelect;
        $view = new Zend_View;
        $subject->view = $view;

        $result = $subject->formSelect($name, $value, $attribs);

        $this->assertEquals($expected, $result);

    } // END function test_formSelect

    /**
     * provide_formSelect()
     *
     * Provides data to use for testing the formSelect method of
     * the Tests_Rx_View_Helper_FormSelectTest class
     *
     * @return array
     */
    public function provide_formSelect ( )
    {
        return array(
            'simple test' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="picker"><select name="name" id="name">',
                    '</select><a href="#" class="toggle">Please Select<span class="caret"></span></a><ul></ul></li></ul>',
                )),
                'name',
                'value',
            ),

            // 'disable test' =>array(
            //     '<p  class=" btn"><a href="#">value</a></p>', 'name', 'value', array(
            //         'disable' => true
            //     )
            // ),
        );

    } // END function provide_formSelect

} // END class Tests_Rx_View_Helper_FormSelectTest