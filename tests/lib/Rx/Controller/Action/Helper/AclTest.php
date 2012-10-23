<?php
/**
 * Acl
 *
 * This unit test suite should test all of the custom functionality provided by
 * the Rx_Controller_Action_Helper_Acl class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Controller_Action_Helper
 * @copyright   Copyright (c) 2012 Rx Gym, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Acl
 *
 * This unit test suite should test all of the custom functionality provided by
 * the Rx_Controller_Action_Helper_Acl class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Controller_Action_Helper
 * @copyright   Copyright (c) 2012 Rx Gym, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_Rx_Controller_Action_Helper_AclTest
    extends PHPUnit_Framework_TestCase
{

    /**
     * test_check()
     *
     * Tests the check of the Rx_Controller_Action_Helper_Acl
     *
     * @covers          Rx_Controller_Action_Helper_Acl::check
     * @dataProvider    provide_check
     */
    public function test_check ($isAllowed)
    {
        // create test subjects
        $request = new Zend_Controller_Request_HttpTestCase;

        $helper = $this->getMockBuilder('Rx_Controller_Action_Helper_Acl')
            ->setMethods(array('getActionController'))
            ->disableOriginalConstructor()
            ->getMock();

        $controller = $this->getMockBuilder('Rx_Controller_Action')
            ->setMethods(array('getModel', 'getHelper'))
            ->disableOriginalConstructor()
            ->getMock();

        $user = $this->getMockBuilder('App_Model_User')
            ->setMethods(array('isAllowed'))
            ->disableOriginalConstructor()
            ->getMock();

        $flashHelper = $this->getMockBuilder('Zend_Controller_Action_Helper_FlashMessenger')
            ->setMethods(array('addMessage'))
            ->disableOriginalConstructor()
            ->getMock();

        $redirectHelper = $this->getMockBuilder('Zend_Controller_Action_Helper_Redirector')
            ->setMethods(array('gotoRoute'))
            ->disableOriginalConstructor()
            ->getMock();

        // set expectations
        if (! $isAllowed) {
            $flashHelper->expects($this->once())
                ->method('addMessage')
                ->with($this->equalTo(Rx_Controller_Action_Helper_Acl::MSG_ACCESS_DENIED));

            $redirectHelper->expects($this->once())
                ->method('gotoRoute')
                ->with($this->equalTo(array(
                    'module'    => 'default',
                    'controller'=> 'error',
                    'action'    => 'denied',
                )));

        }

        $controller->expects($this->any())
            ->method('getHelper')
            ->will($this->returnValueMap(array(
                array('FlashMessenger', $flashHelper),
                array('Redirector', $redirectHelper),
            )));

        $user->expects($this->once())
            ->method('isAllowed')
            ->with($this->equalTo($request))
            ->will($this->returnValue($isAllowed));

        $controller->expects($this->once())
            ->method('getModel')
            ->with($this->equalTo('User'))
            ->will($this->returnValue($user));

        $helper->expects($this->once())
            ->method('getActionController')
            ->will($this->returnValue($controller));

        $result = $helper->check($request);

    } // END function test_check

    /**
     * provide_check()
     *
     * Provides data for the check method of the
     * Rx_Controller_Action_Helper_Acl class
     */
    public function provide_check ( )
    {
        return array(
            'the check passes'     => array(true),
            'the check fails'     => array(false),
        );

    } // END function provide_check

} // END class Tests_Rx_Controller_Action_Helper_Acl