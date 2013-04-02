<?php
/**
 * Unit Tests for App_View_Helper_EventItem
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_EventItem class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Unit Tests for App_View_Helper_EventItem
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_EventItem class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_View_Helper_EventItem
    extends Rx_PHPUnit_TestCase
{

    /**
     * test_eventItem()
     *
     * Tests the eventItem of the App_View_Helper_EventItem
     *
     * @covers          App_View_Helper_EventItem::eventItem
     * @dataProvider    provide_eventItem
     */
    public function test_eventItem ($expected, $event, $user, $params = array(), $actions = null)
    {
        $subject = $this->getBuiltMock('App_View_Helper_EventItem', array('_getTitle', '_getActions'));
        $view   = $this->getBuiltMock('Zend_View', array('model'));
        $model  = $this->getBuiltMock('Rx_View_Helper_Model', array('links'));

        $title = 'title';

        $model->expects($this->once())
            ->method('links')
            ->with($this->equalTo($user), $this->equalTo($params))
            ->will($this->returnValue($actions));

        $view->expects($this->once())
            ->method('model')
            ->will($this->returnValue($model));

        $subject->expects($this->once())
            ->method('_getTitle')
            ->with($this->equalTo($event))
            ->will($this->returnValue($title));

        $subject->view = $view;

        $result = $subject->eventItem($event, $user, $params);

        $this->assertEquals($expected, $result);

    } // END function test_eventItem

    /**
     * provide_eventItem()
     *
     * Provides data for the eventItem method of the
     * App_View_Helper_EventItem class
     */
    public function provide_eventItem ( )
    {
        // $expected, $hasIdentity, $event, $title, $actions = null)
        return array(
            'no params, no actions' => array(
                'expected'  => '<div class="list-item event-item">title</div>',
                'event'     => (object)array('id' => 1, 'name' => 'value'),
                'user'      => (object)array('id' => 1, 'name' => 'value'),
            ),

            'has params, no actions' => array(
                'expected'  => '<div class="list-item event-item">title</div>',
                'event'     => (object)array('id' => 1, 'name' => 'value'),
                'user'      => (object)array('id' => 1, 'name' => 'value'),
                'params'    => array(
                    'key' => 'value',
                ),
            ),
        );

    } // END function provide_eventItem


    /**
     * test__getTitle()
     *
     * Tests the _getTitle of the App_View_Helper_EventItem
     *
     * @covers          App_View_Helper_EventItem::_getTitle
     * @dataProvider    provide__getTitle
     */
    public function test__getTitle ($expected, $htmlAnchor, $event)
    {
        $subject = $this->getBuiltMock('App_View_Helper_EventItem');
        $view = $this->getBuiltMock('Zend_View', array('htmlAnchor'));

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->with(
                $this->equalTo(@$event->name),
                $this->equalTo(array(
                    'controller' => 'events',
                    'action'    => 'view',
                    'id'        => @$event->id,
                    'event_id'  => @$event->id,
                ))
            )
            ->will($this->returnValue($htmlAnchor));


        $subject->view = $view;

        $result = $this->getMethod('App_View_Helper_EventItem', '_getTitle')
            ->invoke($subject, $event);

        $this->assertEquals($expected, $result);

    } // END function test__getTitle

    /**
     * provide__getTitle()
     *
     * Provides data for the _getTitle method of the
     * App_View_Helper_EventItem class
     */
    public function provide__getTitle ( )
    {
        return array(
            array('<h3>html-anchor</h3>', 'html-anchor', (object)array(
                'id'    => 1,
                'name'  => 'event name',
            )),

            array('<h3>another html-anchor</h3>', 'another html-anchor', (object)array(
                'id'    => 1,
                'name'  => 'event name does not matter here',
            )),
        );

    } // END function provide__getTitle

} // END class Tests_App_View_Helper_AtheleteItem