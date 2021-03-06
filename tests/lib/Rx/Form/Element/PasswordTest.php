<?php
/**
 * Rx_Form_Element_Password Unit Test
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_Form_Element_Password class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Form_Element
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Rx_Form_Element_Password Unit Test
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_Form_Element_Password class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Form_Element
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_Form_Element_PasswordTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_loadDefaultDecorators()
     *
     * Tests the loadDefaultDecorators method of the Rx_Form_Element_Password class
     *
     * @covers Rx_Form_Element_Password::loadDefaultDecorators
     * @dataProvider provide_loadDefaultDecorators
     */
    public function test_loadDefaultDecorators ($loadDefaultDecoratorsIsDisabled, $decorators = null)
    {
        $subject = $this->getBuiltMock('Rx_Form_Element_Password', array(
            'loadDefaultDecoratorsIsDisabled',
            'addDecorators',
            'addDecorator',
            'getDecorators',
        ));

        $subject->expects($this->any())
            ->method('loadDefaultDecoratorsIsDisabled')
            ->will($this->returnValue($loadDefaultDecoratorsIsDisabled));

        if (! $loadDefaultDecoratorsIsDisabled) {
            $subject->expects($this->once())
                ->method('getDecorators')
                ->will($this->returnValue($decorators));

            if (empty($decorators)) {
                $subject->expects($this->any())
                    ->method('addDecorator')
                    ->will($this->returnSelf());
            }

            $subject->expects($this->once())
                ->method('addDecorators')
                ->with($this->equalTo(array(
                    array(array('elementDiv' => 'HtmlTag'), array(
                        'tag' => 'div',
                        'class' => 'text',
                    )),
                    array(array('td' => 'HtmlTag'), array(
                        'tag' => 'div',
                        'class' => 'prepend field',
                    )),
                )));
        }

        $result = $subject->loadDefaultDecorators();

        $this->assertSame($subject, $result);


    } // END function test_loadDefaultDecorators

    /**
     * provide_loadDefaultDecorators()
     *
     * Provides data to use for testing the loadDefaultDecorators method of
     * the Rx_Form_Element_Password class
     *
     * @return array
     */
    public function provide_loadDefaultDecorators ( )
    {
        return array(
            array(true),
            array(false),
        );

    } // END function provide_loadDefaultDecorators
} // END class Rx_Form_Abstract