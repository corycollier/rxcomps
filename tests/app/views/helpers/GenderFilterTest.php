<?php
/**
 * Unit Tests for GenderFilter
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_GenderFilter class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Unit Tests for GenderFilter
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_GenderFilter class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_App_View_Helper_GenderFilterTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_genderFilter()
     *
     * Tests the genderFilter of the App_View_Helper_GenderFilter
     *
     * @covers          App_View_Helper_GenderFilter::genderFilter
     * @dataProvider    provide_genderFilter
     */
    public function test_genderFilter ($expected, $htmlAnchorValueMap)
    {
        $subject = new App_View_Helper_GenderFilter;
        $view = $this->getBuiltMock('Zend_View', array('htmlAnchor'));

        $view->expects($this->any())
            ->method('htmlAnchor')
            ->will($this->returnValueMap($htmlAnchorValueMap));

        $subject->view = $view;

        $result = $subject->genderFilter();

        $this->assertEquals($expected, $result);

    } // END function test_genderFilter

    /**
     * provide_genderFilter()
     *
     * Provides data for the genderFilter method of the
     * App_View_Helper_GenderFilter class
     */
    public function provide_genderFilter ( )
    {
        return array(
            array(
                'expected' => implode(PHP_EOL, array(
                    '<ul class="subnav">',
                        '<li>male link</li>',
                        '<li>female link</li>',
                        '<li>team link</li>',
                    '</ul>',
                    null,
                )),
                'htmlAnchorValueMap' => array(
                    array('Male', array('gender' => 'male'), 'male link'),
                    array('Female', array('gender' => 'female'), 'female link'),
                    array('Team', array('gender' => 'team'), 'team link'),
                ),
            ),
        );

    } // END function provide_genderFilter
}