<?php
/**
 * Score Form Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Score Form class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Score Form Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the Score Form class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Form_Score
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_init()
     *
     * Tests the init of the App_Form_Score
     *
     * @covers App_Form_Score::init
     */
    public function test_init ( )
    {
        $form = new App_Form_Score;

        $score = $form->getElement('score');
        $athlete = $form->getElement('athlete_id');
        $competition = $form->getElement('competition_id');
        $save = $form->getElement('save');

        $this->assertInstanceOf('Zend_Form_Element_Text', $score);
        $this->assertInstanceOf('Zend_Form_Element_Select', $athlete);
        $this->assertInstanceOf('Zend_Form_Element_Select', $competition);
        $this->assertInstanceOf('Zend_Form_Element_Submit', $save);

        $this->assertEquals('Score', $score->getLabel());
        $this->assertEquals('Athlete', $athlete->getLabel());
        $this->assertEquals('Competition', $competition->getLabel());
        $this->assertEquals('Save', $save->getLabel());

    } // END function test_init

    /**
     * test_injectDependencies()
     *
     * Tests the injectDependencies method of the App_Form_Score class
     *
     * @covers App_Form_Score::injectDependencies
     * @dataProvider provide_injectDependencies
     */
    public function test_injectDependencies ($events = array())
    {

    } // END function test_injectDependencies

    /**
     * provide_injectDependencies()
     *
     * Provides data to use for testing the injectDependencies method of
     * the App_Form_Score class
     *
     * @return array
     */
    public function provide_injectDependencies ( )
    {
        return array(
            'no events' => array(),

            '1 event' => array(array(
                (object)array(
                    'id'    => 1,
                    'name'  => 'value',
                ),
            )),

            '2 events' => array(array(
                (object)array(
                    'id'    => 1,
                    'name'  => 'value',
                ),
                (object)array(
                    'id'    => 1,
                    'name'  => 'value',
                ),
            )),
        );

    } // END function provide_injectDependencies

} // END class Tests_1.0.0_Competition