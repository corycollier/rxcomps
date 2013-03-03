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
    public function test_competitionItem ($expected, $competition, $title, $actions = null)
    {
        $subject = $this->getBuiltMock('App_View_Helper_CompetitionItem', array('_getTitle', '_getActions'));

        $subject->expects($this->once())
            ->method('_getTitle')
            ->with($this->equalTo($competition))
            ->will($this->returnValue($title));

        $subject->expects($this->once())
            ->method('_getActions')
            ->with($this->equalTo($competition))
            ->will($this->returnValue($actions));

        $result = $subject->CompetitionItem($competition);

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
            array(
                '<div class="competition-item">title</div>',
                (object)array('id' => 1, 'name' => 'value'),
                'title',
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
        $view   = $this->getBuiltMock('Zend_View', array('htmlAnchor'));

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->with(
                $this->equalTo(@$competition->name),
                $this->equalTo(array(
                    'controller'=> 'competitions',
                    'action'    => 'view',
                    'id'        => @$competition->id,
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

    /**
     * test__getActions()
     *
     * Tests the _getActions of the App_View_Helper_CompetitionItem
     *
     * @covers          App_View_Helper_CompetitionItem::_getActions
     * @dataProvider    provide__getActions
     */
    public function test__getActions ($expected, $competition, $hasIdentity,
        $editLink = null, $deleteLink = null)
    {
        $subject = $this->getBuiltMock('App_View_Helper_CompetitionItem');
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
                        'controller'    => 'competitions',
                        'action'        => 'edit',
                        'id'            => @$competition->id
                    ), $editLink),
                    array('Delete', array(
                        'controller'    => 'competitions',
                        'action'        => 'delete',
                        'id'            => @$competition->id
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

        $result = $this->getMethod('App_View_Helper_CompetitionItem', '_getActions')
            ->invoke($subject, $competition);

        $this->assertEquals($expected, $result);

    } // END function test__getActions

    /**
     * provide__getActions()
     *
     * Provides data for the _getActions method of the
     * App_View_Helper_CompetitionItem class
     */
    public function provide__getActions ( )
    {
        // $expected, $competition, $hasIdentity, $editLink = null, $deleteLink = null
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