<?php
/**
 * Competition Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Competition class
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
 * Competition Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Competition class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Form_Competition
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_init()
     *
     * Tests the init of the App_Form_Competition
     *
     * @covers App_Form_Competition::init
     */
    public function test_init ( )
    {
        $form = new App_Form_Competition;

        $name = $form->getElement('name');
        $description = $form->getElement('description');
        $goal = $form->getElement('goal');
        $event = $form->getElement('event');
        $save = $form->getElement('save');

        $this->assertInstanceOf('Zend_Form_Element_Text', $name);
        $this->assertInstanceOf('Zend_Form_Element_Textarea', $description);
        $this->assertInstanceOf('Zend_Form_Element_Select', $goal);
        $this->assertInstanceOf('Zend_Form_Element_Select', $event);
        $this->assertInstanceOf('Zend_Form_Element_Submit', $save);

        $this->assertEquals('Name', $name->getLabel());
        $this->assertEquals('Description', $description->getLabel());
        $this->assertEquals('Goal', $goal->getLabel());
        $this->assertEquals('Event', $event->getLabel());
        $this->assertEquals('Save', $save->getLabel());

    } // END function test_init

} // END class Tests_1.0.0_Competition