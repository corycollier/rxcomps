<?php
/**
 * Unit Test Suite for the Confirmation class
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Confirmation form class
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
 * Unit Test Suite for the Confirmation
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Confirmation form class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_Rx_Form_ConfirmationTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_init()
     *
     * Tests the init method of the Rx_Form_Confirmation class
     *
     * @covers Rx_Form_Confirmation::init
     */
    public function test_init ( )
    {
        $form = new Rx_Form_Confirmation;

        $this->assertInstanceOf('Zend_Form_Element_Reset', $form->getElement('cancel'));
        $this->assertInstanceOf('Zend_Form_Element_Submit', $form->getElement('confirm'));

    } // END function test_init

} // END class Tests_Rx_Form_ConfirmationTest