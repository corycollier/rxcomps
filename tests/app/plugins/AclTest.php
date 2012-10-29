<?php
/**
 * Unit Tests for Acl
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Plugin_Acl class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Unit Tests for Acl
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Plugin_Acl class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Plugin_Acl
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_routeStartup()
     *
     * Tests the routeStartup of the App_Plugin_Acl
     *
     * @covers          App_Plugin_Acl::routeStartup
     * @dataProvider    provide_routeStartup
     */
    public function test_routeStartup ( )
    {
        $subject = new App_Plugin_Acl;

        $request = new Zend_Controller_Request_HttpTestCase;

        $subject->routeStartup($request);

    } // END function test_routeStartup

    /**
     * provide_routeStartup()
     *
     * Provides data for the routeStartup method of the
     * App_Plugin_Acl class
     */
    public function provide_routeStartup ( )
    {
        return array(
            array(),
        );

    } // END function provide_routeStartup

} // END class Tests_App_Plugin_Acl