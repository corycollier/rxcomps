<?php
/**
 * Unit Tests for AtheleteItem
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_AtheleteItem class
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
 * App_View_Helper_AtheleteItem class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_View_Helper_AtheleteTest
    extends Rx_PHPUnit_TestCase
{

    /**
     * test_athlete()
     *
     * Tests the athlete of the App_View_Helper_athlete
     *
     * @covers App_View_Helper_athlete::athlete
     * @dataProvider provide_athlete
     */
    public function test_athlete ($athlete)
    {
        $subject = $this->getBuiltMock('App_View_Helper_Athlete', array('model'));

        $subject->expects($this->once())
            ->method('model')
            ->with($this->equalTo($athlete), $this->equalTo('App_Model_Athlete'))
            ->will($this->returnSelf());

        $result = $subject->athlete($athlete);

        $this->assertEquals($subject, $result);

    } // END function test_athlete

    /**
     * provide_athlete()
     *
     * Provides data for the athlete method of the
     * App_View_Helper_athlete class
     */
    public function provide_athlete ( )
    {
        // $expected, $hasIdentity, $athlete, $title, $actions = null)
        return array(
            'no params, no actions' => array(
                'athlete' => (object)array('id' => 1, 'name' => 'value', 'event_id' => 1),
            ),
        );

    } // END function provide_athlete


    /**
     * test__getTitle()
     *
     * Tests the _getTitle of the App_View_Helper_athlete
     *
     * @covers          App_View_Helper_athlete::_getTitle
     * @dataProvider    provide__getTitle
     */
    public function test__getTitle ($expected, $htmlAnchor, $athlete)
    {
        $this->markTestIncomplete("Need to revisit");
        $subject = $this->getBuiltMock('App_View_Helper_athlete');
        $view = $this->getBuiltMock('Zend_View', array('htmlAnchor'));

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->with(
                $this->equalTo(@$athlete->name),
                $this->equalTo(array(
                    'controller' => 'athletes',
                    'action'    => 'view',
                    'id'        => @$athlete->id,
                    'event_id'  => @$athlete->event_id,
                ))
            )
            ->will($this->returnValue($htmlAnchor));


        $subject->view = $view;

        $result = $this->getMethod('App_View_Helper_athlete', '_getTitle')
            ->invoke($subject, $athlete);

        $this->assertEquals($expected, $result);

    } // END function test__getTitle

    /**
     * provide__getTitle()
     *
     * Provides data for the _getTitle method of the
     * App_View_Helper_athlete class
     */
    public function provide__getTitle ( )
    {
        return array(
            array('<h3>html-anchor <span class="alt">()</span></h3>', 'html-anchor', (object)array(
                'row' => (object)array(
                    'id'    => 1,
                    'name'  => 'Athlete Name',
                    'gym'   => null,
                    'event_id' => 1,
                )
            )),

            array('<h3>another html-anchor <span class="alt">(some gym)</span></h3>', 'another html-anchor', (object)array(
                'row' => (object)array(
                    'id'    => 1,
                    'name'  => 'Athlete Name Does Not Matter Here',
                    'gym'   => 'some gym',
                    'event_id' => 1,
                ),
            )),
        );

    } // END function provide__getTitle

} // END class Tests_App_View_Helper_AtheleteItem