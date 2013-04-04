<?php
/**
 * Unit Tests for AtheleteItem
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_CompetitionItem class
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
 * Unit Tests for AtheleteItem
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_CompetitionItem class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_View_Helper_CompetitionItem
    extends Rx_PHPUnit_TestCase
{

    /**
     * test_competitionItem()
     *
     * Tests the CompetitionItem of the App_View_Helper_CompetitionItem
     *
     * @covers          App_View_Helper_CompetitionItem::competitionItem
     * @dataProvider    provide_competitionItem
     */
    public function test_competitionItem ($expected, $competition, $params = array(), $actions = null)
    {
        $subject = $this->getBuiltMock('App_View_Helper_CompetitionItem', array('_getTitle'));
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
            ->with($this->equalTo($competition), $this->equalTo('App_Model_Competition'))
            ->will($this->returnValue($model));

        $subject->expects($this->once())
            ->method('_getTitle')
            ->with($this->equalTo($competition))
            ->will($this->returnValue($title));

        $subject->view = $view;

        $result = $subject->competitionItem($competition, $user, $params);

        $this->assertEquals($expected, $result);

    } // END function test_competitionItem

    /**
     * provide_competitionItem()
     *
     * Provides data for the CompetitionItem method of the
     * App_View_Helper_CompetitionItem class
     */
    public function provide_competitionItem ( )
    {
        // $expected, $hasIdentity, $competition, $title, $actions = null)
        return array(
            'no params, no actions' => array(
                '<div class="list-item competition-item">title</div>',
                (object)array('id' => 1, 'name' => 'value'),
            ),

            'has params, no actions' => array(
                '<div class="list-item competition-item">title</div>',
                (object)array('id' => 1, 'name' => 'value', 'goal' => 'time'),
                array(
                    'key' => 'value',
                )
            ),
        );

    } // END function provide_competitionItem


    /**
     * test__getTitle()
     *
     * Tests the _getTitle of the App_View_Helper_CompetitionItem
     *
     * @covers          App_View_Helper_CompetitionItem::_getTitle
     * @dataProvider    provide__getTitle
     */
    public function test__getTitle ($expected, $htmlAnchor, $competition)
    {
        $subject = $this->getBuiltMock('App_View_Helper_CompetitionItem');
        $view   = $this->getBuiltMock('Zend_View', array('htmlAnchor', 'event'));
        $event  = $this->getBuiltMock('App_View_Helper_Event', array('id'));
        $eventId = 1;

        $event->expects($this->once())
            ->method('id')
            ->will($this->returnValue($eventId));

        $view->expects($this->once())
            ->method('event')
            ->will($this->returnValue($event));

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->with(
                $this->equalTo(@$competition->name),
                $this->equalTo(array(
                    'controller'=> 'competitions',
                    'action'    => 'view',
                    'id'        => @$competition->id,
                    'event_id'  => $eventId,
                ))
            )
            ->will($this->returnValue($htmlAnchor));


        $subject->view = $view;

        $result = $this->getMethod('App_View_Helper_CompetitionItem', '_getTitle')
            ->invoke($subject, $competition);

        $this->assertEquals($expected, $result);

    } // END function test__getTitle

    /**
     * provide__getTitle()
     *
     * Provides data for the _getTitle method of the
     * App_View_Helper_CompetitionItem class
     */
    public function provide__getTitle ( )
    {
        return array(
            array('<h3>html-anchor</h3>', 'html-anchor', (object)array(
                'id'    => 1,
                'name'  => 'Competition Name',
            )),

            array('<h3>another Html-anchor</h3>', 'another html-anchor', (object)array(
                'id'    => 1,
                'name'  => 'Competition Name Does Not Matter Here',
            )),
        );

    } // END function provide__getTitle

} // END class Tests_App_View_Helper_AtheleteItem