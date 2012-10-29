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
    public function test_injectDependencies ($athletes = array(), $competitions = array(), $params = array())
    {
        $select = $this->getMockBuilder('Zend_Db_Table_Select')
            ->disableOriginalConstructor()
            ->getMock();

        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getParent'))
            ->disableOriginalConstructor()
            ->getMock();

        $athleteModel = $this->getMockBuilder('App_Model_Athlete')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $competitionModel = $this->getMockBuilder('App_Model_Competition')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $athleteTable = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('fetchAll', 'buildWhere'))
            ->disableOriginalConstructor()
            ->getMock();

        $competitionTable = $this->getMockBuilder('Rx_Model_DbTable_Abstract')
            ->setMethods(array('fetchAll', 'buildWhere'))
            ->disableOriginalConstructor()
            ->getMock();

        $athleteTable->expects($this->once())
            ->method('buildWhere')
            ->with($this->equalTo($params))
            ->will($this->returnValue($select));

        $competitionTable->expects($this->once())
            ->method('buildWhere')
            ->with($this->equalTo($params))
            ->will($this->returnValue($select));

        $athleteElement = $this->getMockBuilder('Zend_Form_Element_Select')
            ->setMethods(array('addMultiOption'))
            ->disableOriginalConstructor()
            ->getMock();

        $competitionElement = $this->getMockBuilder('Zend_Form_Element_Select')
            ->setMethods(array('addMultiOption'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject = $this->getMockBuilder('App_Form_Score')
            ->setMethods(array('getElement'))
            ->disableOriginalConstructor()
            ->getMock();

        $athleteElement->expects($this->exactly(count($athletes)))
            ->method('addMultiOption');

        $competitionElement->expects($this->exactly(count($competitions)))
            ->method('addMultiOption');

        $subject->expects($this->any())
            ->method('getElement')
            ->will($this->returnValueMap(array(
                array('athlete_id', $athleteElement),
                array('competition_id', $competitionElement),
            )));

        $athleteTable->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo($select))
            ->will($this->returnValue($athletes));

        $competitionTable->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo($select))
            ->will($this->returnValue($competitions));

        $athleteModel->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($athleteTable));

        $competitionModel->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($competitionTable));

        $model->expects($this->any())
            ->method('getParent')
            ->will($this->returnValueMap(array(
                array('Athlete', $athleteModel),
                array('Competition', $competitionModel),
            )));

        $subject->injectDependencies($model, $params);

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
            'no data' => array(),

            '1 athlete' => array(
                array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'Jim Bob',
                    ),
                ),
            ),

            '2 athletes' => array(
                array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'Jim Bob',
                    ),
                    (object)array(
                        'id'    => 2,
                        'name'  => 'Jim Bimb',
                    ),
                ),
            ),

            '1 competition' => array(
                array(),
                array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'A Competition',
                    ),
                ),
            ),

            '2 competitions' => array(
                array(),
                array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'A Competition',
                    ),
                    (object)array(
                        'id'    => 2,
                        'name'  => 'Another Competition',
                    ),
                ),
            ),

            '1 athlete, 1 competition' => array(
                array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'Jim Bob',
                    ),
                ),
                array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'A Competition',
                    ),
                ),
            ),

            '2 athletes, 2 competitions' => array(
                array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'Jim Bob',
                    ),
                    (object)array(
                        'id'    => 2,
                        'name'  => 'Jim Bimb',
                    ),
                ),
                array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'A Competition',
                    ),
                    (object)array(
                        'id'    => 2,
                        'name'  => 'Another Competition',
                    ),
                ),
            ),
        );

    } // END function provide_injectDependencies

} // END class Tests_1.0.0_Competition