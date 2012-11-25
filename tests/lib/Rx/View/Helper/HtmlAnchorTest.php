<?php
/**
 * Unit Test Suite for the HtmlAnchor class
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_View_Helper_HtmlAnchor class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the HtmlAnchor
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_View_Helper_HtmlAnchor class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_Rx_View_Helper_HtmlAnchorTest
    extends Rx_PHPUnit_TestCase
{

    /**
     * setUp()
     *
     * Implementation of the setUp hook, that will be called before each test
     */
    public function setUp ( )
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();

        $router->addRoute('default',
            new Zend_Controller_Router_Route(':module/:controller/:action', array(
                'module' => 'default',
                'controller' => 'index',
                'action'    => 'index',
            ))
        );

    } // END function setu


    /**
     * test_htmlAnchor()
     *
     * Tests the htmlAnchor method of the Rx_View_Helper_HtmlAnchor class
     *
     * @covers Rx_View_Helper_HtmlAnchor::htmlAnchor
     * @dataProvider provide_htmlAnchor
     */
    public function test_htmlAnchor ($expected, $text, $urlOptions = array(), $attribs = array())
    {
        $view = new Zend_View;

        $subject = new Rx_View_Helper_HtmlAnchor;

        $subject->view = $view;

        $result = $subject->htmlAnchor($text, $urlOptions, $attribs);

        $this->assertEquals($expected, $result);

    } // END function test_htmlAnchor

    /**
     * provide_htmlAnchor()
     *
     * Provides data to use for testing the htmlAnchor method of
     * the Rx_View_Helper_HtmlAnchor class
     *
     * @return array
     */
    public function provide_htmlAnchor ( )
    {
        return array(
            'simple test' => array(
                '<a href="/">text</a>',
                'text',
                array(),
            ),

            'simple test, with attribs' => array(
                '<a href="/" class="class-name">text</a>',
                'text',
                array(),
                array(
                    'class' => 'class-name',
                )
            ),

            'simple test, with url options' => array(
                '<a href="/default/users" class="class-name">text</a>',
                'text',
                array(
                    'controller' => 'users',
                ),
                array(
                    'class' => 'class-name',
                )
            ),
        );

    } // END function provide_htmlAnchor

} // END class Tests_Rx_View_Helper_HtmlAnchorTest