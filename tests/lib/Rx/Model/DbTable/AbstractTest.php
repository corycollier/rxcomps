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
 * @version     Release: 2.0.6
 * @since       File available since release 2.0.6
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
 * @version     Release: 2.0.6
 * @since       Class available since release 2.0.6
 */

class Tests_Rx_Model_DbTable_Abstract
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_unitTestCheck()
     *
     * Tests the unitTestCheck of the Rx_Model_DbTable_Abstract
     *
     * @covers          Rx_Model_DbTable_Abstract::unitTestCheck
     * @dataProvider    provide_unitTestCheck
     */
    public function test_unitTestCheck ($expected)
    {
        $subject = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $result = $subject->unitTestCheck();

        $this->assertEquals($expected, $result);

    } // END function test_unitTestCheck

    /**
     * provide_unitTestCheck()
     *
     * Provides data for the unitTestCheck method of the
     * Rx_Model_DbTable_Abstract class
     */
    public function provide_unitTestCheck ( )
    {
        return array(
            array('unit test check'),
        );

    } // END function provide_unitTestCheck

} // END class Tests_2Tests_Rx_Model_DbTable_Abstract