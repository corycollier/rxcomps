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
     * test___construct()
     *
     * Tests the __construct method of the Rx_Form_Abstract class
     *
     * @covers Rx_Form_Abstract::__construct
     * @dataProvider provide___construct
     */
    public function test___construct ( )
    {
        $subject = $this->getBuiltMock('Rx_Form_Abstract', array(
            'setStandardDecorators', 'addPrefixPath'
        ));

        $subject->expects($this->once())->method('setStandardDecorators');
        $subject->expects($this->once())
            ->method('addPrefixPath')
            ->with(
                $this->equalTo('Rx_Form_Element_'),
                $this->equalTo('Rx/Form/Element/'),
                $this->equalTo('element')
            );

        $subject->__construct();

    } // END function test___construct

    /**
     * provide___construct()
     *
     * Provides data to use for testing the __construct method of
     * the Rx_Form_Abstract class
     *
     * @return array
     */
    public function provide___construct ( )
    {
        return array(
            array(),
        );

    } // END function provide___construct
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

    /**
     * test_setStandardDecorators()
     *
     * Tests the setStandardDecorators method of the Rx_Form_Abstract class
     *
     * @covers Rx_Form_Abstract::setStandardDecorators
     * @dataProvider provide_setStandardDecorators
     */
    public function test_setStandardDecorators ( )
    {
        $form = new Rx_Form_Abstract;

        $form->setStandardDecorators();

    } // END function test_setStandardDecorators

    /**
     * provide_setStandardDecorators()
     *
     * Provides data to use for testing the setStandardDecorators method of
     * the Rx_Form_Abstract class
     *
     * @return array
     */
    public function provide_setStandardDecorators ( )
    {
        return array(
            array(),
        );

    } // END function provide_setStandardDecorators

} // END class Rx_Form_Abstract