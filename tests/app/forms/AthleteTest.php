<?php
/**
 * Athlete Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Athlete class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Athlete Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Athlete class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Form_Athlete
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_init()
     *
     * Tests the init of the App_Form_Athlete
     *
     * @covers App_Form_Athlete::init
     */
    public function test_init ( )
    {
        $form = new App_Form_Athlete;

        $name = $form->getElement('name');
        $event = $form->getElement('event_id');
        $save = $form->getElement('save');

        $this->assertInstanceOf('Zend_Form_Element_Text', $name);
        $this->assertInstanceOf('Zend_Form_Element_Select', $event);
        $this->assertInstanceOf('Zend_Form_Element_Submit', $save);

        $this->assertEquals('Name', $name->getLabel());
        $this->assertEquals('Event', $event->getLabel());
        $this->assertEquals('Save', $save->getLabel());

    } // END function test_init

} // END class Tests_1.0.0_Athlete