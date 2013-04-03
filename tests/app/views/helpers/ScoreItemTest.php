<?php
/**
 * Unit Tests for App_View_Helper_ScoreItem
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_ScoreItem class
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
 * Unit Tests for App_View_Helper_ScoreItem
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_ScoreItem class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_View_Helper_ScoreItem
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_scoreItem()
     *
     * Tests the scoreItem of the App_View_Helper_ScoreItem
     *
     * @covers          App_View_Helper_ScoreItem::scoreItem
     * @dataProvider    provide_scoreItem
     */
    public function test_scoreItem ($expected, $score, $params = array(), $actions = null)
    {
        $subject = $this->getBuiltMock('App_View_Helper_ScoreItem', array('_getTitle'));
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
            ->with($this->equalTo($score), $this->equalTo('App_Model_Score'))
            ->will($this->returnValue($model));

        $subject->expects($this->once())
            ->method('_getTitle')
            ->with($this->equalTo($score))
            ->will($this->returnValue($title));

        $subject->view = $view;

        $result = $subject->scoreItem($score, $user, $params);

        $this->assertEquals($expected, $result);

    } // END function test_scoreItem

    /**
     * provide_scoreItem()
     *
     * Provides data for the scoreItem method of the
     * App_View_Helper_ScoreItem class
     */
    public function provide_scoreItem ( )
    {
        // $expected, $hasIdentity, $score, $title, $actions = null)
        return array(
            'no params, no actions' => array(
                '<div class="list-item score-item">title</div>',
                (object)array('id' => 1, 'name' => 'value', 'goal' => 'time'),
            ),
        );

    } // END function provide_scoreItem


    /**
     * test__getTitle()
     *
     * Tests the _getTitle of the App_View_Helper_ScoreItem
     *
     * @covers          App_View_Helper_ScoreItem::_getTitle
     * @dataProvider    provide__getTitle
     */
    public function test__getTitle ($expected,
        $scoreLink,
        $athleteLink,
        $competitionLink,
        $scoreValue,
        $scoreId,
        $athleteName,
        $athleteId,
        $competitionName,
        $competitionId)
    {
        $subject = $this->getBuiltMock('App_View_Helper_ScoreItem');
        $row    = $this->getBuiltMock('Zend_Db_Table_Row', array('findParentRow'));
        $view   = $this->getBuiltMock('Zend_View', array('htmlAnchor'));
        $score  = $this->getBuiltMock('App_Model_DbTable_Score', array('findParentRow'));

        $athlete = (object)array(
            'name'  => $athleteName,
            'id'    => $athleteId,
        );

        $competition = (object)array(
            'name'  => $competitionName,
            'id'    => $competitionId,
            'goal' => null,
        );

        $score->id = $scoreId;
        $score->score = $scoreValue;

        $score->expects($this->any())
            ->method('findParentRow')
            ->will($this->returnValueMap(array(
                array('App_Model_DbTable_Athlete', $athlete),
                array('App_Model_DbTable_Competition', $competition),
            )));

        $scoreParams = array(
            'controller'=> 'scores',
            'action'    => 'view',
            'id'        => $scoreId,
        );

        $athleteParams = array(
            'controller'=> 'athletes',
            'action'    => 'view',
            'id'        => $athleteId,
        );

        $competitionParams = array(
            'controller'=> 'competitions',
            'action'    => 'view',
            'id'        => $competitionId,
        );

        $view->expects($this->any())
            ->method('htmlAnchor')
            ->will($this->returnValueMap(array(
                array($scoreValue, $scoreParams, $scoreLink),
                array($athleteName, $athleteParams, $athleteLink),
                array($competitionName, $competitionParams, $competitionLink),
            )));

        $subject->view = $view;

        $method = new ReflectionMethod('App_View_Helper_ScoreItem', '_getTitle');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $score);

        $this->assertEquals($expected, $result);

    } // END function test__getTitle

    /**
     * provide__getTitle()
     *
     * Provides data for the _getTitle method of the
     * App_View_Helper_ScoreItem class
     */
    public function provide__getTitle ( )
    {
        /**
        $expected,
        $scoreLink,
        $athleteLink,
        $competitionLink,
        $scoreValue,
        $scoreId,
        $athleteName,
        $athleteId,
        $competitionName,
        $competitionId
         */
        return array(
            array(
                '<h3>score-link</h3>'
                    . '<p>Performed by: athlete-link for the event: competition-link</p>',
                'score-link',
                'athlete-link',
                'competition-link',
                1,
                100,
                'athlete-name',
                200,
                'competition-name',
                300,
            ),

            array(
                '<h3>another Score-link</h3>'
                    . '<p>Performed by: another athlete-link for the event: '
                    . 'another competition-link</p>',
                'another score-link',
                'another athlete-link',
                'another competition-link',
                1,
                100,
                'another athlete-name',
                200,
                'another competition-name',
                300,
            ),
        );

    } // END function provide__getTitle

} // END class Tests_App_View_Helper_AtheleteItem