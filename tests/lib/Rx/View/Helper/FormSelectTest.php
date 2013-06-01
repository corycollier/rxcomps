<?php
/**
 * Tests_Rx_View_Helper_FormSelectTest Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Tests_Rx_View_Helper_FormSelectTest class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       File available since release 2.1.0
 * @filesource
 */

/**
 * Tests_Rx_View_Helper_FormSelectTest Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Tests_Rx_View_Helper_FormSelectTest class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  Rx_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 */

class Tests_Rx_View_Helper_FormSelectTest
    extends Rx_PHPUnit_TestCase
{
    /**
     * test_formSelect()
     *
     * Tests the formSelect method of the Tests_Rx_View_Helper_FormSelectTest class
     *
     * @covers Rx_View_Helper_FormSelect::formSelect
     * @dataProvider provide_formSelect
     */
    public function test_formSelect ($expected, $name, $value = null, $attribs = null,
        $options = null, $listsep = "<br />\n")
    {
        $subject = new Rx_View_Helper_FormSelect;
        $view = new Zend_View;
        $subject->view = $view;

        $result = $subject->formSelect($name, $value, $attribs, $options, $listsep);

        $this->assertEquals($expected, $result);

    } // END function test_formSelect

    /**
     * provide_formSelect()
     *
     * Provides data to use for testing the formSelect method of
     * the Tests_Rx_View_Helper_FormSelectTest class
     *
     * @return array
     */
    public function provide_formSelect ( )
    {
        return array(
            'simple test' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="field"><div class="picker"><select name="name" id="name">',
                    '    ',
                    '</select></div></li></ul>',
                )),
                'name',
                'value',
            ),

            'multiple test' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="field"><div class="picker"><select name="name[]" id="name" multiple="multiple">',
                    '    ',
                    '</select></div></li></ul>',
                )),
                'name[]',
                'value',
            ),

            'another multiple test' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="field"><div class="picker"><select name="name[]" id="name" multiple="multiple">',
                    '    ',
                    '</select></div></li></ul>',
                )),
                'name',
                'value',
                array(
                    'multiple' => true,
                )
            ),
            'another multiple test, but false this time' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="field"><div class="picker"><select name="name" id="name">',
                    '    ',
                    '</select></div></li></ul>',
                )),
                'name',
                'value',
                array(
                    'multiple' => false,
                )
            ),

            'disable test' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="field"><div class="picker"><select name="name" id="name" disabled="disabled">',
                    '    ',
                    '</select></div></li></ul>',
                )),
                'name',
                'value',
                array(
                    'disable' => true,
                )
            ),

            'simple options test' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="field"><div class="picker"><select name="name" id="name">',
                    '    <option value="value1" label="label1">label1</option>',
                    '</select></div></li></ul>',
                )),
                'name',
                'value',
                null,
                array(
                    'value1' => 'label1',
                ),
            ),

            'simple options test with current value' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="field"><div class="picker"><select name="name" id="name">',
                    '    <option value="value1" label="label1" selected="selected">label1</option>',
                    '</select></div></li></ul>',
                )),
                'name',
                'value1',
                null,
                array(
                    'value1' => 'label1',
                ),
            ),

            'simple options with group test' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="field"><div class="picker"><select name="name" id="name">',
                    '    <optgroup id="name-optgroup-group1" label="group1">',
                    '    <option value="value1" label="label1">label1</option>',
                    '    </optgroup>',
                    '</select></div></li></ul>',

                )),
                'name',
                'value',
                null,
                array(
                    'group1' => array('value1' => 'label1'),
                ),
            ),

            'simple options with group test and disabled option' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="field"><div class="picker"><select name="name" id="name">',
                    '    <optgroup id="name-optgroup-group1" label="group1">',
                    '    <option value="value1" label="label1" disabled="disabled">label1</option>',
                    '    </optgroup>',
                    '</select></div></li></ul>',
                )),
                'name',
                'value',
                array(
                    'disable' => array(
                        'value1',
                    ),
                ),
                array(
                    'group1' => array('value1' => 'label1'),
                ),
            ),

            'simple options with group test and disabled group' =>array(
                implode(PHP_EOL, array(
                    '<ul class="picker"><li class="field"><div class="picker"><select name="name" id="name">',
                    '    <optgroup disabled="disabled" id="name-optgroup-group1" label="group1">',
                    '    <option value="value1" label="label1">label1</option>',
                    '    </optgroup>',
                    '</select></div></li></ul>',

                )),
                'name',
                'value',
                array(
                    'disable' => array(
                        'group1',
                    ),
                ),
                array(
                    'group1' => array('value1' => 'label1'),
                ),
            ),
        );

    } // END function provide_formSelect

} // END class Tests_Rx_View_Helper_FormSelectTest