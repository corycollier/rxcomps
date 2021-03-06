<?php
/**
 * Abstract Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Abstract class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Model_DbTable
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Abstract Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Abstract class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Model_DbTable
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_Rx_Model_DbTable_Abstract
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_getPaginationAdapter()
     *
     * Tests the getPaginationAdapter method of the Rx_Model_DbTable_Abstract class
     *
     * @covers Rx_Model_DbTable_Abstract::getPaginationAdapter
     */
    public function test_getPaginationAdapter ( )
    {
        $subject = $this->getBuiltMock('Rx_Model_DbTable_Abstract', array('buildWhere'));
        $select = $this->getBuiltMock('Zend_Db_Table_Select');

        $subject->expects($this->once())
            ->method('buildWhere')
            ->will($this->returnValue($select));

        $result = $subject->getPaginationAdapter();

        $this->assertInstanceOf('Zend_Paginator_Adapter_DbTableSelect', $result);

    } // END function test_getPaginationAdapter

    /**
     * test_buildWhere()
     *
     * Tests the buildWhere of the Rx_Model_DbTable_Abstract
     *
     * @covers          Rx_Model_DbTable_Abstract::buildWhere
     * @dataProvider    provide_buildWhere
     */
    public function test_buildWhere ($data = array())
    {
        // $select = $this->select();
        // $values = $this->filterValues(array_diff_key($data, array('id' => null)));

        // foreach ($values as $key => $value) {
        //     $select->where(sprintf("{$key} = '%s'", $value));
        // }

        // return $select;

        $filtered = array_diff_key($data, array('id' => null));

        $subject = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('select', 'filterValues'))
            ->disableOriginalConstructor()
            ->getMock();

        $select = $this->getMockBuilder('Zend_Db_Table_Select')
            ->setMethods(array('where'))
            ->disableOriginalConstructor()
            ->getMock();

        $select->expects($this->exactly(count($filtered)))->method('where');

        $subject->expects($this->once())
            ->method('select')
            ->will($this->returnValue($select));

        $subject->expects($this->once())
            ->method('filterValues')
            ->with($this->equalTo($filtered))
            ->will($this->returnValue($filtered));

        $result = $subject->buildWhere($data);

        $this->assertEquals($select, $result);

    } // END function test_buildWhere

    /**
     * provide_buildWhere()
     *
     * Provides data for the buildWhere method of the
     * Rx_Model_DbTable_Abstract class
     */
    public function provide_buildWhere ( )
    {
        return array(
            'id value only' => array(array(
                'id'     => 1,
            )),

            '2 values' => array(array(
                'id'     => 1,
                'name'   => 'the name',
            )),
        );

    } // END function provide_buildWhere

    /**
     * test_filterValues()
     *
     * Tests the filterValues of the Rx_Model_DbTable_Abstract
     *
     * @covers          Rx_Model_DbTable_Abstract::filterValues
     * @dataProvider    provide_filterValues
     */
    public function test_filterValues ($expected, $info, $values = array())
    {
        $subject = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('info'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('info')
            ->will($this->returnValue($info));

        $result = $subject->filterValues($values);

        $this->assertEquals($expected, $result);

    } // END function test_filterValues

    /**
     * provide_filterValues()
     *
     * Provides data for the filterValues method of the
     * Rx_Model_DbTable_Abstract class
     */
    public function provide_filterValues ( )
    {
        return array(
            'no matching columns' => array(
                array(),
                array('cols' => array(
                    'col1',
                    'col2',
                )),
                array(
                    'key1' => 'value1',
                )
            ),

            '1 matching column' => array(
                array(
                    'col1' => 'value2',
                ),
                array('cols' => array(
                    'col1',
                    'col2',
                )),
                array(
                    'key1' => 'value1',
                    'col1' => 'value2',
                )
            ),

            '2 matching columns' => array(
                array(
                    'col1' => 'value1',
                    'col2' => 'value2',
                ),
                array('cols' => array(
                    'col1',
                    'col2',
                )),
                array(
                    'col1' => 'value1',
                    'col2' => 'value2',
                )
            ),

        );

    } // END function provide_filterValues

    /**
     * test_insert()
     *
     * Tests the insert method of the Rx_Model_DbTable_Abstract class
     *
     * @covers Rx_Model_DbTable_Abstract::insert
     * @dataProvider provide_insert
     */
    public function test_insert ($values = array())
    {
        $subject = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('filterValues', '_setupPrimaryKey'))
            ->disableOriginalConstructor()
            ->getMock();

        $db = $this->getMockBuilder('Zend_Db_Adapter_Pdo_Pgsql')
            ->setMethods(array('nextSequenceId', 'insert', 'lastInsertId'))
            ->disableOriginalConstructor()
            ->getMock();

        $dbProperty = new ReflectionProperty('Rx_Model_DbTable_Abstract', '_db');
        $dbProperty->setAccessible(true);
        $dbProperty->setValue($subject, $db);

        $primaryProperty = new ReflectionProperty('Rx_Model_DbTable_Abstract', '_primary');
        $primaryProperty->setAccessible(true);
        $primaryProperty->setValue($subject, 'primary_key');

        $identityProperty = new ReflectionProperty('Rx_Model_DbTable_Abstract', '_identity');
        $identityProperty->setAccessible(true);
        $identityProperty->setValue($subject, 0);

        $subject->expects($this->once())
            ->method('filterValues')
            ->with($this->equalTo($values))
            ->will($this->returnValue($values));

        $result = $subject->insert($values);

    } // END function test_insert

    /**
     * provide_insert()
     *
     * Provides data to use for testing the insert method of
     * the Rx_Model_DbTable_Abstract class
     *
     * @return array
     */
    public function provide_insert ( )
    {
        return array(
            array(),
        );

    } // END function provide_insert

    /**
     * test_update()
     *
     * Tests the update method of the Rx_Model_DbTable_Abstract class
     *
     * @covers Rx_Model_DbTable_Abstract::update
     * @dataProvider provide_update
     */
    public function test_update ($expected, $values = array(), $where = '')
    {
    // public function update(array $data, $where)
    // {
    //     $tableSpec = ($this->_schema ? $this->_schema . '.' : '') . $this->_name;
    //     return $this->_db->update($tableSpec, $data, $where);
    // }

        $subject = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('filterValues'))
            ->disableOriginalConstructor()
            ->getMock();

        $db = $this->getMockBuilder('Zend_Db_Adapter_Pdo_Pgsql')
            ->setMethods(array('update'))
            ->disableOriginalConstructor()
            ->getMock();

        $db->expects($this->once())
            ->method('update')
            ->with(
                $this->equalTo(''),
                $this->equalTo($values),
                $this->equalTo($where)
            )
            ->will($this->returnValue($expected));

        $dbProperty = new ReflectionProperty('Rx_Model_DbTable_Abstract', '_db');
        $dbProperty->setAccessible(true);
        $dbProperty->setValue($subject, $db);

        $subject->expects($this->once())
            ->method('filterValues')
            ->with($this->equalTo($values))
            ->will($this->returnValue($values));

        $result = $subject->update($values, $where);

        $this->assertEquals($expected, $result);

    } // END function test_update

    /**
     * provide_update()
     *
     * Provides data to use for testing the update method of
     * the Rx_Model_DbTable_Abstract class
     *
     * @return array
     */
    public function provide_update ( )
    {
        return array(
            'no values, no where' => array('expected'),
        );

    } // END function provide_update

} // END class Tests_2Tests_Rx_Model_DbTable_Abstract