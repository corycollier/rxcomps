<?php
/**
 * Unit Test Suite for the Scale class
 *
 * This unit test suite should test all of the custom functionality provided
 * by the App_Form_Scale class
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
 * Unit Test Suite for the Scale
 *
 * This unit test suite should test all of the custom functionality provided
 * by the App_Form_Scale class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Form_ScaleTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_init()
     *
     * Tests the init method of the App_Form_Scale class
     *
     * @covers App_Form_Scale::init
     */
    public function test_init ( )
    {
        $form = new App_Form_Scale;

        $name = $form->getElement('name');
        $code = $form->getElement('code');
        $event = $form->getElement('event_id');
        $save = $form->getElement('save');

        $this->assertInstanceOf('Zend_Form_Element_Text', $name);
        $this->assertInstanceOf('Zend_Form_Element_Text', $code);
        $this->assertInstanceOf('Zend_Form_Element_Select', $event);
        $this->assertInstanceOf('Zend_Form_Element_Submit', $save);

        $this->assertEquals('Name', $name->getLabel());
        $this->assertEquals('Code', $code->getLabel());
        $this->assertEquals('Event', $event->getLabel());
        $this->assertEquals('Save', $save->getLabel());

    } // END function test_init

    /**
     * test_injectDependencies()
     *
     * Tests the injectDependencies method of the App_Form_Scale class
     *
     * @covers App_Form_Scale::injectDependencies
     * @dataProvider provide_injectDependencies
     */
    public function test_injectDependencies ($events = array(), $scales = array())
    {
        $model = $this->getMockBuilder('App_Model_Scale')
            ->setMethods(array('getParent'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventModel = $this->getMockBuilder('App_Model_Event')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventTable = $this->getMockBuilder('App_Model_DbTable_Event')
            ->setMethods(array('fetchAll', 'buildWhere'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventElement = $this->getMockBuilder('Zend_Form_Element_Select')
            ->setMethods(array('addMultiOption'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject = $this->getMockBuilder('App_Form_Scale')
            ->setMethods(array('getElement'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventElement->expects($this->exactly(count($events)))
            ->method('addMultiOption');

        $subject->expects($this->any())
            ->method('getElement')
            ->with($this->equalTo('event_id'))
            ->will($this->returnValue($eventElement));

        $eventTable->expects($this->once())
            ->method('fetchAll')
            ->will($this->returnValue($events));

        $eventModel->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($eventTable));

        $model->expects($this->any())
            ->method('getParent')
            ->will($this->returnValue($eventModel));

        $subject->injectDependencies($model);

    } // END function test_injectDependencies

    /**
     * provide_injectDependencies()
     *
     * Provides data to use for testing the injectDependencies method of
     * the App_Form_Scale class
     *
     * @return array
     */
    public function provide_injectDependencies ( )
    {
        return array(
            'no events' => array(),

            '1 event' => array(array(
                (object)array(
                    'id'    => 1,
                    'name'  => 'value',
                ),
            )),

            '2 events' => array(array(
                (object)array(
                    'id'    => 1,
                    'name'  => 'value',
                ),
                (object)array(
                    'id'    => 1,
                    'name'  => 'value',
                ),
            )),
        );

    } // END function provide_injectDependencies
} // END class Tests_App_Form_ScaleTest