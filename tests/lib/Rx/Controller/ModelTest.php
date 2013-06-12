<?php
/**
 * Unit Test Suite for the Model class
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_Controller_Model class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the Model
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_Controller_Model class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_Rx_Controller_ModelTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_init()
     *
     * Tests the init method of the Rx_Controller_Model class
     *
     * @covers Rx_Controller_Model::init
     * @dataProvider provide_init
     */
    public function test_init ($controllerName, $exception = '')
    {
        if ($exception) {
            $this->setExpectedException($exception);
        }

        $subject = new $controllerName(
            new Zend_Controller_Request_HttpTestCase,
            new Zend_Controller_Response_HttpTestCase
        );

        $subject->init();

    } // END function test_init

    /**
     * provide_init()
     *
     * Provides data to use for testing the init method of
     * the Rx_Controller_Model class
     *
     * @return array
     */
    public function provide_init ( )
    {
        return array(
            array('Tests_Rx_Controller_ModelInstance'),
            array('Rx_Controller_Model', 'Rx_Controller_Exception'),
        );

    } // END function provide_init

    /**
     * test_listAction()
     *
     * Tests the listAction method of the Rx_Controller_Model class
     *
     * @covers Rx_Controller_Model::listAction
     * @dataProvider provide_listAction
     */
    public function test_listAction ($modelName, $items, $params = array())
    {
        $view = new Zend_View;
        $subject = $this->getBuiltMock('Rx_Controller_Model', array('getModel', 'getRequest'));
        $model = $this->getBuiltMock('Rx_Model_Abstract', array('paginate'));
        $request = $this->getBuiltMock('Zend_Controller_Request_Http', array('getParams'));

        $request->expects($this->once())
            ->method('getParams')
            ->will($this->returnValue($params));

        $model->expects($this->once())
            ->method('paginate')
            ->with($this->equalTo($params))
            ->will($this->returnValue($items));

        $subject->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $subject->expects($this->once())
            ->method('getModel')
            ->with($this->equalTo($modelName))
            ->will($this->returnValue($model));

        $subject->view = $view;
        $property = new ReflectionProperty('Rx_Controller_Model', '_modelName');
        $property->setAccessible(true);
        $property->setValue($subject, $modelName);

        $subject->listAction();

        $this->assertEquals($items, $view->items);

    } // END function test_listAction

    /**
     * provide_listAction()
     *
     * Provides data to use for testing the listAction method of
     * the Rx_Controller_Model class
     *
     * @return array
     */
    public function provide_listAction ( )
    {
        return array(
            array('testModel', array(
                (object)array(
                    'stuff' => 'values',
                )
            )),
        );

    } // END function provide_listAction

    /**
     * test_viewAction()
     *
     * Tests the viewAction method of the Rx_Controller_Model class
     *
     * @covers Rx_Controller_Model::viewAction
     * @dataProvider provide_viewAction
     */
    public function test_viewAction ($controller, $module = 'default', $id = null)
    {
        // create objects to mock
        $subject = $this->getBuiltMock('Rx_Controller_Model', array(
            'flashAndRedirect', 'getModel', 'getRequest'
        ));
        $model = $this->getBuiltMock('Rx_Model_Abstract', array('load'));
        $request = new Zend_Controller_Request_HttpTestCase;

        $request->setParams(array(
            'id'            => $id,
            'controller'    => $controller,
            'module'        => $module,
        ));

        // set expectations for method calls
        $model->expects($this->once())
            ->method('load')
            ->with($this->equalTo($id));

        if (! $id) {
            $subject->expects($this->any())
                ->method('flashAndRedirect')
                ->with(
                    $this->anything(),
                    $this->equalTo('error'),
                    $this->equalTo(array(
                        'module'        => $request->getModuleName(),
                        'controller'    => $request->getControllerName(),
                        'action'        => 'index',
                    )),
                    $this->equalTo('default'),
                    $this->equalTo(true)
                );
        }

        $subject->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $subject->expects($this->once())
            ->method('getModel')
            ->will($this->returnValue($model));

        $subject->viewAction();


    } // END function test_viewAction

    /**
     * provide_viewAction()
     *
     * Provides data to use for testing the viewAction method of
     * the Rx_Controller_Model class
     *
     * @return array
     */
    public function provide_viewAction ( )
    {
        return array(
            'no id provided' => array(
                'controllerName', 'moduleName',
            ),

            'id provided' => array(
                'controllerName', 'moduleName', 1
            ),
        );

    } // END function provide_viewAction

    /**
     * test_createAction()
     *
     * Tests the createAction method of the Rx_Controller_Model class
     *
     * @covers Rx_Controller_Model::createAction
     * @dataProvider provide_createAction
     */
    public function test_createAction ($params, $post = false, $exceptionMessage = '')
    {
        // create objects to mock
        $subject = $this->getBuiltMock('Rx_Controller_Model', array('getModel', 'getRequest', '_create', 'getHelper'));
        $model  = $this->getBuiltMock('Rx_Model_Abstract', array('getForm'));
        $form   = $this->getBuiltMock('Rx_Form_Abstract', array('injectDependencies', 'populate'));
        $helper = $this->getBuiltMock('Zend_Controller_Action_Helper_FlashMessenger', array('addMessage'));
        $request = new Zend_Controller_Request_HttpTestCase;
        $view = new Zend_View;

        // set method expectations
        $request->setParams($params);
        if ($post) {
            $request->setMethod('post');
        }

        $form->expects($this->once())
            ->method('populate')
            ->with($this->equalTo($params));

        $form->expects($this->once())
            ->method('injectDependencies')
            ->with($this->equalTo($model), $this->equalTo($params));

        $model->expects($this->once())
            ->method('getForm')
            ->will($this->returnValue($form));

        $subject->expects($this->once())
            ->method('getModel')
            ->will($this->returnValue($model));

        $subject->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        if ($post) {
            if ($exceptionMessage) {
                $helper->expects($this->once())
                    ->method('addMessage')
                    ->with($this->equalTo($exceptionMessage), $this->equalTo('error'));

                $subject->expects($this->once())
                    ->method('getHelper')
                    ->with($this->equalTo('FlashMessenger'))
                    ->will($this->returnValue($helper));
            }
            $subject->expects($this->once())
                ->method('_create')
                ->with($this->equalTo($model), $this->equalTo($request))
                ->will($exceptionMessage
                    ? $this->throwException(new Zend_Exception($exceptionMessage))
                    : $this->returnSelf()
                );
        }

        $subject->view = $view;

        $subject->createAction();

    } // END function test_createAction

    /**
     * provide_createAction()
     *
     * Provides data to use for testing the createAction method of
     * the Rx_Controller_Model class
     *
     * @return array
     */
    public function provide_createAction ( )
    {
        return array(
            'no post' => array(array(
                'module' => 'default',
            )),

            'with post' => array(
                array(
                    'module' => 'default',
                ),
                true
            ),

            'with post and exception' => array(
                array(
                    'module' => 'default',
                ),
                true,
                'bad stff',

            ),
        );

    } // END function provide_createAction

    /**
     * test__create()
     *
     * Tests the _create method of the Rx_Controller_Model class
     *
     * @covers Rx_Controller_Model::_create
     * @dataProvider provide__create
     */
    public function test__create ($params, $post = array(), $exception = false)
    {
        /**
         *
        $message = sprintf(self::MSG_CREATE_SUCCESS, $this->_modelName);
        $params = array_merge($request->getParams(), $request->getPost());
        $form = $model->getForm();

        if (!$form->isValid($params)) {
            throw new Rx_Controller_Exception(self::MSG_FORM_INVALID);
        }

        $model->create($form->getValues());

        $this->flashAndRedirect($message, 'success', array(
            'module'        => $request->getModuleName(),
            'controller'    => $request->getControllerName(),
            'action'        => 'view',
            'id'            => $model->id,
        ));
        */

        // create objects to mock
        $subject = $this->getBuiltMock('Rx_Controller_Model', array('flashAndRedirect'));
        $model = $this->getBuiltMock('Rx_Model_Abstract', array('create', 'getForm'));
        $form = $this->getBuiltMock('Rx_Form_Abstract', array('isValid', 'getValues'));
        $request = new Zend_Controller_Request_HttpTestCase;
        $merged = array_merge($params, $post);

        // set expectations
        $request->setParams($merged);

        $form->expects($this->once())
            ->method('isValid')
            ->with($this->equalTo($merged))
            ->will($exception
                ? $this->throwException(new Rx_Controller_Exception)
                : $this->returnValue(true)
            );

        $form->expects($this->any())
            ->method('getValues')
            ->will($this->returnValue($merged));

        $model->expects($this->once())
            ->method('getForm')
            ->will($this->returnValue($form));

        $model->expects($this->any())
            ->method('create')
            ->with($this->equalTo($merged));

        if (! $exception) {
            $subject->expects($this->once())->method('flashAndRedirect');
        } else {
            $this->setExpectedException('Rx_Controller_Exception');
        }

        $method = new ReflectionMethod('Rx_Controller_Model', '_create');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $model, $request);

    } // END function test__create

    /**
     * provide__create()
     *
     * Provides data to use for testing the _create method of
     * the Rx_Controller_Model class
     *
     * @return array
     */
    public function provide__create ( )
    {
        return array(
            'simple test' => array(array(
                'module' => 'default',
            )),

            'simple test with post' => array(
                array('module' => 'default'),
                array('postKey' => 'postVal'),
            ),

            'post with exception' => array(
                array('module' => 'default'),
                array('postKey' => 'postVal'),
                true,
            ),
        );

    } // END function provide__create

    /**
     * test__delete()
     *
     * Tests the _delete of the Rx_Controller_Model
     *
     * @covers          Rx_Controller_Model::_delete
     * @dataProvider    provide__delete
     */
    public function test__delete ($params = array())
    {
        /**
         *
        $message = sprintf(self::MSG_DELETE_SUCCESS, $this->_modelName);
        $model->delete();
        $this->flashAndRedirect($message, 'success', array(
            'module'        => $request->getModuleName(),
            'controller'    => $request->getControllerName(),
            'action'        => 'index',
        ), 'default', true);
         */

        $subject = $this->getMockBuilder('Rx_Controller_Model')
            ->setMethods(array('flashAndRedirect'))
            ->disableOriginalConstructor()
            ->getMock();

        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('delete'))
            ->disableOriginalConstructor()
            ->getMock();

        $request = new Zend_Controller_Request_HttpTestCase;
        $request->setParams($params);

        $message = sprintf(Rx_Controller_Model::MSG_DELETE_SUCCESS, '');

        $model->expects($this->once())->method('delete');

        $subject->expects($this->once())
            ->method('flashAndRedirect')
            ->with(
                $this->equalTo($message),
                $this->equalTo('success'),
                $this->equalTo(Array(
                    'module'    => $request->getModuleName(),
                    'controller'=> $request->getControllerName(),
                    'action'    => 'index',
                )),
                $this->equalTo('default'),
                $this->equalTo(true)
            );

        $method = new ReflectionMethod('Rx_Controller_Model', '_delete');
        $method->setAccessible(true);

        $method->invoke($subject, $model, $request);

    } // END function test__delete

    /**
     * provide__delete()
     *
     * Provides data for the _delete method of the
     * Rx_Controller_Model class
     */
    public function provide__delete ( )
    {
        return array(
            array(
                'params'    => array(
                    'module'    => 'default',
                    'controller'=> 'index',
                    'action'    => 'index',
                )
            ),
        );

    } // END function provide__delete

    /**
     * test_deleteAction()
     *
     * Tests the deleteAction of the Rx_Controller_Model
     *
     * @covers          Rx_Controller_Model::deleteAction
     * @dataProvider    provide_deleteAction
     */
    public function test_deleteAction ($method, $exceptionMessage = null, $params = array())
    {
        $subject = $this->getMockBuilder('Rx_Controller_Model')
            ->setMethods(array('getModel', 'getRequest', '_delete', 'getHelper'))
            ->disableOriginalConstructor()
            ->getMock();

        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('load'))
            ->disableOriginalConstructor()
            ->getMock();

        $helper = $this->getMockBuilder('Zend_Controller_Action_Helper_FlashMessenger')
            ->setMethods(array('addMessage'))
            ->disableOriginalConstructor()
            ->getMock();

        $request = new Zend_Controller_Request_HttpTestCase;
        $request->setMethod($method);
        $request->setParams($params);

        $model->expects($this->once())
            ->method('load')
            ->with($this->equalTo($request->getParam('id')));

        $subject->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $subject->expects($this->once())
            ->method('getModel')
            ->will($this->returnValue($model));

        if ($request->isPost()) {

            if ($exceptionMessage) {
                $helper->expects($this->once())
                    ->method('addMessage')
                    ->with($this->equalTo($exceptionMessage), $this->equalTo('error'));

                $subject->expects($this->once())
                    ->method('getHelper')
                    ->with($this->equalTo('FlashMessenger'))
                    ->will($this->returnValue($helper));
            }

            $subject->expects($this->once())
                ->method('_delete')
                ->with($this->equalTo($model), $this->equalTo($request))
                ->will($exceptionMessage
                    ? $this->throwException(new Zend_Exception($exceptionMessage))
                    : $this->returnSelf()
                );
        }

        $subject->deleteAction();

    } // END function test_deleteAction

    /**
     * provide_deleteAction()
     *
     * Provides data for the deleteAction method of the
     * Rx_Controller_Model class
     */
    public function provide_deleteAction ( )
    {
        return array(
            array(
                'method'            => 'get',
                'exceptionMessage'  => null,
                'params'            => array(
                    'id'    => 1,
                )
            ),

            array(
                'method'            => 'post',
                'exceptionMessage'  => null,
                'params'            => array(
                    'id'    => 1,
                )
            ),

            array(
                'method'            => 'post',
                'exceptionMessage'  => 'bad stuff',
                'params'            => array(
                    'id'    => 1,
                )
            ),
        );

    } // END function provide_deleteAction

    /**
     * test_postDispatch()
     *
     * Tests the postDispatch method of the Rx_Controller_Model class
     *
     * @covers Rx_Controller_Model::postDispatch
     * @dataProvider provide_postDispatch
     */
    public function test_postDispatch ( )
    {
        $subject = $this->getBuiltMock('Rx_Controller_Model', array('getHelper', 'getModel'));
        $model = $this->getBuiltMock('Rx_Model_Abstract', array('getTable'));
        $table = $this->getBuiltMock('Rx_Model_DbTable_Abstract', array('getPaginationAdapter'));

        $table->expects($this->once())
            ->method('getPaginationAdapter')
            ->will($this->returnValue(new Zend_Paginator_Adapter_Array(array())));

        $model->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($table));

        $subject->expects($this->once())
            ->method('getModel')
            ->will($this->returnValue($model));

        $subject->postDispatch();

    } // END function test_postDispatch

    /**
     * provide_postDispatch()
     *
     * Provides data to use for testing the postDispatch method of
     * the Rx_Controller_Model class
     *
     * @return array
     */
    public function provide_postDispatch ( )
    {
        return array(
            array(),
        );

    } // END function provide_postDispatch


} // END class Tests_Rx_Controller_ModelTest


/**
 * Test class for the Rx Controller Model
 *
 * This class is used solely for testing
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: Version
 * @since       Class available since release Since
 */

class Tests_Rx_Controller_ModelInstance
    extends Rx_Controller_Model
{
    /**
     * Specifing the model (which won't work)
     *
     * @var string
     */
    protected $_modelName = 'ModelInstance';

} // END class Package_SubPackage_ClassName