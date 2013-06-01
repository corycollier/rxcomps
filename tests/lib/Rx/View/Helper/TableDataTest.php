<?php
/**
 * Unit Test Suite for the Rx_View_Helper_TableData class
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_TableData class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the Rx_View_Helper_TableData
 *
 * This unit test suite should test all custom functionality provided by the
 * Rx_View_Helper_TableData class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_View_Helper_TableDataTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_getTable()
     *
     * Tests the getTable method of the Rx_View_Helper_TableData class
     *
     * @covers Rx_View_Helper_TableData::getTable
     * @dataProvider provide_getTable
     */
    public function test_getTable ($expected, $table)
    {
        $subject = $this->getBuiltMock('Rx_View_Helper_TableData', array('_getModel'));
        $model  = $this->getBuiltMock('Rx_Model_Abstract', array('getTable'));

        $model->expects($this->once())
            ->method('getTable')
            ->with($this->equalTo($table))
            ->will($this->returnValue($expected));

        $subject->expects($this->once())
            ->method('_getModel')
            ->will($this->returnValue($model));

        $result = $subject->getTable($table);

        $this->assertEquals($expected, $result);

    } // END function test_getTable

    /**
     * provide_getTable()
     *
     * Provides data to use for testing the getTable method of
     * the Rx_View_Helper_TableData class
     *
     * @return array
     */
    public function provide_getTable ( )
    {
        return array(
            array(
                'expected'  => 'expected value',
                'table'     => 'table name',
            ),
        );

    } // END function provide_getTable

    /**
     * test__getModel()
     *
     * Tests the _getModel method of the Rx_View_Helper_TableData class
     *
     * @covers Rx_View_Helper_TableData::_getModel
     */
    public function test__getModel ( )
    {
        $subject = new Rx_View_Helper_TableData;
        $method = new ReflectionMethod('Rx_View_Helper_TableData', '_getModel');
        $method->setAccessible(true);
        $result = $method->invoke($subject);

        $this->assertInstanceOf('Rx_Model_Abstract', $result);

    } // END function test__getModel

    /**
     * test___construct()
     *
     * Tests the __construct method of the Rx_View_Helper_TableData class
     *
     * @covers Rx_View_Helper_TableData::__construct
     */
    public function test___construct ( )
    {
        $subject = $this->getBuiltMock('Rx_View_Helper_TableData');
        $subject->__construct();

    } // END function test___construct

} // END class Tests_Rx_View_Helper_TableDataTest