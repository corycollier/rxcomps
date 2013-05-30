<?php
/**
 * Unit Tests for Scale
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_Scale class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.1.0
 * @since       File available since release 1.1.0
 * @filesource
 */

/**
 * Unit Tests for Scale
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_Scale class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.1.0
 * @since       Class available since release 1.1.0
 */

class Tests_App_View_Helper_Scale
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_scale()
     *
     * Tests the scale of the App_View_Helper_Scale
     *
     * @covers          App_View_Helper_Scale::scale
     * @dataProvider    provide_scale
     */
    public function test_scale ($model)
    {
        $subject = $this->getMockBuilder('App_View_Helper_Scale')
            ->setMethods(array('model'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('model')
            ->with($this->equalTo($model))
            ->will($this->returnSelf());

        $result = $subject->scale($model);

        $this->assertSame($subject, $result);

    } // END function test_scale

    /**
     * provide_scale()
     *
     * Provides data for the scale method of the
     * App_View_Helper_Scale class
     */
    public function provide_scale ( )
    {
        return array(
            // simple test
            'simple test' => array(
                'model' => (object)array(
                    'id'    => 1,
                    'name'  => 'stuff',
                )
            ),
        );

    } // END function provide_scale

    /**
     * test__getTitle()
     *
     * Tests the _getTitle of the App_View_Helper_Scale
     *
     * @covers          App_View_Helper_Scale::_getTitle
     * @dataProvider    provide__getTitle
     */
    public function test__getTitle ($expected, $link, $scale)
    {
        $subject = new App_View_Helper_Scale;

        $view = $this->getMockBuilder('Zend_View')
            ->setMethods(array('htmlAnchor'))
            ->disableOriginalConstructor()
            ->getMock();

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->with($this->equalTo($scale->name), $this->equalTo(array(
                'controller'=> 'scales',
                'action'    => 'view',
                'id'        => $scale->id,
            )))
            ->will($this->returnValue($link));

        $subject->view = $view;

        $method = new ReflectionMethod('App_View_Helper_Scale', '_getTitle');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $scale);

        $this->assertEquals($expected, $result);

    } // END function test__getTitle

    /**
     * provide__getTitle()
     *
     * Provides data for the _getTitle method of the
     * App_View_Helper_Scale class
     */
    public function provide__getTitle ( )
    {
        return array(
            array(
                'expected'  => '<h3>link value</h3>',
                'link'      => 'link value',
                'scale'     => (object)array(
                    'id'    => 1,
                    'name'  => 'name value',
                )
            ),
        );

    } // END function provide__getTitle

} // END class Tests_App_View_Helper_Scale