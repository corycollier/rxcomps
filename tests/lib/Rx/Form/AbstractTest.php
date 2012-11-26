<?php
/**
 * Rx_Form_Abstract Unit Test
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_Form_Abstract class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Rx_Form_Abstract Unit Test
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_Form_Abstract class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_Rx_Form_AbstractTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_getButtonSubForm()
     *
     * Tests the getButtonSubForm of the Rx_Form_Abstract
     *
     * @covers Rx_Form_Abstract::getButtonSubForm
     */
    public function test_getButtonSubForm ( )
    {
        $subForm    = new Zend_Form_SubForm;
        $form       = $this->getBuiltMock('Rx_Form_Abstract', array('buildSubForm'));

        $form->expects($this->once())
            ->method('buildSubForm')
            ->will($this->returnValue($subForm));

        $result = $form->getButtonSubForm();

        $this->assertSame($subForm, $result);

    } // END function test_getButtonSubForm

    /**
     * test_buildSubForm()
     *
     * Tests the buildSubForm of the Rx_Form_Abstract
     *
     * @covers Rx_Form_Abstract::buildSubForm
     */
    public function test_buildSubForm ( )
    {
        $form = new Rx_Form_Abstract;

        $result = $form->buildSubForm();

        $this->assertInstanceOf('Zend_Form_SubForm', $result);

    } // END function test_buildSubForm

} // END class Rx_Form_Abstract