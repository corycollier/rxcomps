<?php
/**
 * Navigation Plugin Tests
 *
 * This unit test suite should test all of the custom functionality provided
 * by the App_Plugin_Navigation class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Navigation Plugin Tests
 *
 * This unit test suite should test all of the custom functionality provided
 * by the App_Plugin_Navigation class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Plugin
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Plugin_NavigationTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_preDispatch()
     *
     * Tests the preDispatch of the App_Plugin_Navigation
     *
     * @covers          App_Plugin_Navigation::preDispatch
     * @dataProvider    provide_preDispatch
     */
    public function test_preDispatch ($isAjax)
    {
        $subject = $this->getMockBuilder('App_Plugin_Navigation')
            ->setMethods(array('_addAuthenticationPages'))
            ->disableOriginalConstructor()
            ->getMock();

        $request = new Zend_Controller_Request_HttpTestCase;
        if ($isAjax) {
            $request->setHeader('X-Requested-With', 'XMLHttpRequest');
        } else {
            $subject->expects($this->once())->method('_addAuthenticationPages');
        }

        $subject->preDispatch($request);

        // $view = Zend_Layout::getMvcInstance()->getView();

        // $this->assertSame($container, $view->navigation()->getView());

    } // END function test_preDispatch

    /**
     * provide_preDispatch()
     *
     * Provides data for the preDispatch method of the
     * App_Plugin_Navigation class
     */
    public function provide_preDispatch ( )
    {
        return array(
            array(true),
            array(false),
        );

    } // END function provide_preDispatch

    /**
     * test__addAuthenticationPages()
     *
     * Tests the _addAuthenticationPages of the App_Plugin_Navigation
     *
     * @covers          App_Plugin_Navigation::_addAuthenticationPages
     * @dataProvider    provide__addAuthenticationPages
     */
    public function test__addAuthenticationPages ($hasIdentity)
    {
        $subject = $this->getMockBuilder('App_Plugin_Navigation')
            ->setMethods(array('_getAuth'))
            ->disableOriginalConstructor()
            ->getMock();

        $auth = $this->getMockBuilder('Zend_Auth')
            ->setMethods(array('hasIdentity'))
            ->disableOriginalConstructor()
            ->getMock();

        $container = $this->getMockBuilder('Zend_Navigation')
            ->setMethods(array('addPage'))
            ->disableOriginalConstructor()
            ->getMock();

        $auth->expects($this->once())
            ->method('hasIdentity')
            ->will($this->returnValue($hasIdentity));

        $subject->expects($this->once())
            ->method('_getAuth')
            ->will($this->returnValue($auth));

        if ($hasIdentity) {
            $page = array(
                'label'         => 'Logout',
                'controller'    => 'users',
                'action'        => 'logout',
            );
        } else {
            $page = array(
                'label'         => 'Login',
                'controller'    => 'users',
                'action'        => 'login',
            );
        }

        $container->expects($this->once())
            ->method('addPage')
            ->with($this->equalTo($page));

        $method = new ReflectionMethod('App_Plugin_Navigation', '_addAuthenticationPages');
        $method->setAccessible(true);
        $method->invoke($subject, $container);

    } // END function test__addAuthenticationPages

    /**
     * provide__addAuthenticationPages()
     *
     * Provides data for the _addAuthenticationPages method of the
     * App_Plugin_Navigation class
     */
    public function provide__addAuthenticationPages ( )
    {
        return array(
            array(true),
            array(false),
        );

    } // END function provide__addAuthenticationPages

    /**
     * test__getAuth()
     *
     * Tests the _getAuth of the App_Plugin_Navigation
     *
     * @covers          App_Plugin_Navigation::_getAuth
     */
    public function test__getAuth ( )
    {
        $subject = new App_Plugin_Navigation;

        $method = new ReflectionMethod('App_Plugin_Navigation', '_getAuth');
        $method->setAccessible(true);
        $method->invoke($subject);

    } // END function test__getAuth

    /**
     * test__addExtraPages()
     *
     * Tests the _addExtraPages method of the App_Plugin_Navigation class
     *
     * @covers App_Plugin_Navigation::_addExtraPages
     * @dataProvider provide__addExtraPages
     */
    public function test__addExtraPages ($hasIdentity)
    {
        $subject = $this->getMockBuilder('App_Plugin_Navigation')
            ->setMethods(array('_getAuth'))
            ->disableOriginalConstructor()
            ->getMock();

        $auth = $this->getMockBuilder('Zend_Auth')
            ->setMethods(array('hasIdentity'))
            ->disableOriginalConstructor()
            ->getMock();

        $auth->expects($this->once())
            ->method('hasIdentity')
            ->will($this->returnValue($hasIdentity));

        $subject->expects($this->once())
            ->method('_getAuth')
            ->will($this->returnValue($auth));

        $container = new Zend_Navigation(array());

        $method = new ReflectionMethod('App_Plugin_Navigation', '_addExtraPages');
        $method->setAccessible(true);
        $method->invoke($subject, $container);



    } // END function test__addExtraPages

    /**
     * provide__addExtraPages()
     *
     * Provides data to use for testing the _addExtraPages method of
     * the App_Plugin_Navigation class
     *
     * @return array
     */
    public function provide__addExtraPages ( )
    {
        return array(
            array(true),
            array(false),
        );

    } // END function provide__addExtraPages

} // END class Tests_App_Plugin_NavigationTest
