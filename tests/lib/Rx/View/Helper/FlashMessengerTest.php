<?php
/**
 * Unit Test Suite for the FlashMessenger class
 *
 * This unit test should test all of the custom functionality provided by the
 * Rx_View_Helper_FlashMessenger class
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
 * Unit Test Suite for the FlashMessenger
 *
 * This unit test should test all of the custom functionality provided by the
 * Rx_View_Helper_FlashMessenger class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_Rx_View_Helper_FlashMessengerTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_flashMessenger()
     *
     * Tests the flashMessenger method of the Rx_View_Helper_FlashMessenger class
     *
     * @covers Rx_View_Helper_FlashMessenger::flashMessenger
     * @dataProvider provide_flashMessenger
     */
    public function test_flashMessenger ($expected, $errors = array(), $info = array(), $successes = array())
    {
        $subject = new Rx_View_Helper_FlashMessenger;
        $subject->view = new Zend_View;

        $flashMessenger = $this->getMockBuilder('Zend_Controller_Action_Helper_FlashMessenger')
            ->setMethods(array('getMessages'))
            ->disableOriginalConstructor()
            ->getMock();

        $flashMessenger->expects($this->any())
            ->method('getMessages')
            ->will($this->returnValueMap(array(
                array('error', $errors),
                array('info', $info),
                array('success', $successes)
            )));

        $result = $subject->flashMessenger($flashMessenger);

        $this->assertEquals($expected, $result);

    } // END function test_flashMessenger

    /**
     * provide_flashMessenger()
     *
     * Provides data to use for testing the flashMessenger method of
     * the Rx_View_Helper_FlashMessenger class
     *
     * @return array
     */
    public function provide_flashMessenger ( )
    {
        return array(
            'no messages' => array(
                '<div class="flash-messages"></div>'
            ),

            '1 error message' => array(
                implode(PHP_EOL, array(
                    '<div class="flash-messages"><ul class="error">',
                    '<li>test message</li>',
                    '</ul>',
                    '</div>',
                )),
                array('test message')
            ),
        );

    } // END function provide_flashMessenger

} // END class Tests_Rx_View_Helper_FlashMessengerTest