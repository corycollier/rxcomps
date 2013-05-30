<?php
/**
 * Unit Tests for AtheleteItem
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_Competition class
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
 * App_View_Helper_Competition class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_View_Helper_Competition
    extends Rx_PHPUnit_TestCase
{

    /**
     * test_competition()
     *
     * Tests the CompetitionItem of the App_View_Helper_Competition
     *
     * @covers          App_View_Helper_Competition::competition
     * @dataProvider    provide_competition
     */
    public function test_competition ($model)
    {
        $subject = $this->getBuiltMock('App_View_Helper_Competition', array('model'));

        $subject->expects($this->once())
            ->method('model')
            ->with($this->equalTo($model), $this->equalTo('App_Model_Competition'))
            ->will($this->returnSelf());

        $result = $subject->competition($model);

        $this->assertEquals($subject, $result);

    } // END function test_competition

    /**
     * provide_competition()
     *
     * Provides data for the CompetitionItem method of the
     * App_View_Helper_Competition class
     */
    public function provide_competition ( )
    {
        // $expected, $hasIdentity, $competition, $title, $actions = null)
        return array(
            'no params, no actions' => array(
                (object)array('id' => 1, 'name' => 'value'),
            ),
        );

    } // END function provide_competition


    /**
     * test__getTitle()
     *
     * Tests the _getTitle of the App_View_Helper_Competition
     *
     * @covers          App_View_Helper_Competition::_getTitle
     * @dataProvider    provide__getTitle
     */
    public function test__getTitle ($expected, $htmlAnchor, $competition)
    {
        $subject = $this->getBuiltMock('App_View_Helper_Competition');
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

        $result = $this->getMethod('App_View_Helper_Competition', '_getTitle')
            ->invoke($subject, $competition);

        $this->assertEquals($expected, $result);

    } // END function test__getTitle

    /**
     * provide__getTitle()
     *
     * Provides data for the _getTitle method of the
     * App_View_Helper_Competition class
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