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
    public function test_injectDependencies ($params = array())
    {
        $model = $this->getMockBuilder('Rx_Model_Abstract')
            ->setMethods(array('getParent'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject = $this->getMockBuilder('App_Form_Score')
            ->setMethods(array('_insertAthletes', '_insertCompetitions'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('_insertAthletes')
            ->with($this->equalTo($model), $this->equalTo($params))
            ->will($this->returnSelf());

        $subject->expects($this->once())
            ->method('_insertCompetitions')
            ->with($this->equalTo($model), $this->equalTo($params))
            ->will($this->returnSelf());

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
            'no params' => array(),
        );

    } // END function provide_injectDependencies


    /**
     * test__insertCompetitions()
     *
     * Tests the _insertCompetitions method of the App_Form_Score class
     *
     * @covers App_Form_Score::_insertCompetitions
     * @dataProvider provide__insertCompetitions
     */
    public function test__insertCompetitions ($params = array(), $competitions = array())
    {
        $subject = $this->getMockBuilder('App_Form_Score')
            ->setMethods(array('getElement'))
            ->disableOriginalConstructor()
            ->getMock();

        $model = $this->getMockBuilder('App_Model_Score')
            ->setMethods(array('getParent'))
            ->disableOriginalConstructor()
            ->getMock();

        $competitionModel = $this->getMockBuilder('App_Model_Scale')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $table = $this->getMockBuilder('Zend_Db_Table_Abstract')
            ->setMethods(array('fetchAll', 'buildWhere'))
            ->disableOriginalConstructor()
            ->getMock();

        $element = $this->getMockBuilder('Zend_Form_Element_Select')
            ->setMethods(array('addMultiOption'))
            ->disableOriginalConstructor()
            ->getMock();

        $select = $this->getMockBuilder('Zend_Db_Table_Select')
            ->disableOriginalConstructor()
            ->getMock();

        $element->expects($this->exactly(count($competitions)))
            ->method('addMultiOption');

        $table->expects($this->once())
            ->method('buildWhere')
            ->with($this->equalTo($params))
            ->will($this->returnValue($select));

        $table->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo($select))
            ->will($this->returnValue($competitions));

        $competitionModel->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($table));

        $model->expects($this->once())
            ->method('getParent')
            ->with($this->equalTo('Competition'))
            ->will($this->returnValue($competitionModel));

        $subject->expects($this->once())
            ->method('getElement')
            ->with($this->equalTo('competition_id'))
            ->will($this->returnValue($element));

        $method = new ReflectionMethod('App_Form_Score', '_insertCompetitions');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $model, $params);

        $this->assertSame($subject, $result);

    } // END function test__insertEvents

    /**
     * provide__insertCompetitions()
     *
     * Provides data to use for testing the _insertEvents method of
     * the App_Form_Athlete class
     *
     * @return array
     */
    public function provide__insertCompetitions ( )
    {
        return array(
            'no params, no events' => array(
                array(), array(),
            ),

            'no params, 1 scale' => array(
                array(), array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'scale name',
                    )
                ),
            ),
        );

    } // END function provide__insertCompetitions


    /**
     * test__insertAthletes()
     *
     * Tests the _insertAthletes method of the App_Form_Score class
     *
     * @covers App_Form_Score::_insertAthletes
     * @dataProvider provide__insertAthletes
     */
    public function test__insertAthletes ($params = array(), $athletes = array())
    {
        $subject = $this->getMockBuilder('App_Form_Score')
            ->setMethods(array('getElement'))
            ->disableOriginalConstructor()
            ->getMock();

        $model = $this->getMockBuilder('App_Model_Score')
            ->setMethods(array('getParent'))
            ->disableOriginalConstructor()
            ->getMock();

        $athleteModel = $this->getMockBuilder('App_Model_Scale')
            ->setMethods(array('getTable'))
            ->disableOriginalConstructor()
            ->getMock();

        $table = $this->getMockBuilder('Zend_Db_Table_Abstract')
            ->setMethods(array('fetchAll', 'buildWhere'))
            ->disableOriginalConstructor()
            ->getMock();

        $element = $this->getMockBuilder('Zend_Form_Element_Select')
            ->setMethods(array('addMultiOption'))
            ->disableOriginalConstructor()
            ->getMock();

        $select = $this->getMockBuilder('Zend_Db_Table_Select')
            ->disableOriginalConstructor()
            ->getMock();

        $element->expects($this->exactly(count($athletes)))
            ->method('addMultiOption');

        $table->expects($this->once())
            ->method('buildWhere')
            ->with($this->equalTo($params))
            ->will($this->returnValue($select));

        $table->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo($select))
            ->will($this->returnValue($athletes));

        $athleteModel->expects($this->once())
            ->method('getTable')
            ->will($this->returnValue($table));

        $model->expects($this->once())
            ->method('getParent')
            ->with($this->equalTo('Athlete'))
            ->will($this->returnValue($athleteModel));

        $subject->expects($this->once())
            ->method('getElement')
            ->with($this->equalTo('athlete_id'))
            ->will($this->returnValue($element));

        $method = new ReflectionMethod('App_Form_Score', '_insertAthletes');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $model, $params);

        $this->assertSame($subject, $result);

    } // END function test__insertAthletes

    /**
     * provide__insertAthletes()
     *
     * Provides data to use for testing the _insertAthletes method of
     * the App_Form_Athlete class
     *
     * @return array
     */
    public function provide__insertAthletes( )
    {
        return array(
            'no params, no events' => array(
                array(), array(),
            ),

            'no params, 1 athlete' => array(
                array(), array(
                    (object)array(
                        'id'    => 1,
                        'name'  => 'athlete name',
                    )
                ),
            ),
        );

    } // END function provide__insertAthletes

} // END class Tests_1.0.0_Competition