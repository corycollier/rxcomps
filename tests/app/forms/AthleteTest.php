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

    /**
     * test_injectDependencies()
     *
     * Tests the injectDependencies method of the App_Form_Athlete class
     *
     * @covers App_Form_Athlete::injectDependencies
     * @dataProvider provide_injectDependencies
     */
    public function test_injectDependencies ($events = array())
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getParent'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventModel = $this->getMockBuilder('App_Model_Event')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $table = $this->getMockBuilder('Zend_Db_Table_Abstract')
            ->setMethods(array('fetchAll'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventElement = $this->getMockBuilder('Zend_Form_Element_Select')
            ->setMethods(array('addMultiOption'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject = $this->getMockBuilder('App_Form_Athlete')
            ->setMethods(array('getElement'))
            ->disableOriginalConstructor()
            ->getMock();

        $eventElement->expects($this->exactly(count($events)))
            ->method('addMultiOption');

        $subject->expects($this->once())
            ->method('getElement')
            ->with($this->equalTo('event_id'))
            ->will($this->returnValue($eventElement));

        $table->expects($this->once())
            ->method('fetchAll')
            ->will($this->returnValue($events));

        $eventModel->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($table));

        $model->expects($this->once())
            ->method('getParent')
            ->with($this->equalTo('Event'))
            ->will($this->returnValue($eventModel));

        $subject->injectDependencies($model);

    } // END function test_injectDependencies

    /**
     * provide_injectDependencies()
     *
     * Provides data to use for testing the injectDependencies method of
     * the App_Form_Athlete class
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

} // END class Tests_1.0.0_Athlete