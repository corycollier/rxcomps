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
    extends PHPUnit_Framework_TestCase
{

    /**
     * test_athleteItem()
     *
     * Tests the athleteItem of the App_View_Helper_AthleteItem
     *
     * @covers          App_View_Helper_AthleteItem::athleteItem
     * @dataProvider    provide_athleteItem
     */
    public function test_athleteItem ($expected, $athlete, $title, $actions = null)
    {
        $subject = $this->getMockBuilder('App_View_Helper_AthleteItem')
            ->setMethods(array('_getTitle', '_getActions'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('_getTitle')
            ->with($this->equalTo($athlete))
            ->will($this->returnValue($title));

        $subject->expects($this->once())
            ->method('_getActions')
            ->with($this->equalTo($athlete))
            ->will($this->returnValue($actions));

        $result = $subject->athleteItem($athlete);

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
            array(
                '<div class="athlete-item">title</div>',
                (object)array('id' => 1, 'name' => 'value'),
                'title',
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
        $subject = $this->getMockBuilder('App_View_Helper_AthleteItem')
            ->disableOriginalConstructor()
            ->getMock();

        $view = $this->getMockBuilder('Zend_View')
            ->setMethods(array('htmlAnchor'))
            ->disableOriginalConstructor()
            ->getMock();

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->with(
                $this->equalTo(@$athlete->name),
                $this->equalTo(array(
                    'action'    => 'view',
                    'id'        => @$athlete->id,
                ))
            )
            ->will($this->returnValue($htmlAnchor));


        $subject->view = $view;

        $method = new ReflectionMethod('App_View_Helper_AthleteItem', '_getTitle');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $athlete);

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
            array('<h3>html-anchor</h3>', 'html-anchor', (object)array(
                'id'    => 1,
                'name'  => 'Athlete Name',
            )),

            array('<h3>another html-anchor</h3>', 'another html-anchor', (object)array(
                'id'    => 1,
                'name'  => 'Athlete Name Does Not Matter Here',
            )),
        );

    } // END function provide__getTitle

    /**
     * test__getActions()
     *
     * Tests the _getActions of the App_View_Helper_AthleteItem
     *
     * @covers          App_View_Helper_AthleteItem::_getActions
     * @dataProvider    provide__getActions
     */
    public function test__getActions ($expected, $athlete, $hasIdentity,
        $editLink = null, $deleteLink = null)
    {
        $subject = $this->getMockBuilder('App_View_Helper_AthleteItem')
            ->disableOriginalConstructor()
            ->getMock();

        $view = $this->getMockBuilder('Zend_View')
            ->setMethods(array('auth', 'htmlAnchor', 'htmlList'))
            ->disableOriginalConstructor()
            ->getMock();

        $auth = $this->getMockBuilder('Zend_Auth')
            ->setMethods(array('hasIdentity'))
            ->disableOriginalConstructor()
            ->getMock();

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
                        'id' => @$athlete->id
                    ), $editLink),
                    array('Delete', array(
                        'action' => 'delete',
                        'id' => @$athlete->id
                    ), $deleteLink),
                )));

            $view->expects($this->once())
                ->method('htmlList')
                ->with(
                    $this->equalTo(array($editLink, $deleteLink)),
                    $this->equalTo(false),
                    $this->equalTo(array('class' => 'actions')),
                    $this->equalTo(false)
                )
                ->will($this->returnValue($expected));
        }

        $subject->view = $view;

        $method = new ReflectionMethod('App_View_Helper_AthleteItem', '_getActions');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $athlete);

        $this->assertEquals($expected, $result);

    } // END function test__getActions

    /**
     * provide__getActions()
     *
     * Provides data for the _getActions method of the
     * App_View_Helper_AthleteItem class
     */
    public function provide__getActions ( )
    {
        // $expected, $athlete, $hasIdentity, $editLink = null, $deleteLink = null
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