<?php
/**
 * Unit Test Suite for the BackToEvent class
 *
 * This unit test suite should test all of the custom functionality provided by
 * The App_View_Helper_BackToEventLink view helper
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
 * Unit Test Suite for the BackToEvent
 *
 * This unit test suite should test all of the custom functionality provided by
 * The App_View_Helper_BackToEventLink view helper
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

class Tests_App_View_Helper_BackToEventLinkTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_backToEventLink()
     *
     * Tests the backToEventLink method of the App_View_Helper_BackToEventLink class
     *
     * @covers App_View_Helper_BackToEventLink::backToEventLink
     * @dataProvider provide_backToEventLink
     */
    public function test_backToEventLink ($link, $getParent, $params = array(), $exception = '')
    {
        $subject = $this->getBuiltMock('App_View_Helper_BackToEventLink', array('htmlAnchor'));
        $model = $this->getBuiltMock('Rx_Model_Abstract', array('getParent'));
        $event = $this->getBuiltMock('App_Model_Event', array('load', 'getValue'));

        $eventName = 'Event Name';
        $eventId = isset($params['event_id'])
            ? $params['event_id']
            : $params['id'];

        $event->id = $eventId;

        $model->expects($this->once())
            ->method('getParent')
            ->with($this->equalTo('Event'))
            ->will($getParent
                ? $this->returnValue($event)
                : $this->returnValue(false)
            );

        if ($exception) {
            $this->setExpectedException($exception);
        } else {
            $event->expects($this->once())
                ->method('load')
                ->with($this->equalTo($eventId))
                ->will($this->returnSelf());

            $event->expects($this->once())
                ->method('getValue')
                ->with($this->equalTo('name'))
                ->will($this->returnValue($eventName));

            $subject->expects($this->once())
                ->method('htmlAnchor')
                ->with(
                    $this->equalTo(sprintf('Back to %s', $eventName)),
                    $this->equalTo(array(
                        'controller'    => 'events',
                        'action'        => 'view',
                        'id'            => $eventId,
                        'event_id'      => $eventId,
                        'reset-url'     => true,
                    ))
                )
                ->will($this->returnValue($link));
        }

        $expected = sprintf('<div class="small default btn icon-right icon-back">%s</div>', $link);

        $result = $subject->backToEventLink($model, $params);

        $this->assertEquals($expected, $result);

    } // END function test_backToEventLink

    /**
     * provide_backToEventLink()
     *
     * Provides data to use for testing the backToEventLink method of
     * the App_View_Helper_BackToEventLink class
     *
     * @return array
     */
    public function provide_backToEventLink ( )
    {
        // $link, $getParent, $params = array(), $exception = '')
        return array(
            'has parent, no exception' => array(
                'link'      => 'link value',
                'getParent' => true,
                'params'    => array('event_id' => 1),
                'exception' => null,
            ),

            'no parent, throws exception' => array(
                'link'      => 'link value',
                'getParent' => false,
                'params'    => array('event_id' => 1),
                'exception' => 'Rx_View_Helper_Exception',
            ),
        );

    } // END function provide_backToEventLink

} // END class Tests_App_View_Helper_BackToEventLinkTest