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
        $event = $form->getElement('event_id');
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

    /**
     * test_injectDependencies()
     *
     * Tests the injectDependencies method of the App_Form_Competition class
     *
     * @covers App_Form_Competition::injectDependencies
     * @dataProvider provide_injectDependencies
     */
    public function test_injectDependencies ($events = array(), $scales = array())
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getParent'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventModel = $this->getMockBuilder('App_Model_Event')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $scaleModel = $this->getMockBuilder('App_Model_Event')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventTable = $this->getMockBuilder('App_Model_DbTable_Event')
            ->setMethods(array('fetchAll', 'buildWhere'))
            ->disableOriginalConstructor()
            ->getMock();

        $scaleTable = $this->getMockBuilder('App_Model_DbTable_Scale')
            ->setMethods(array('fetchAll', 'buildWhere'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventElement = $this->getMockBuilder('Zend_Form_Element_Select')
            ->setMethods(array('addMultiOption'))
            ->disableOriginalConstructor()
            ->getMock();

        $scaleElement = $this->getMockBuilder('Zend_Form_Element_Select')
            ->setMethods(array('addMultiOption'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject = $this->getMockBuilder('App_Form_Competition')
            ->setMethods(array('getElement'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventElement->expects($this->exactly(count($events)))
            ->method('addMultiOption');

        $scaleElement->expects($this->exactly(count($scales)))
            ->method('addMultiOption');

        $subject->expects($this->any())
            ->method('getElement')
            ->will($this->returnValueMap(array(
                array('event_id', $eventElement),
                array('sacle_id', $scaleElement),
            )));

        $eventTable->expects($this->once())
            ->method('fetchAll')
            ->will($this->returnValue($events));

        $scaleTable->expects($this->once())
            ->method('fetchAll')
            ->will($this->returnValue($scales));

        $eventModel->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($eventTable));

        $scaleModel->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($scaleTable));

        $model->expects($this->any())
            ->method('getParent')
            ->will($this->returnValueMap(array(
                array('Event', $eventModel),
                array('Scale', $scaleModel),
            )));

        $subject->injectDependencies($model);

    } // END function test_injectDependencies

    /**
     * provide_injectDependencies()
     *
     * Provides data to use for testing the injectDependencies method of
     * the App_Form_Competition class
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

} // END class Tests_1.0.0_Competition