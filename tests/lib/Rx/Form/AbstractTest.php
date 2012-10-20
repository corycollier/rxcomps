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
    extends Zend_Form
{
    /**
     * test_getButtonSubForm()
     *
     * Tests the getButtonSubForm of the Rx_Form_Abstract
     *
     * @covers          Rx_Form_Abstract::getButtonSubForm
     * @dataProvider    provide_getButtonSubForm
     */
    public function test_getButtonSubForm ( )
    {
        $form = $this->getMockBuilder('Rx_Form_Abstract')
            ->disableOriginalConstructor()
            ->getMock();

        $result = $form->getButtonSubForm();

        $this->assertInstanceOf('Zend_Form', $result);

    } // END function test_getButtonSubForm

    /**
     * provide_getButtonSubForm()
     *
     * Provides data for the getButtonSubForm method of the
     * Rx_Form_Abstract class
     */
    public function provide_getButtonSubForm ( )
    {
        return array(
            array(),
        );

    } // END function provide_getButtonSubForm

    /**
     * test_buildSubForm()
     *
     * Tests the buildSubForm of the Rx_Form_Abstract
     *
     * @covers          Rx_Form_Abstract::buildSubForm
     * @dataProvider    provide_buildSubForm
     */
    public function test_buildSubForm ( )
    {
        $form = $this->getMockBuilder('Rx_Form_Abstract')
            ->disableOriginalConstructor()
            ->getMock();

        $result = $form->buildSubForm();

        $this->assertInstanceOf('Zend_Form_SubForm', $result);

    } // END function test_buildSubForm

    /**
     * provide_buildSubForm()
     *
     * Provides data for the buildSubForm method of the
     * Rx_Form_Abstract class
     */
    public function provide_buildSubForm ( )
    {
        return array(
            array(),
        );

    } // END function provide_buildSubForm

} // END class Rx_Form_Abstract