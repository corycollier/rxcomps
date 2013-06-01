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
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_check()
     *
     * Tests the check of the Rx_Controller_Action_Helper_Acl
     *
     * @covers          Rx_Controller_Action_Helper_Acl::check
     * @dataProvider    provide_check
     */
    public function test_check ($isAllowed, $controllerName, $id = null)
    {
        // create test subjects
        $subject         = $this->getBuiltMock('Rx_Controller_Action_Helper_Acl', array(
            'getActionController', 'getModel',
        ));

        $request        = new Zend_Controller_Request_HttpTestCase;
        $user           = $this->getBuiltMock('App_Model_User', array('isAllowed'));
        $model          = $this->getBuiltMock('Rx_Model_Abstract', array('load'));
        $controller     = $this->getBuiltMock('Rx_Controller_Action', array('getHelper'));
        $redirectHelper = $this->getBuiltMock('Zend_Controller_Action_Helper_Redirector', array(
            'gotoRoute',
        ));
        $flashHelper    = $this->getBuiltMock('Zend_Controller_Action_Helper_FlashMessenger', array(
            'addMessage',
        ));

        $request->setControllerName($controllerName);
        $request->setParam('id', $id);

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
            ->with($this->equalTo($request), $this->equalTo($model))
            ->will($this->returnValue($isAllowed));

        $subject->expects($this->any())
            ->method('getModel')
            ->will($this->returnValueMap(array(
                array('User', $user),
                array(ucwords(trim($request->getControllerName(), 's')), $model),
            )));

        $subject->expects($this->once())
            ->method('getActionController')
            ->will($this->returnValue($controller));

        $result = $subject->check($request);

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
            'the check passes'    => array(true, 'checks'),
            'the check fails'     => array(false, 'checks'),
            'the check passes, model id'     => array(false, 'checks', 1),
        );

    } // END function provide_check

    /**
     * test_getModel()
     *
     * Tests the getModel of the Rx_Controller_Action_Helper_Acl
     *
     * @covers          Rx_Controller_Action_Helper_Acl::getModel
     * @dataProvider    provide_getModel
     */
    public function test_getModel ($expected, $modelName)
    {
        $subject = new Rx_Controller_Action_Helper_Acl;

        $result = $subject->getModel($modelName);

        if ($expected) {
            $this->assertInstanceOf($expected, $result);
        } else {
            $this->assertNull($result);
        }


    } // END function test_getModel

    /**
     * provide_getModel()
     *
     * Provides data for the getModel method of the
     * Rx_Controller_Action_Helper_Acl class
     */
    public function provide_getModel ( )
    {
        return array(
            array('App_Model_User', 'User'),
        );

    } // END function provide_getModel

    /**
     * test_getAutoloader()
     *
     * Tests the getAutoloader of the Rx_Controller_Action_Helper_Acl
     *
     * @covers          Rx_Controller_Action_Helper_Acl::getAutoloader
     */
    public function test_getAutoloader ( )
    {
        $subject = new Rx_Controller_Action_Helper_Acl;

        $result = $subject->getAutoloader();

        $this->assertInstanceOf('Zend_Loader_Autoloader', $result);

    } // END function test_getAutoloader


} // END class Tests_Rx_Controller_Action_Helper_Acl