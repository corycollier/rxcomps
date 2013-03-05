<?php
/**
 * Rx_Form_Element_Submit Unit Test
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_Form_Element_Submit class
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
 * Rx_Form_Element_Submit Unit Test
 *
 * This unit test suite should test all of the custom functionality provided
 * by the Rx_Form_Element_Submit class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_Form_Element
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_Rx_Form_Element_SubmitTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_loadDefaultDecorators()
     *
     * Tests the loadDefaultDecorators method of the Rx_Form_Element_Submit class
     *
     * @covers Rx_Form_Element_Submit::loadDefaultDecorators
     * @dataProvider provide_loadDefaultDecorators
     */
    public function test_loadDefaultDecorators ($loadDefaultDecoratorsIsDisabled, $decorators = null)
    {
        $subject = $this->getBuiltMock('Rx_Form_Element_Submit', array(
            'loadDefaultDecoratorsIsDisabled',
            'getDecorators',
            'addDecorator',
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
        }

        $result = $subject->loadDefaultDecorators();

        $this->assertSame($subject, $result);

    } // END function test_loadDefaultDecorators

    /**
     * provide_loadDefaultDecorators()
     *
     * Provides data to use for testing the loadDefaultDecorators method of
     * the Rx_Form_Element_Submit class
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