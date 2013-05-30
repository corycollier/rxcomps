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
    public function test_event ($model)
    {
        $subject = $this->getBuiltMock('App_View_Helper_Event', array('model'));

        $subject->expects($this->once())
            ->method('model')
            ->with($this->equalTo($model), $this->equalTo('App_Model_Event'))
            ->will($this->returnSelf());

        $result = $subject->event($model);

        $this->assertEquals($subject, $result);

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
            'no params, no actions' => array(
                (object)array('id' => 1, 'name' => 'value'),
            ),
        );

    } // END function provide_event

    /**
     * test__getTitle()
     *
     * Tests the _getTitle of the App_View_Helper_Event
     *
     * @covers          App_View_Helper_Event::_getTitle
     * @dataProvider    provide__getTitle
     */
    public function test__getTitle ($expected, $link, $event)
    {

        $subject = new App_View_Helper_Event;

        $view = $this->getMockBuilder('Zend_View')
            ->setMethods(array('htmlAnchor'))
            ->disableOriginalConstructor()
            ->getMock();

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->with($this->equalTo($event->name), $this->equalTo(array(
                'controller'=> 'events',
                'action'    => 'view',
                'id'        => $event->id,
                'event_id'  => $event->id,
            )))
            ->will($this->returnValue($link));

        $subject->view = $view;

        $method = new ReflectionMethod('App_View_Helper_Event', '_getTitle');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $event);

        $this->assertEquals($expected, $result);
    } // END function test__getTitle

    /**
     * provide__getTitle()
     *
     * Provides data for the _getTitle method of the
     * App_View_Helper_Event class
     */
    public function provide__getTitle ( )
    {
        return array(
            array(
                'expected'  => '<h3>link value</h3>',
                'link'      => 'link value',
                'scale'     => (object)array(
                    'id'    => 1,
                    'name'  => 'name value',
                )
            ),
        );

    } // END function provide__getTitle

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