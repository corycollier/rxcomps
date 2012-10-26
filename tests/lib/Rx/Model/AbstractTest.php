<?php
/**
 * Rx_Model_Abstract Unit Test
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_Model_Abstract class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Model
 * @copyright   Copyright (c) 2012 Rx Gym, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Rx_Model_Abstract Unit Test
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_Model_Abstract class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Model
 * @copyright   Copyright (c) 2012 Rx Gym, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_Rx_Model_AbstractTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_getName()
     *
     * Tests the getName method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::getName
     */
    public function test_getName ( )
    {
        $subject = new Rx_Model_Abstract;

        $result = $subject->getName();

        $this->assertEquals('Abstract', $result);

    } // END function test_getName

    /**
     * test_getValue()
     *
     * Tests the getValue method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::getValue
     * @dataProvider provide_getValue
     */
    public function test_getValue ($expected, $name)
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getForm'))
            ->disableOriginalConstructor()
            ->getMock();

        $form = $this->getMockBuilder('Rx_Form_Abstract')
            ->setMethods(array('getValue'))
            ->disableOriginalConstructor()
            ->getMock();

        $form->expects($this->once())
            ->method('getValue')
            ->with($this->equalTo($name))
            ->will($this->returnValue($expected));

        $model->expects($this->once())
            ->method('getForm')
            ->will($this->returnValue($form));

        $result = $model->getValue($name);

        $this->assertEquals($expected, $result);

    } // END function test_getValue

    /**
     * provide_getValue()
     *
     * Provides data to use for testing the getValue method of
     * the Rx_Model_Abstract class
     *
     * @return array
     */
    public function provide_getValue ( )
    {
        return array(
            array('expected value', 'name value'),
        );

    } // END function provide_getValue

    /**
     * test_getForm()
     *
     * Tests the getForm of the Rx_Model_Abstract
     *
     * @covers          Rx_Model_Abstract::getForm
     * @dataProvider    provide_getForm
     */
    public function test_getForm ( )
    {
        $model = new Rx_Model_Abstract;

        $firstResult = $model->getForm();

        $this->assertInstanceOf('Rx_Form_Abstract', $firstResult);

        $secondResult = $model->getForm(true);

        $this->assertInstanceOf('Rx_Form_Abstract', $secondResult);

        $this->assertNotSame($firstResult, $secondResult);


    } // END function test_getForm

    /**
     * provide_getForm()
     *
     * Provides data for the getForm method of the
     * Rx_Model_Abstract class
     */
    public function provide_getForm ( )
    {
        return array(
            array()
        );

    } // END function provide_getForm

    /**
     * test_getTable()
     *
     * Tests the getTable of the Rx_Model_Abstract
     *
     * @covers            Rx_Model_Abstract::getTable
     * @dataProvider    provide_getTable
     */
    public function test_getTable ( )
    {
        $model = new Rx_Model_Abstract;

        $firstResult = $model->getTable();

        $this->assertInstanceOf('Rx_Model_DbTable_Abstract', $firstResult);

        $secondResult = $model->getTable(true);

        $this->assertInstanceOf('Rx_Model_DbTable_Abstract', $secondResult);

        $this->assertNotSame($firstResult, $secondResult);

    } // END function test_getTable

    /**
     * provide_getTable()
     *
     * Provides data for the getTable method of the
     * Rx_Model_Abstract class
     */
    public function provide_getTable ( )
    {
        return array(
            array(),
        );

    } // END function provide_getTable

    /**
     * test_filterValues()
     *
     * Tests the filterValues method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::filterValues
     * @dataProvider provide_filterValues
     */
    public function test_filterValues ($expected, $info, $values = array())
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $table = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('info'))
            ->disableOriginalConstructor()
            ->getMock();

        $table->expects($this->once())
            ->method('info')
            ->will($this->returnValue($info));

        $model->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($table));

        $result = $model->filterValues($values);

        $this->assertEquals($expected, $result);

    } // END function test_filterValues

    /**
     * provide_filterValues()
     *
     * Provides data to use for testing the filterValues method of
     * the Rx_Model_Abstract class
     *
     * @return array
     */
    public function provide_filterValues ( )
    {
        return array(
            'no matched values' => array(
                array(),
                array('cols' => array('col1', 'col2')),
                array('val1' => 2)
            ),

            'buttons values should not get in' => array(
                array('col1' => 1, 'col2' => 2),
                array('cols' => array('col1', 'col2')),
                array('col1' => 1, 'col2' => 2, 'buttons' => array())
            ),

        );

    } // END function provide_filterValues

    /**
     * test_load()
     *
     * Tests the load method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::load
     * @dataProvider provide_load
     */
    public function test_load ($row, $identity, $formValues = array())
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getTable', 'getForm'))
            ->disableOriginalConstructor()
            ->getMock();

        $table = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('select', 'fetchRow'))
            ->disableOriginalConstructor()
            ->getMock();

        $select = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('where', 'fetchRow'))
            ->disableOriginalConstructor()
            ->getMock();

        $form = $this->getMockBuilder('Rx_Form_Abstract')
            ->setMethods(array('populate'))
            ->disableOriginalConstructor()
            ->getMock();

        if ($row) {
            $row = $this->getMockBuilder('Zend_Db_Table_Row')
                ->setMethods(array('toArray'))
                ->disableOriginalConstructor()
                ->getMock();

            $row->expects($this->once())
                ->method('toArray')
                ->will($this->returnValue($formValues));

            $form->expects($this->once())
                ->method('populate')
                ->with($this->equalTo($formValues));
        }

        $select->expects($this->once())
            ->method('where')
            ->with($this->equalTo('id = ?'), $this->equalTo($identity))
            ->will($this->returnSelf());

        $table->expects($this->once())
            ->method('fetchRow')
            ->with($this->equalTo($select))
            ->will($this->returnValue($row));

        $table->expects($this->once())
            ->method('select')
            ->will($this->returnValue($select));

        $model->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($table));

        $model->expects($this->once())
            ->method('getForm')
            ->will($this->returnValue($form));

        $result = $model->load($identity);

        $this->assertSame($model, $result);

    } // END function test_load

    /**
     * provide_load()
     *
     * Provides data to use for testing the load method of
     * the Rx_Model_Abstract class
     *
     * @return array
     */
    public function provide_load ( )
    {
        $row = $this->getMockBuilder('Zend_Db_Table_Row')
            ->setMethods(array('toArray'))
            ->disableOriginalConstructor()
            ->getMock();

        return array(
            array(false, 1),
            array(true, 1),
        );

    } // END function provide_load

    /**
     * test__delete()
     *
     * Tests the delete method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::_delete
     * @dataProvider provide__delete
     */
    public function test__delete ($identity, $exception = '')
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $table = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('select', 'delete'))
            ->disableOriginalConstructor()
            ->getMock();

        if ($exception) {
            $this->setExpectedException($exception);
        } else {
            $table->expects($this->once())
                ->method('delete')
                ->with($this->equalTo(sprintf('id = %d', $identity)));

            $model->expects($this->once())
                ->method('getTable')
                ->will($this->returnValue($table));
        }

        $model->id = $identity;

        $method = new ReflectionMethod('Rx_Model_Abstract', '_delete');
        $method->setAccessible(true);
        $method->invoke($model, $identity);

    } // END function test__delete

    /**
     * provide__delete()
     *
     * Provides data to use for testing the _delete method of
     * the Rx_Model_Abstract class
     *
     * @return array
     */
    public function provide__delete ( )
    {
        return array(
            array(1),
            array(null, 'Rx_Model_Exception'),
            array(0, 'Rx_Model_Exception'),
            array(false, 'Rx_Model_Exception'),
        );

    } // END function provide__delete

    /**
     * test__edit()
     *
     * Tests the edit method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::_edit
     * @dataProvider provide__edit
     */
    public function test__edit ($isValid, $identity, $values, $exception = '')
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getTable', 'getForm', 'filterValues'))
            ->disableOriginalConstructor()
            ->getMock();

        $table = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('update', 'select'))
            ->disableOriginalConstructor()
            ->getMock();

        $form = $this->getMockBuilder('Rx_Form_Abstract')
            ->setMethods(array('isValid', 'getValues'))
            ->disableOriginalConstructor()
            ->getMock();

        if ($exception) {
            $this->setExpectedException($exception);
        } else {
            $table->expects($this->once())
                ->method('update')
                ->with($this->equalto($values), $this->equalTo(sprintf('id = %d', $identity)));

            $form->expects($this->once())
                ->method('isValid')
                ->with($this->equalTo($values))
                ->will($this->returnValue($isValid));

            $form->expects($this->once())
                ->method('getValues')
                ->will($this->returnValue($values));
        }

        $model->expects($this->once())
            ->method('getForm')
            ->will($this->returnValue($form));

        $model->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($table));

        $model->id = $identity;

        $method = new ReflectionMethod('Rx_Model_Abstract', '_edit');
        $method->setAccessible(true);
        $result = $method->invoke($model, $values);

        $this->assertSame($model, $result);

    } // END function test__edit

    /**
     * provide__edit()
     *
     * Provides data to use for testing the edit method of
     * the Rx_Model_Abstract class
     *
     * @return array
     */
    public function provide__edit ( )
    {
        // $isValid, $identity, $values, $exception = ''
        return array(
            'simple test' => array(true, 1, array(
                'name' => 'value',
            )),

            'invalid form, expect exception' => array(false, 1, array(
                'name' => 'value',
            ), 'Rx_Model_Exception'),
        );

    } // END function provide__edit

    /**
     * test__create()
     *
     * Tests the create method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::_create
     * @dataProvider provide__create
     */
    public function test__create ($isValid, $identity, $values, $exception = '')
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getTable', 'getForm'))
            ->disableOriginalConstructor()
            ->getMock();

        $table = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('insert'))
            ->disableOriginalConstructor()
            ->getMock();

        $form = $this->getMockBuilder('Rx_Form_Abstract')
            ->setMethods(array('isValid', 'getValues'))
            ->disableOriginalConstructor()
            ->getMock();

        if ($exception) {
            $this->setExpectedException($exception);
        } else {
            $table->expects($this->once())
                ->method('insert')
                ->with($this->equalto($values))
                ->will($this->returnValue($identity));

            $form->expects($this->once())
                ->method('isValid')
                ->with($this->equalTo($values))
                ->will($this->returnValue($isValid));

            $form->expects($this->once())
                ->method('getValues')
                ->will($this->returnValue($values));
        }

        $model->expects($this->once())
            ->method('getForm')
            ->will($this->returnValue($form));

        $model->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($table));

        $method = new ReflectionMethod('Rx_Model_Abstract', '_create');
        $method->setAccessible(true);
        $result = $method->invoke($model, $values);

        $this->assertSame($model, $result);

        $this->assertEquals($identity, $model->id);

    } // END function test__create

    /**
     * provide__create()
     *
     * Provides data to use for testing the _create method of
     * the Rx_Model_Abstract class
     *
     * @return array
     */
    public function provide__create ( )
    {
        // $isValid, $values, $exception = ''
        return array(
            'simple test' => array(true, 1, array(
                'name' => 'value',
            )),

            'invalid form, expect exception' => array(false, 1, array(
                'name' => 'value',
            ), 'Rx_Model_Exception'),
        );

    } // END function provide__create

    /**
     * test_paginate()
     *
     * Tests the paginate method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::paginate
     * @dataProvider provide_paginate
     */
    public function test_paginate ($expected, $params = array())
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getTable', 'getForm'))
            ->disableOriginalConstructor()
            ->getMock();

        $table = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('getPaginationAdapter'))
            ->disableOriginalConstructor()
            ->getMock();

        $paginator = $this->getMockBuilder('Zend_Paginator_Adapter_DbTableSelect')
            ->setMethods(array('getItems'))
            ->disableOriginalConstructor()
            ->getMock();

        $rowset = $this->getMockBuilder('Zend_Db_Table_Rowset_Abstract')
            ->setMethods(array('toArray'))
            ->disableOriginalConstructor()
            ->getMock();

        $rowset->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($expected));

        $paginator->expects($this->once())
            ->method('getItems')
            // ->with
            ->will($this->returnValue($rowset));

        $table->expects($this->once())
            ->method('getPaginationAdapter')
            ->will($this->returnValue($paginator));

        $model->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($table));

        $result = $model->paginate($params);

        $this->assertEquals($expected, $result);

    } // END function test_paginate

    /**
     * provide_paginate()
     *
     * Provides data to use for testing the paginate method of
     * the Rx_Model_Abstract class
     *
     * @return array
     */
    public function provide_paginate ( )
    {
        return array(
            array(array(
                array(
                    'id' => 1,
                ),
                array(
                    'id' => 2,
                ),
            )),
        );

    } // END function provide_paginate

    /**
     * test_edit()
     *
     * Tests the edit method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::edit
     * @dataProvider provide_edit
     */
    public function test_edit ($values = array())
    {
        $subject = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('_edit'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('_edit')
            ->with($this->equalTo($values))
            ->will($this->returnSelf());

        $result = $subject->edit($values);

        $this->assertSame($subject, $result);

    } // END function test_edit

    /**
     * provide_edit()
     *
     * Provides data to use for testing the edit method of
     * the Rx_Model_Abstract class
     *
     * @return array
     */
    public function provide_edit ( )
    {
        return array(
            array(array(
                'key' => 'value'
            )),
        );

    } // END function provide_edit

    /**
     * test_create()
     *
     * Tests the create method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::create
     * @dataProvider provide_create
     */
    public function test_create ($values = array())
    {
        $subject = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('_create'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('_create')
            ->with($this->equalTo($values))
            ->will($this->returnSelf());

        $result = $subject->create($values);

        $this->assertSame($subject, $result);

    } // END function test_create

    /**
     * provide_create()
     *
     * Provides data to use for testing the create method of
     * the Rx_Model_Abstract class
     *
     * @return array
     */
    public function provide_create ( )
    {
        return array(
            array(array(
                'key' => 'value'
            )),
        );

    } // END function provide_create

    /**
     * test_delete()
     *
     * Tests the delete method of the Rx_Model_Abstract class
     *
     * @covers Rx_Model_Abstract::delete
     */
    public function test_delete ( )
    {
        $subject = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('_delete'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('_delete')
            ->will($this->returnValue(null));

        $result = $subject->delete();

        $this->assertNull($result);

    } // END function test_delete

} // END class Tests_Rx_Model_AbstractTest