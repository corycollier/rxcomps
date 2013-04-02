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

class Tests_App_View_Helper_AtheleteItem
    extends Rx_PHPUnit_TestCase
{

    /**
     * test_athleteItem()
     *
     * Tests the athleteItem of the App_View_Helper_AthleteItem
     *
     * @covers          App_View_Helper_AthleteItem::athleteItem
     * @dataProvider    provide_athleteItem
     */
    public function test_athleteItem ($expected, $athlete, $user, $params = array(), $actions = null)
    {
        $subject = $this->getBuiltMock('App_View_Helper_AthleteItem', array(
            '_getTitle', '_getActions'
        ));
        $view   = $this->getBuiltMock('Zend_View', array('model'));
        $model  = $this->getBuiltMock('Rx_View_Helper_Model', array('links'));

        $title = 'title';

        $merged = array_merge($params, array(
            'event_id' => $athlete->event_id,
        ));

        $model->expects($this->once())
            ->method('links')
            ->with($this->equalTo($user), $this->equalTo($merged))
            ->will($this->returnValue($actions));

        $view->expects($this->once())
            ->method('model')
            ->will($this->returnValue($model));

        $subject->expects($this->once())
            ->method('_getTitle')
            ->with($this->equalTo($athlete))
            ->will($this->returnValue($title));

        $subject->view = $view;

        $result = $subject->athleteItem($athlete, $user, $params);

        $this->assertEquals($expected, $result);

    } // END function test_athleteItem

    /**
     * provide_athleteItem()
     *
     * Provides data for the athleteItem method of the
     * App_View_Helper_AthleteItem class
     */
    public function provide_athleteItem ( )
    {
        // $expected, $hasIdentity, $athlete, $title, $actions = null)
        return array(
            'no params, no actions' => array(
                'expected' => '<div class="list-item athlete-item">title</div>',
                'athlete' => (object)array('id' => 1, 'name' => 'value', 'event_id' => 1),
                'user' => (object)array('id' => 1, 'name' => 'value', 'event_id' => 1),
            ),

            'has params, no actions' => array(
                'expected'  => '<div class="list-item athlete-item">title</div>',
                'event'     => (object)array('id' => 1, 'name' => 'value', 'event_id' => 1),
                'user'      => (object)array('id' => 1, 'name' => 'value'),
                'params'    => array(
                    'key' => 'value',
                ),
            ),
        );

    } // END function provide_athleteItem


    /**
     * test__getTitle()
     *
     * Tests the _getTitle of the App_View_Helper_AthleteItem
     *
     * @covers          App_View_Helper_AthleteItem::_getTitle
     * @dataProvider    provide__getTitle
     */
    public function test__getTitle ($expected, $htmlAnchor, $athlete)
    {
        $subject = $this->getBuiltMock('App_View_Helper_AthleteItem');
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

        $result = $this->getMethod('App_View_Helper_AthleteItem', '_getTitle')
            ->invoke($subject, $athlete);

        $this->assertEquals($expected, $result);

    } // END function test__getTitle

    /**
     * provide__getTitle()
     *
     * Provides data for the _getTitle method of the
     * App_View_Helper_AthleteItem class
     */
    public function provide__getTitle ( )
    {
        return array(
            array('<h3>html-anchor <span class="alt">()</span></h3>', 'html-anchor', (object)array(
                'id'    => 1,
                'name'  => 'Athlete Name',
                'gym'   => null,
                'event_id' => 1,
            )),

            array('<h3>another html-anchor <span class="alt">(some gym)</span></h3>', 'another html-anchor', (object)array(
                'id'    => 1,
                'name'  => 'Athlete Name Does Not Matter Here',
                'gym'   => 'some gym',
                'event_id' => 1,
            )),
        );

    } // END function provide__getTitle

} // END class Tests_App_View_Helper_AtheleteItem