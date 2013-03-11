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
        $scale = $form->getElement('scale_id');
        $save = $form->getElement('save');

        $this->assertInstanceOf('Zend_Form_Element_Text', $name);
        $this->assertInstanceOf('Zend_Form_Element_Submit', $save);
        $this->assertInstanceOf('Zend_Form_Element_Hidden', $event);
        $this->assertInstanceOf('Zend_Form_Element_Select', $scale);

        $this->assertEquals('Name', $name->getLabel());
        $this->assertEquals('Scale', $scale->getLabel());
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
    public function test_injectDependencies ($params = array())
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getParent'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject = $this->getMockBuilder('App_Form_Athlete')
            ->setMethods(array('_insertScales'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('_insertScales')
            ->with($this->equalTo($model), $this->equalTo($params))
            ->will($this->returnSelf());

        $result = $subject->injectDependencies($model, $params);

        $this->assertSame($subject, $result);

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
            'no params' => array(),
        );

    } // END function provide_injectDependencies

    /**
     * test__insertScales()
     *
     * Tests the _insertScales method of the App_Form_Athlete class
     *
     * @covers App_Form_Athlete::_insertScales
     * @dataProvider provide__insertScales
     */
    public function test__insertScales ($params = array(), $scales = array())
    {

        // $table = $model->getParent('Scale')->getTable();

        // $scales = $table->fetchAll(
        //     $table->select()->where(sprintf('event_id = %d', @$params['event_id']))
        // );

        // $element = $this->getElement('scale_id');

        // foreach ($scales as $scale) {
        //     $element->addMultiOption($scale->id, $scale->name);
        // }

        $subject = $this->getMockBuilder('App_Form_Athlete')
            ->setMethods(array('getElement'))
            ->disableOriginalConstructor()
            ->getMock();

        $model = $this->getMockBuilder('App_Model_Athlete')
            ->setMethods(array('getParent'))
            ->disableOriginalConstructor()
            ->getMock();

        $scaleModel = $this->getMockBuilder('App_Model_Scale')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $select = $this->getMockBuilder('Zend_Db_Table_Select')
            ->setMethods(array('where'))
            ->disableOriginalConstructor()
            ->getMock();

        $table = $this->getMockBuilder('Zend_Db_Table_Abstract')
            ->setMethods(array('fetchAll', 'select'))
            ->disableOriginalConstructor()
            ->getMock();

        $scaleElement = $this->getMockBuilder('Zend_Form_Element_Select')
            ->setMethods(array('addMultiOption'))
            ->disableOriginalConstructor()
            ->getMock();

        $scaleElement->expects($this->exactly(count($scales)))
            ->method('addMultiOption');

        $select->expects($this->once())
            ->method('where')
            ->with($this->equalTo(sprintf('event_id = %d', @$params['event_id'])))
            ->will($this->returnSelf());

        $table->expects($this->once())
            ->method('select')
            ->will($this->returnValue($select));

        $table->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo($select))
            ->will($this->returnValue($scales));

        $scaleModel->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($table));

        $model->expects($this->once())
            ->method('getParent')
            ->with($this->equalTo('Scale'))
            ->will($this->returnValue($scaleModel));

        $subject->expects($this->once())
            ->method('getElement')
            ->with($this->equalTo('scale_id'))
            ->will($this->returnValue($scaleElement));

        $method = new ReflectionMethod('App_Form_Athlete', '_insertScales');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $model, $params);

        $this->assertSame($subject, $result);

    } // END function test__insertEvents

    /**
     * provide__insertScales()
     *
     * Provides data to use for testing the _insertEvents method of
     * the App_Form_Athlete class
     *
     * @return array
     */
    public function provide__insertScales ( )
    {
        return array(
            'no params, no events' => array(
                array(), array(),
            ),

            'no params, 1 scale' => array(
                array(), array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'scale name',
                    )
                ),
            ),
        );

    } // END function provide__insertScales

} // END class Tests_1.0.0_Athlete