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
     * test_eventOption()
     *
     * Tests the eventOption method of the App_View_Helper_EventOptionItem class
     *
     * @covers App_View_Helper_EventOptionItem::eventOption
     * @dataProvider provide_eventOption
     */
    public function test_eventOption ($model)
    {
        $subject = $this->getBuiltMock('App_View_Helper_EventOptionItem', array('model'));

        $subject->expects($this->once())
            ->method('model')
            ->with($this->equalTo($model), $this->equalTo('App_Model_EventOptionItem'))
            ->will($this->returnSelf());

        $result = $subject->eventOption($model);

        $this->assertEquals($subject, $result);

    } // END function test_eventOption

    /**
     * provide_eventOption()
     *
     * Provides data to use for testing the eventOption method of
     * the App_View_Helper_EventOptionItem class
     *
     * @return array
     */
    public function provide_eventOption ( )
    {
        // ($expected, $eventOption, $params = array(), $actions = null
        return array(
            'no params, no actions' => array(
                (object)array('id' => 1, 'name' => 'value'),
            ),
        );

    } // END function provide_eventOption


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