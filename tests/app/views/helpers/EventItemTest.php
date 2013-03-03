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
    public function test_eventItem ($expected, $event, $title, $actions = null)
    {
        $subject = $this->getBuiltMock('App_View_Helper_EventItem', array('_getTitle', '_getActions'));

        $subject->expects($this->once())
            ->method('_getTitle')
            ->with($this->equalTo($event))
            ->will($this->returnValue($title));

        $subject->expects($this->once())
            ->method('_getActions')
            ->with($this->equalTo($event))
            ->will($this->returnValue($actions));

        $result = $subject->eventItem($event);

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
            array(
                '<div class="event-item">title</div>',
                (object)array('id' => 1, 'name' => 'value'),
                'title',
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
                    'action'    => 'view',
                    'id'        => @$event->id,
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

    /**
     * test__getActions()
     *
     * Tests the _getActions of the App_View_Helper_EventItem
     *
     * @covers          App_View_Helper_EventItem::_getActions
     * @dataProvider    provide__getActions
     */
    public function test__getActions ($expected, $event, $hasIdentity,
        $editLink = null, $deleteLink = null)
    {
        $subject = $this->getBuiltMock('App_View_Helper_EventItem');
        $view = $this->getBuiltMock('Zend_View', array('auth', 'htmlAnchor', 'htmlList'));
        $auth = $this->getBuiltMock('Zend_Auth', array('hasIdentity'));

        $auth->expects($this->once())
            ->method('hasIdentity')
            ->will($this->returnValue($hasIdentity));

        $view->expects($this->once())
            ->method('auth')
            ->will($this->returnValue($auth));

        if ($hasIdentity) {
            $view->expects($this->any())
                ->method('htmlAnchor')
                ->will($this->returnValueMap(array(
                    array('Edit', array(
                        'action' => 'edit',
                        'id' => @$event->id
                    ), $editLink),
                    array('Delete', array(
                        'action' => 'delete',
                        'id' => @$event->id
                    ), $deleteLink),
                )));

            $view->expects($this->once())
                ->method('htmlList')
                ->with(
                    $this->equalTo(array($editLink, $deleteLink)),
                    $this->equalTo(false),
                    $this->equalTo(array('class' => 'subnav')),
                    $this->equalTo(false)
                )
                ->will($this->returnValue($expected));
        }

        $subject->view = $view;

        $method = new ReflectionMethod('App_View_Helper_EventItem', '_getActions');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $event);

        $this->assertEquals($expected, $result);

    } // END function test__getActions

    /**
     * provide__getActions()
     *
     * Provides data for the _getActions method of the
     * App_View_Helper_EventItem class
     */
    public function provide__getActions ( )
    {
        // $expected, $event, $hasIdentity, $editLink = null, $deleteLink = null
        return array(
            'no identity' => array(
                '', (object)array('name' => 'name', 'id' => 1), false
            ),

            'has identity' => array(
                '', (object)array('name' => 'name', 'id' => 1), true, 'edit link', 'delete link'
            ),

        );

    } // END function provide__getActions

} // END class Tests_App_View_Helper_AtheleteItem