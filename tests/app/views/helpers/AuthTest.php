<?php
/**
 * Unit Tests for Auth
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_Auth class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Unit Tests for Auth
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_Auth class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_View_Helper_Auth
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_auth()
     *
     * Tests the auth of the App_View_Helper_Auth
     *
     * @covers          App_View_Helper_Auth::auth
     */
    public function test_auth ( )
    {
        $subject = new App_View_Helper_Auth;

        $result = $subject->auth();

        $this->assertInstanceOf('Zend_Auth', $result);

    } // END function test_auth

} // END class Tests_App_View_Helper_Auth