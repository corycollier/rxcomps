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
    extends PHPUnit_Framework_TestCase
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

        $subject = $this->getMockBuilder('Rx_Controller_Model')
            ->setMethods(array('getModel', 'getRequest'))
            ->disableOriginalConstructor()
            ->getMock();

        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('paginate'))
            ->disableOriginalConstructor()
            ->getMock();

        $request = $this->getMockBuilder('Zend_Controller_Request_Http')
            ->setMethods(array('getParams'))
            ->disableOriginalConstructor()
            ->getMock();

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