<?php
/**
 * User Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the User class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model_DbTable
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * User Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the User class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model_DbTable
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Model_DbTable_User
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_unitTestCheck()
     *
     * Tests the unitTestCheck of the App_Model_DbTable_User
     *
     * @covers          App_Model_DbTable_User::unitTestCheck
     * @dataProvider    provide_unitTestCheck
     */
    public function test_unitTestCheck ($expected)
    {
        $subject = new App_Model_DbTable_User;

        $result = $subject->unitTestCheck();

        $this->assertEquals($expected, $result);

    } // END function test_unitTestCheck

    /**
     * provide_unitTestCheck()
     *
     * Provides data for the unitTestCheck method of the
     * App_Model_DbTable_User class
     */
    public function provide_unitTestCheck ( )
    {
        return array(
            array('unit test check'),
        );

    } // END function provide_unitTestCheck

} // END class Tests_App_Model_DbTable_User