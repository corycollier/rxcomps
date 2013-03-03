<?php
/**
 * UserTest
 *
 * This unit test suite should test all of the custom functionality provided
 * by the App_Model_User class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * UserTest
 *
 * This unit test suite should test all of the custom functionality provided
 * by the App_Model_User class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Model_UserTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_login()
     *
     * Tests the login of the App_Model_User
     *
     * @covers          App_Model_User::login
     * @dataProvider    provide_login
     */
    public function test_login ($code, $isValid, $params = array(), $exception = '')
    {
        if ($exception) {
            $this->setExpectedException($exception);
        }

        $email = @$params['email'];
        $passwd = @$params['passwd'];

        $resultRowObject = (object)array('result' => 'ok');

        $form = $this->getMockBuilder('App_Form_User')
            ->setMethods(array('isValid', 'getValue'))
            ->disableOriginalConstructor()
            ->getMock();

        $auth = $this->getMockBuilder('Zend_Auth')
            ->setMethods(array('clearIdentity', 'getStorage'))
            ->disableOriginalConstructor()
            ->getMock();

        $authResult = $this->getMockBuilder('Zend_Auth_Result')
            ->setMethods(array('getCode'))
            ->disableOriginalConstructor()
            ->getMock();

        $authAdapter = $this->getMockBuilder('Zend_Auth_Adapter_DbTable')
            ->setMethods(array(
                'setIdentity', 'setCredential', 'authenticate', 'getResultRowObject'
            ))
            ->disableOriginalConstructor()
            ->getMock();

        $storage = $this->getMockBuilder('Zend_Auth_Storage_Session')
            ->setMethods(array('write'))
            ->disableOriginalConstructor()
            ->getMock();

        $user = $this->getMockBuilder('App_Model_User')
            ->setMethods(array('getAuth', 'getForm', 'getAuthAdapter'))
            ->disableOriginalConstructor()
            ->getMock();

        // if the form is valid, there are some expectations to meet
        if ($isValid) {
            $form->expects($this->any())
                ->method('getValue')
                ->will($this->returnValueMap(array(
                    array('email', $email),
                    array('passwd', $passwd),
                )));

            $authResult->expects($this->once())
                ->method('getCode')
                ->will($this->returnValue($code));

            $authAdapter->expects($this->once())
                ->method('setIdentity')
                ->with($this->equalTo($email))
                ->will($this->returnSelf());

            $authAdapter->expects($this->once())
                ->method('setCredential')
                ->with($this->equalTo($passwd))
                ->will($this->returnSelf());

            $authAdapter->expects($this->once())
                ->method('authenticate')
                ->will($this->returnValue($authResult));

            // if the login passes, expect that the results are stored
            if ($code == Zend_Auth_Result::SUCCESS) {
                $authAdapter->expects($this->once())
                    ->method('getResultRowObject')
                    ->will($this->returnValue($resultRowObject));

                $auth->expects($this->once())
                    ->method('getStorage')
                    ->will($this->returnValue($storage));

                $storage->expects($this->once())
                    ->method('write')
                    ->with($this->equalTo($resultRowObject));
            }
        }

        // set expectations
        $form->expects($this->once())
            ->method('isValid')
            ->with($this->equalTo($params))
            ->will($this->returnValue($isValid));

        $user->expects($this->once())
            ->method('getForm')
            ->will($this->returnVAlue($form));

        $user->expects($this->once())
            ->method('getAuthAdapter')
            ->will($this->returnValue($authAdapter));

        $user->expects($this->once())
            ->method('getAuth')
            ->will($this->returnValue($auth));

        $user->login($params);

    } // END function test_login

    /**
     * provide_login()
     *
     * Provides data for the login method of the
     * App_Model_User class
     */
    public function provide_login ( )
    {
        return array(
            'successful login' => array(
                Zend_Auth_Result::SUCCESS,
                true,
                array(
                    'email'     => 'user@user.com',
                    'passwd'    => 'password',
                )
            ),

            'failed login' => array(
                Zend_Auth_Result::FAILURE,
                true,
                array(
                    'email'     => 'user@user.com',
                    'passwd'    => 'password',
                ),
                'Zend_Exception',
            ),

            'invalid form data' => array(
                Zend_Auth_Result::FAILURE,
                false,
                array(
                    'email'     => 'user@user.com',
                    'passwd'    => 'password',
                ),
                'Zend_Exception',
            ),

        );

    } // END function provide_login

    /**
     * test_logout()
     *
     * Tests the logout of the App_Model_User
     *
     * @covers          App_Model_User::logout
     * @dataProvider    provide_logout
     */
    public function test_logout ( )
    {
        $auth = $this->getMockBuilder('Zend_Auth')
            ->setMethods(array('clearIdentity'))
            ->disableOriginalConstructor()
            ->getMock();

        $user = $this->getMockBuilder('App_Model_User')
            ->setMethods(array('getAuth'))
            ->disableOriginalConstructor()
            ->getMock();

        $auth->expects($this->once())->method('clearIdentity');

        $user->expects($this->once())
            ->method('getAuth')
            ->will($this->returnValue($auth));

        $user->logout();

    } // END function test_logout

    /**
     * provide_logout()
     *
     * Provides data for the logout method of the
     * App_Model_User class
     */
    public function provide_logout ( )
    {
        return array(
            array(),
        );

    } // END function provide_logout

    /**
     * test_getAuth()
     *
     * Tests the getAuth of the App_Model_User
     *
     * @covers          App_Model_User::getAuth
     * @dataProvider    provide_getAuth
     */
    public function test_getAuth ( )
    {
        $user = new App_Model_User;

        $result = $user->getAuth();

        $this->assertInstanceOf('Zend_Auth', $result);

    } // END function test_getAuth

    /**
     * provide_getAuth()
     *
     * Provides data for the getAuth method of the
     * App_Model_User class
     */
    public function provide_getAuth ( )
    {
        return array(
            array(),
        );

    } // END function provide_getAuth

    /**
     * test_getAuthAdapter()
     *
     * Tests the getAuthAdapter of the App_Model_User
     *
     * @covers          App_Model_User::getAuthAdapter
     * @dataProvider    provide_getAuthAdapter
     */
    public function test_getAuthAdapter ( )
    {
        $user = new App_Model_User;

        $result = $user->getAuthAdapter();

        $this->assertInstanceOf('Zend_Auth_Adapter_DbTable', $result);

    } // END function test_getAuthAdapter

    /**
     * provide_getAuthAdapter()
     *
     * Provides data for the getAuthAdapter method of the
     * App_Model_User class
     */
    public function provide_getAuthAdapter ( )
    {
        return array(
            array(),
        );

    } // END function provide_getAuthAdapter

    /**
     * test_getAcl()
     *
     * Tests the getAcl of the App_Model_User
     *
     * @covers App_Model_User::getAcl
     */
    public function test_getAcl ( )
    {
        //Zend_Acl
        $user = new App_Model_User;

        $result = $user->getAcl();

        $this->assertInstanceOf('Zend_Acl', $result);

    } // END function test_getAcl

    /**
     * test_isAllowed()
     *
     * Tests the isAllowed of the App_Model_User
     *
     * @covers          App_Model_User::isAllowed
     * @dataProvider    provide_isAllowed
     */
    public function test_isAllowed ($expected, $role, $controller, $action)
    {
        $request = new Zend_Controller_Request_HttpTestCase;
        $request->setParams(array(
            'controller'    => $controller,
            'action'        => $action,
        ));

        $auth = $this->getMockBuilder('Zend_Auth')
            ->setMethods(array('getStorage'))
            ->disableOriginalConstructor()
            ->getMock();

        $authStorage = $this->getMockBuilder('Zend_Auth_Storage_Session')
            ->setMethods(array('read'))
            ->disableOriginalConstructor()
            ->getMock();

        $acl = $this->getMockBuilder('Zend_Acl')
            ->setMethods(array('isAllowed'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject = $this->getMockBuilder('App_Model_User')
            ->setMethods(array('getAuth', 'getAcl', 'getTable', 'load'))
            ->disableOriginalConstructor()
            ->getMock();

        $authStorage->expects($this->once())
            ->method('read')
            ->will($this->returnValue((object)array(
                'id'    => 1,
                'role'  => $role,
            )));

        $auth->expects($this->once())
            ->method('getStorage')
            ->will($this->returnValue($authStorage));

        $acl->expects($this->once())
            ->method('isAllowed')
            ->with($this->equalTo($subject), $this->equalTo($controller), $this->equalTo($action))
            ->will($this->returnValue($expected));

        $subject->expects($this->once())
            ->method('load')
            ->with($this->equalTo(1));

        $subject->expects($this->once())
            ->method('getAuth')
            ->will($this->returnValue($auth));

        $subject->expects($this->once())
            ->method('getAcl')
            ->will($this->returnValue($acl));

        $result = $subject->isAllowed($request);

        $this->assertEquals($expected, $result);

    } // END function test_isAllowed

    /**
     * provide_isAllowed()
     *
     * Provides data for the isAllowed method of the
     * App_Model_User class
     */
    public function provide_isAllowed ( )
    {
        return array(
            'role is allowed' => array(
                true, 'guest', 'index', 'index',
            ),

            'role is not allowed' => array(
                false, 'guest', 'admin', 'index',
            ),

        );

    } // END function provide_isAllowed

    /**
     * test_getRoleId()
     *
     * Tests the getRoleId of the App_Model_User
     *
     * @covers          App_Model_User::getRoleId
     * @dataProvider    provide_getRoleId
     */
    public function test_getRoleId ($expected, $data)
    {
        $storage = $this->getMockBuilder('Zend_Auth_Storage_Session')
            ->setMethods(array('read'))
            ->disableOriginalConstructor()
            ->getMock();

        $auth = $this->getMockBuilder('Zend_Auth')
            ->setMethods(array('getStorage'))
            ->disableOriginalConstructor()
            ->getMock();

        $user = $this->getMockBuilder('App_Model_User')
            ->setMethods(array('getAuth'))
            ->disableOriginalConstructor()
            ->getMock();

        $storage->expects($this->once())
            ->method('read')
            ->will($this->returnValue($data));

        $auth->expects($this->once())
            ->method('getStorage')
            ->will($this->returnValue($storage));

        $user->expects($this->once())
            ->method('getAuth')
            ->will($this->returnValue($auth));

        $result = $user->getRoleId();

        $this->assertEquals($expected, $result);

    } // END function test_getRole

    /**
     * provide_getRoleId()
     *
     * Provides data for the getRoleId method of the
     * App_Model_User class
     */
    public function provide_getRoleId ( )
    {
        return array(
            'no email set, expect guest role' => array(
                'guest',
                (object)array(
                    'data' => 'values',
                ),
            ),

            'email set, expect guest role' => array(
                'guest',
                (object)array(
                    'data'  => 'values',
                    'email' => 'values',
                ),
            ),

            'role set, expect role' => array(
                'user',
                (object)array(
                    'data'  => 'values',
                    'email' => 'values',
                    'role'  => 'user',
                ),
            ),
        );

    } // END function provide_getRoleId

    /**
     * test_edit()
     *
     * Tests the edit of the App_Model_User
     *
     * @covers          App_Model_User::edit
     * @dataProvider    provide_edit
     */
    public function test_edit ($values)
    {
        $subject = $this->getMockBuilder('App_Model_User')
            ->setMethods(array('_edit'))
            ->disableOriginalConstructor()
            ->getMock();

        $modified = $values;
        $modified['passwd'] = hash('sha1', @$values['passwd']);

        $subject->expects($this->once())
            ->method('_edit')
            ->with($this->equalTo($modified))
            ->will($this->returnSelf());

        $result = $subject->edit($values);

        $this->assertSame($subject, $result);

    } // END function test_edit

    /**
     * provide_edit()
     *
     * Provides data for the edit method of the
     * App_Model_User class
     */
    public function provide_edit ( )
    {
        return array(
            array(array(
                'id'    => 1,
                'email' => 'some@thing.com',
            )),
        );

    } // END function provide_edit

    /**
     * test_create()
     *
     * Tests the create of the App_Model_User
     *
     * @covers          App_Model_User::create
     * @dataProvider    provide_create
     */
    public function test_create ($values)
    {
        $subject = $this->getMockBuilder('App_Model_User')
            ->setMethods(array('_create'))
            ->disableOriginalConstructor()
            ->getMock();

        $modified = $values;
        $modified['passwd'] = hash('sha1', @$values['passwd']);

        $subject->expects($this->once())
            ->method('_create')
            ->with($this->equalTo($modified))
            ->will($this->returnSelf());

        $result = $subject->create($values);

        $this->assertSame($subject, $result);

    } // END function test_create

    /**
     * provide_create()
     *
     * Provides data for the create method of the
     * App_Model_User class
     */
    public function provide_create ( )
    {
        return array(
            array(array(
                'id'    => 1,
                'email' => 'some@thing.com',
            )),
        );

    } // END function provide_create

} // END class Tests_App_Model_UserTest
