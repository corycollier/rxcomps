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
     * test_getBuiltMock()
     *
     * Tests the getBuiltMock of the Rx_PHPUnit_TestCase
     *
     * @covers          Rx_PHPUnit_TestCase::getBuiltMock
     * @dataProvider    provide_getBuiltMock
     */
    public function test_getBuiltMock ($expected, $className, $methods = array())
    {
        $builder = $this->getMockBuilder('PHPUnit_Framework_MockObject_MockBuilder')
            ->setMethods(array('setMethods', 'disableOriginalConstructor', 'getMock'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject = $this->getMockBuilder('Rx_PHPUnit_TestCase')
            ->setMethods(array(
                'getMockBuilder',
            ))
            ->disableOriginalConstructor()
            ->getMock();

        $builder->expects($this->once())
            ->method('getMock')
            ->will($this->returnValue($expected));

        $builder->expects($this->once())
            ->method('disableOriginalConstructor')
            ->will($this->returnSelf());

        $builder->expects($this->once())
            ->method('setMethods')
            ->with($this->equalTo($methods))
            ->will($this->returnSelf());

        $subject->expects($this->once())
            ->method('getMockBuilder')
            ->with($this->equalTo($className))
            ->will($this->returnValue($builder));

        $result = $subject->getBuiltMock($className, $methods);

        $this->assertEquals($expected, $result);


    } // END function test_getBuiltMock

    /**
     * provide_getBuiltMock()
     *
     * Provides data for the getBuiltMock method of the
     * Rx_PHPUnit_TestCase class
     */
    public function provide_getBuiltMock ( )
    {
        return array(
            array('expected value', 'Zend_Exception'),
        );

    } // END function provide_getBuiltMock


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

    /**
     * test_getProperty()
     *
     * Tests the getMethod of the Rx_PHPUnit_TestCase
     *
     * @covers          Rx_PHPUnit_TestCase::getProperty
     * @dataProvider    provide_getProperty
     */
    public function test_getProperty ($class, $property)
    {
        $subject = $this->getMockForAbstractClass('Rx_PHPUnit_TestCase');

        $result = $subject->getProperty($class, $property);

        $this->assertInstanceOf('ReflectionProperty', $result);

    } // END function test_getProperty

    /**
     * provide_getProperty()
     *
     * Provides data for the getMethod method of the
     * Rx_PHPUnit_TestCase class
     */
    public function provide_getProperty ( )
    {
        return array(
            array(
                'Exception', 'message',
            ),
        );

    } // END function provide_getProperty

} // END class Tests_Rx_Model_AbstractTest
