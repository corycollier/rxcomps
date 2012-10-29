<?php
/**
 * Unit Tests for View
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Plugin_View class
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
 * Unit Tests for View
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Plugin_View class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Plugin_View
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_preDispatch()
     *
     * Tests the preDispatch of the App_Plugin_View
     *
     * @covers          App_Plugin_View::preDispatch
     * @dataProvider    provide_preDispatch
     */
    public function test_preDispatch ( )
    {
        $subject = new App_Plugin_View;

        $request = new Zend_Controller_Request_HttpTestCase;

        $subject->preDispatch($request);

    } // END function test_preDispatch

    /**
     * provide_preDispatch()
     *
     * Provides data for the preDispatch method of the
     * App_Plugin_View class
     */
    public function provide_preDispatch ( )
    {
        return array(
            array(),
        );

    } // END function provide_preDispatch

} // END class Tests_App_Plugin_View