<?php
/**
 * Standard Test Class
 *
 * This test class should simplify the standard unit tests
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  PHPUnit
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Standard Test Class
 *
 * This test class should simplify the standard unit tests
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  PHPUnit
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

abstract class Rx_PHPUnit_TestCase
    extends PHPUnit_Framework_TestCase
{
    /**
     * getBuiltMock
     *
     * This method provides a short-hand for getting a built out mock
     * @param  string $className The class to mock
     * @param  array $methods   the methods to mock
     * @return mixed            A mocked object
     */
    public function getBuiltMock ($className, $methods = array())
    {
        $mock = $this->getMockBuilder($className)
            ->setMethods($methods)
            ->disableOriginalConstructor()
            ->getMock();

        // @todo anything else here?

        return $mock;

    } // END function getBuiltMock

    /**
     * getMethod()
     *
     * Returns a reflection method instance
     * @param  string $className the class to reflect upon
     * @param  string $method    the method to reflect
     * @return ReflectionMethod  The reflected method
     */
    public function getMethod ($className, $method)
    {
        $method = new ReflectionMethod($className, $method);
        $method->setAccessible(true);
        return $method;

    } // END function getMethod

    /**
     * getProperty()
     *
     * Returns a reflection property instance
     * @param  string $className The class to reflect upon
     * @param  string $property  The property to reflect
     * @return ReflectionProperty The reflected property
     */
    public function getProperty ($className, $property)
    {
        $property = new ReflectionProperty($className, $property);
        $property->setAccessible(true);
        return $property;

    } // END function getProperty

    // public function setExpectsOnce ()

} // END class Rx_PHPUnit_TestCase