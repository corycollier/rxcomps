<?php
/**
 * Unit Test Suite for the App_View_Helper_Event class
 *
 * This unit test suite should test all of the custom functionality provided by
 * the App_View_Helper_Event view helper
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 * @filesource
 */

/**
 * Unit Test Suite for the App_View_Helper_Event
 *
 * This unit test suite should test all of the custom functionality provided by
 * the App_View_Helper_Event view helper
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class Tests_App_View_Helper_App_View_Helper_EventTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_event()
     *
     * Tests the event method of the App_View_Helper_Event class
     *
     * @covers App_View_Helper_Event::event
     * @dataProvider provide_event
     */
    public function test_event ($params = array(), $exception = '')
    {
        if ($exception) {
            $this->setExpectedException($exception);
        }

        $subject = new App_View_Helper_Event;
        $request = new Zend_Controller_Request_HttpTestCase;
        $view = $this->getBuiltMock('Zend_View', array('request'));

        $request->setParams($params);
        $view->expects($this->once())
            ->method('request')
            ->will($this->returnValue($request));

        $subject->view = $view;

        $result = $subject->event();

        $this->assertSame($subject, $result);

    } // END function test_event

    /**
     * provide_event()
     *
     * Provides data to use for testing the event method of
     * the App_View_Helper_Event class
     *
     * @return array
     */
    public function provide_event ( )
    {
        return array(
            'has request id, no exception' => array(
                'params' => array(
                    'id' => 1,
                ),
                'exception' => null,
            ),

            'no request id, throws exception' => array(
                'params' => array(
                    // 'id' => 1,
                ),
                'exception' => 'Rx_View_Helper_Exception',
            ),

        );

    } // END function provide_event

    /**
     * test_register()
     *
     * Tests the register method of the App_View_Helper_Event class
     *
     * @covers App_View_Helper_Event::register
     * @dataProvider provide_register
     */
    public function test_register ($isRegistered)
    {
        $subject = new App_View_Helper_Event;
        $model = new App_Model_Event;
        $user = $this->getBuiltMock('App_Model_User', array('isRegistered'));
        $view = $this->getBuiltMock('Zend_View', array('htmlAnchor'));
        $link = 'link value';

        $eventId = 1;
        $model->id = $eventId;

        $user->expects($this->once())
            ->method('isRegistered')
            ->with($this->equalTo($model))
            ->will($this->returnValue($isRegistered));

        $expected = '';
        if (! $isRegistered) {
            $view->expects($this->once())
                ->method('htmlAnchor')
                ->with($this->equalTo(' Register '),
                    $this->equalTo(array(
                        'controller'    => 'registrations',
                        'action'        => 'create',
                        'event_id'      => $eventId,
                    )))
                ->will($this->returnValue($link));
            $expected = '<div class="pretty medium success btn">' . $link . '</div>';
        }

        $property = new ReflectionProperty('App_View_Helper_Event', '_model');
        $property->setAccessible(true);
        $property->setValue($subject, $model);

        $subject->view = $view;

        $result = $subject->register($user);

        $this->assertEquals($expected, $result);

    } // END function test_register

    /**
     * provide_register()
     *
     * Provides data to use for testing the register method of
     * the App_View_Helper_Event class
     *
     * @return array
     */
    public function provide_register ( )
    {
        return array(
            'is registered' => array(true),
            'not registered' => array(false),
        );

    } // END function provide_register

} // END class Tests_App_View_Helper_App_View_Helper_EventTest