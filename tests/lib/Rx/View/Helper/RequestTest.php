<?php
/**
 * Rx_View_Helper_Request Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Rx_Filter_SecondstoTime class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Rx_View_Helper_Request Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Rx_Filter_SecondstoTime class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_View_HelperTest
    extends Rx_PHPUnit_TestCase
{

    /**
     * test_request()
     *
     * Tests the request of the Rx_View_Helper_Request
     *
     * @covers          Rx_View_Helper_Request::request
     */
    public function test_request ( )
    {
        $subject = new Rx_View_Helper_Request;

        $result = $subject->request();

        $this->assertInstanceOf('Zend_Controller_Request_Abstract', $result);

    } // END function test_request

}