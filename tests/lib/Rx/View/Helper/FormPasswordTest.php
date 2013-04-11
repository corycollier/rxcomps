<?php
/**
 * Unit Test Suite for the Rx_View_Helper_FormPassword class
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormPassword class
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
 * Unit Test Suite for the Rx_View_Helper_FormPassword
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_FormPassword class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_View_Helper_FormPasswordTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_formPassword()
     *
     * Tests the formPassword method of the Rx_View_Helper_FormPassword class
     *
     * @covers Rx_View_Helper_FormPassword::formPassword
     * @dataProvider provide_formPassword
     */
    public function test_formPassword ($expected, $name, $value = null, $attribs = null)
    {
        $subject = new Rx_View_Helper_FormPassword;
        $view = new Zend_View;
        $subject->view = $view;

        $result = $subject->formPassword($name, $value, $attribs);

        $this->assertEquals($expected, $result);

    } // END function test_formPassword

    /**
     * provide_formPassword()
     *
     * Provides data to use for testing the formPassword method of
     * the Rx_View_Helper_FormPassword class
     *
     * @return array
     */
    public function provide_formPassword ( )
    {
        return array(
            'simple test' => array(
                'expected'  => '<input type="password" name="name_value" id="name_value" value="" class=" password input">',
                'name'      => 'name_value',
                'value'     => null,
                'attribs'   => null,
            ),
        );

    } // END function provide_formPassword

} // END class Tests_Rx_View_Helper_FormPasswordTest