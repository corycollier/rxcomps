<?php
/**
 * Unit Test Suite for the App_View_Helper_EventItemOption class
 *
 * This unit test suite should test all custom functionality provided by the
 * App_View_Helper_EventItemOption class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the App_View_Helper_EventItemOption
 *
 * This unit test suite should test all custom functionality provided by the
 * App_View_Helper_EventItemOption class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_App_View_Helper_EventItemOptionTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_eventOptionItem()
     *
     * Tests the eventOptionItem method of the App_View_Helper_EventOptionItem class
     *
     * @covers App_View_Helper_EventOptionItem::eventOptionItem
     * @dataProvider provide_eventOptionItem
     */
    public function test_eventOptionItem ($expected, $eventOption, $params = array(), $actions = null)
    {
        $subject = $this->getBuiltMock('App_View_Helper_EventOptionItem', array('_getTitle'));
        $view   = $this->getBuiltMock('Zend_View', array('model'));
        $user   = $this->getBuiltMock('App_Model_User');
        $model  = $this->getBuiltMock('Rx_View_Helper_Model', array('links'));
        $title  = 'title';

        $model->expects($this->once())
            ->method('links')
            ->with($this->equalTo($user), $this->equalTo($params))
            ->will($this->returnValue($actions));

        $view->expects($this->once())
            ->method('model')
            ->with($this->equalTo($eventOption), $this->equalTo('App_Model_EventOption'))
            ->will($this->returnValue($model));

        $subject->expects($this->once())
            ->method('_getTitle')
            ->with($this->equalTo($eventOption))
            ->will($this->returnValue($title));

        $subject->view = $view;

        $result = $subject->eventOptionItem($eventOption, $user, $params);

        $this->assertEquals($expected, $result);

    } // END function test_eventOptionItem

    /**
     * provide_eventOptionItem()
     *
     * Provides data to use for testing the eventOptionItem method of
     * the App_View_Helper_EventOptionItem class
     *
     * @return array
     */
    public function provide_eventOptionItem ( )
    {
        // ($expected, $eventOption, $params = array(), $actions = null
        return array(
            'no params, no actions' => array(
                '<div class="list-item event-option-item">title</div>',
                (object)array('id' => 1, 'name' => 'value'),
            ),

            'has params, no actions' => array(
                '<div class="list-item event-option-item">title</div>',
                (object)array('id' => 1, 'name' => 'value', 'goal' => 'time'),
                array(
                    'key' => 'value',
                )
            ),
        );

    } // END function provide_eventOptionItem


    /**
     * test__getTitle()
     *
     * Tests the _getTitle of the App_View_Helper_EventOptionItem
     *
     * @covers          App_View_Helper_EventOptionItem::_getTitle
     * @dataProvider    provide__getTitle
     */
    public function test__getTitle ($expected, $htmlAnchor, $eventOption)
    {
        $subject = $this->getBuiltMock('App_View_Helper_EventOptionItem');
        $view = $this->getBuiltMock('Zend_View', array('htmlAnchor'));

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->with(
                $this->equalTo(@$eventOption->name),
                $this->equalTo(array(
                    'controller' => 'event-options',
                    'action'    => 'view',
                    'id'        => @$eventOption->id,
                    'event_id'  => @$eventOption->event_id,
                ))
            )
            ->will($this->returnValue($htmlAnchor));

        $subject->view = $view;

        $result = $this->getMethod('App_View_Helper_EventOptionItem', '_getTitle')
            ->invoke($subject, $eventOption);

        $this->assertEquals($expected, $result);

    } // END function test__getTitle

    /**
     * provide__getTitle()
     *
     * Provides data for the _getTitle method of the
     * App_View_Helper_EventOptionItem class
     */
    public function provide__getTitle ( )
    {
        //($expected, $htmlAnchor, $eventOption)
        return array(
            array(
                'expected'  => '<h3>html-anchor</h3>',
                'anchor'    => 'html-anchor',
                'eventOption' => (object)array(
                    'id'    => 1,
                    'name'  => 'EventOption Name',
                    'event_id' => 1,
                ),
            ),
        );

    } // END function provide__getTitle

} // END class Tests_App_View_Helper_EventItemOptionTest