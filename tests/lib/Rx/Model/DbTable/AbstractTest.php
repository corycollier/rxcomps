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
    extends PHPUnit_Framework_TestCase
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
        $subject = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('select'))
            ->disableOriginalConstructor()
            ->getMock();

        $select = $this->getMockBuilder('Zend_Db_Table_Select')
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('select')
            ->will($this->returnValue($select));

        $result = $subject->getPaginationAdapter();

        $this->assertInstanceOf('Zend_Paginator_Adapter_DbTableSelect', $result);

    } // END function test_getPaginationAdapter

} // END class Tests_2Tests_Rx_Model_DbTable_Abstract