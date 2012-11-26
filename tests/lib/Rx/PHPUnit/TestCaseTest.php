<?php
/**
 * Rx_PHPUnit_TestCase Unit Test
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_PHPUnit_TestCase class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Model
 * @copyright   Copyright (c) 2012 Rx Gym, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Rx_PHPUnit_TestCase Unit Test
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_PHPUnit_TestCase class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Model
 * @copyright   Copyright (c) 2012 Rx Gym, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_PHPUnit_TestCaseTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_getMethod()
     *
     * Tests the getMethod of the Rx_PHPUnit_TestCase
     *
     * @covers          Rx_PHPUnit_TestCase::getMethod
     * @dataProvider    provide_getMethod
     */
    public function test_getMethod ($class, $method)
    {
        $subject = $this->getMockForAbstractClass('Rx_PHPUnit_TestCase');

        $result = $subject->getMethod($class, $method);

        $this->assertInstanceOf('ReflectionMethod', $result);

    } // END function test_getMethod

    /**
     * provide_getMethod()
     *
     * Provides data for the getMethod method of the
     * Rx_PHPUnit_TestCase class
     */
    public function provide_getMethod ( )
    {
        return array(
            array(
                'Rx_PHPUnit_TestCase', 'getMethod',
            ),
        );

    } // END function provide_getMethod

} // END class Tests_Rx_Model_AbstractTest
