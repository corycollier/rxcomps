<?php
/**
 * Unit Test Suite for the App_View_Helper_Registry class
 *
 * This unit test suite should test all custom functionality provided by the
 * App_View_Helper_Registry class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the App_View_Helper_Registry
 *
 * This unit test suite should test all custom functionality provided by the
 * App_View_Helper_Registry class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_App_View_Helper_RegistryTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_registry()
     *
     * Tests the registry method of the App_View_Helper_Registry class
     *
     * @covers App_View_Helper_Registry::registry
     */
    public function test_registry ( )
    {
        $subject = new App_View_Helper_Registry;
        $result = $subject->registry();

        $this->assertInstanceOf('Zend_Registry', $result);

    } // END function test_registry


} // END class Tests_App_View_Helper_RegistryTest