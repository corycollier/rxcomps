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
     * test_getForm()
     *
     * Tests the getForm of the Rx_Model_Abstract
     *
     * @covers            Rx_Model_Abstract::getForm
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
    public function filterValues ($values = array())
    {
        $info = $this->getTable()->info();

        $columns = array_flip($info['cols']);

        return array_intersect_key($values, $columns);

    } // END function filterValues
    */

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

} // END class Tests_Rx_Model_AbstractTest