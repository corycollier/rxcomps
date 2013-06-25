<?php
/**
 * Unit Test Suite for the App_Model_Assertion_IsOwnScore class
 *
 * This unit test suite should test all custom functionality provided by the
 * App_Model_Assertion_IsOwnScore class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model_Assertion
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the App_Model_Assertion_IsOwnScore
 *
 * This unit test suite should test all custom functionality provided by the
 * App_Model_Assertion_IsOwnScore class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model_Assertion
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_App_Model_Assertion_IsOwnScoreTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_assert()
     *
     * Tests the assert method of the App_Model_Assertion_IsOwnScore class
     *
     * @covers App_Model_Assertion_IsOwnScore::assert
     * @dataProvider provide_assert
     */
    public function test_assert ($expected, $acl, $role, $resource, $privilege)
    {
        $subject = $this->getMockBuilder('App_Model_Assertion_IsOwnScore')
            ->setMethods(array())
            ->disableOriginalConstructor()
            ->getMock();

        $result = $subject->assert($acl, $role, $resource, $privilege);

        $this->assertEquals($expected, $result);

    } // END function test_assert

    /**
     * provide_assert()
     *
     * Provides data to use for testing the assert method of
     * the App_Model_Assertion_IsOwnScore class
     *
     * @return array
     */
    public function provide_assert ( )
    {
        $acl = new Zend_Acl;

        return array(
            // basic test
            array(
                'expected'  => null,
                'acl'       => $acl,
                'role'      => new Zend_Acl_Role('role-value'),
                'resouce'   => new Zend_Acl_Resource('resource-value'),
                'privilege' => 'privilege-value',
            ),
        );

    } // END function provide_assert

} // END class Tests_App_Model_Assertion_IsOwnScoreTest