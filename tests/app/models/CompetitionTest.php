<?php
/**
 * Unit Test Suite for the Competition class
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Model_Competition class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the Competition
 *
 * This unit test should test all of the custom functionality provided by the
 * App_Model_Competition class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Model_CompetitionTest
    extends Rx_PHPUnit_TestCase
{

    /**
     * test_create()
     *
     * Tests the create method of the App_Model_Competition class
     *
     * @covers App_Model_Competition::create
     * @dataProvider provide_create
     */
    public function test_create ($values)
    {
        $subject = $this->getMockBuilder('App_Model_Competition')
            ->setMethods(array('_create', '_saveScoring'))
            ->disableOriginalConstructor()
            ->getMock();

        $created = new Zend_Date;
        $modified = $values;
        $modified['created'] = $created;
        $modified['updated'] = $created;

        $subject->expects($this->once())
            ->method('_create')
            ->with($this->equalTo($modified))
            ->will($this->returnSelf());

        if (@$values['scoring_type'] == 'points') {
            $subject->expects($this->once())
                ->method('_saveScoring')
                ->with($this->equalTo(@$values['scoring']));
        }

        $result = $subject->create($values);

        $this->assertSame($subject, $result);

    } // END function test_create

    /**
     * provide_create()
     *
     * Provides data to use for testing the create method of
     * the App_Model_Competition class
     *
     * @return array
     */
    public function provide_create ( )
    {
        return array(
            array(array(
                'stuff' => 'value',
            )),
        );

    } // END function provide_create

    /**
     * test_edit()
     *
     * Tests the edit method of the App_Model_Competition class
     *
     * @covers App_Model_Competition::edit
     * @dataProvider provide_edit
     */
    public function test_edit ($values = array())
    {
        $subject = $this->getMockBuilder('App_Model_Competition')
            ->setMethods(array('_edit', '_saveScoring'))
            ->disableOriginalConstructor()
            ->getMock();

        $updated = new Zend_Date;
        $modified = $values;
        $modified['updated'] = $updated;

        $subject->expects($this->once())
            ->method('_edit')
            ->with($this->equalTo($modified))
            ->will($this->returnSelf());

        if (@$values['scoring_type'] == 'points') {
            $subject->expects($this->once())
                ->method('_saveScoring')
                ->with($this->equalTo(@$values['scoring']));
        }

        $result = $subject->edit($values);

        $this->assertSame($subject, $result);

    } // END function test_edit

    /**
     * provide_edit()
     *
     * Provides data to use for testing the edit method of
     * the App_Model_Competition class
     *
     * @return array
     */
    public function provide_edit ( )
    {
        return array(
            array(array(
                'stuff' => 'value',
            )),
        );

    } // END function provide_edit

    /**
     * test_getScores()
     *
     * Tests the getScores of the App_Model_Competition
     *
     * @covers          App_Model_Competition::getScores
     * @dataProvider    provide_getScores
     */
    public function test_getScores ($expected, $scaleId, $id, $order, $gender, $athleteIds = array())
    {
        $table  = $this->getBuiltMock('Zend_Db_Table', array(
            'fetchAll', 'select', 'toArray'
        ));
        $subject = $this->getBuiltMock('App_Model_Competition', array(
            'getTable', 'getAthleteIds', '_getOrder', 'getWorstScore'
        ));
        $select = $this->getBuiltMock('Zend_Db_Table_Select', array(
            'where', 'order'
        ));
        $rowset = $this->getBuiltMock('Zend_Db_Table_Rowset', array('toArray'));

        $subject->id = $id;

        $subject->expects($this->once())
            ->method('getAthleteIds')
            ->with($this->equalTo($scaleId))
            ->will($this->returnValue($athleteIds));

        $select->expects($this->once())
            ->method('order')
            ->with($this->equalTo($order))
            ->will($this->returnSelf());

        $select->expects($this->any())
            ->method('where')
            ->will($this->returnSelf());
            // ->will($this->returnValueMap(array(
            //     array(sprintf("scores.competition_id = '%d'", $id), $select),
            //     array('scores.athlete_id IN (?)', $athleteIds, $select),
            // )));

        $rowset->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($expected));

        $table->expects($this->once())
            ->method('select')
            ->with($this->equalTo(Zend_Db_Table::SELECT_WITH_FROM_PART))
            ->will($this->returnValue($select));

        $table->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo($select))
            ->will($this->returnValue($rowset));

        $subject->expects($this->once())
            ->method('getTable')
            ->with($this->equalTo('Score'))
            ->will($this->returnValue($table));

        $subject->expects($this->once())
            ->method('_getOrder')
            ->will($this->returnValue($order));

        $result = $subject->getScores($scaleId, $gender);

        $this->assertEquals($expected, $result);

    } // END function test_getScores

    /**
     * provide_getScores()
     *
     * Provides data for the getScores method of the
     * App_Model_Competition class
     */
    public function provide_getScores ( )
    {
        return array(
            'athleteIds found' => array(
                array(100, 200),
                1,
                1,
                'order',
                'male',
                array(1, 2),
            ),
            'no athleteIds found' => array(
                array(),
                1,
                1,
                'order',
                'male',
                null,
            ),


        );

    } // END function provide_getScores

    /**
     * test_getPoints()
     *
     * Tests the getPoints of the App_Model_Competition
     *
     * @covers          App_Model_Competition::getPoints
     * @dataProvider    provide_getPoints
     */
    public function test_getPoints ($expected, $scoringType, $id, $scores = array(), $scoring = null)
    {
        $subject = $this->getBuiltMock('App_Model_Competition', array('getTable', 'getScoringType'));

        $subject->id = $id;

        $subject->expects($this->once())
            ->method('getScoringType')
            ->will($this->returnValue($scoringType));

        if ($scoringType == 'points') {
            $table  = $this->getBuiltMock('Zend_Db_Table', array('fetchRow'));
            $table->expects($this->once())
                ->method('fetchRow')
                ->with($this->equalTo(sprintf('competition_id = %d', $id)))
                ->will($this->returnValue($scoring));

            $subject->expects($this->once())
                ->method('getTable')
                ->with($this->equalTo('Scoring'))
                ->will($this->returnValue($table));
        }

        $result = $subject->getPoints($scores);


        $this->assertEquals($expected, $result);

    } // END function test_getPoints

    /**
     * provide_getPoints()
     *
     * Provides data for the getPoints method of the
     * App_Model_Competition class
     */
    public function provide_getPoints ( )
    {
        return array(
            'points test' => array(
                range(0, 100, 10),
                'points',
                1,
                range(1, 5),
                (object)array('definition' => implode(PHP_EOL, range(0, 100, 10)))
            ),

            'non-points test' => array(
                range(1, count(range(1, 5))),
                'anything else',
                1,
                range(1, 5),
                (object)array('definition' => implode(PHP_EOL, range(0, 100, 10)))
            ),

        );

    } // END function provide_getPoints

    /**
     * test_getScoringType()
     *
     * Tests the getScoringType of the App_Model_Competition
     *
     * @covers          App_Model_Competition::getScoringType
     * @dataProvider    provide_getScoringType
     */
    public function test_getScoringType ($expected, $scoring, $id)
    {
        $table  = $this->getBuiltMock('Zend_Db_Table', array('fetchRow'));
        $subject = $this->getBuiltMock('App_Model_Competition', array('getTable'));

        $table->expects($this->once())
            ->method('fetchRow')
            ->with($this->equalTo(sprintf('competition_id = %d', $id)))
            ->will($this->returnValue($scoring));

        $subject->id = $id;

        $subject->expects($this->once())
            ->method('getTable')
            ->with($this->equalTo('Scoring'))
            ->will($this->returnValue($table));

        $result = $subject->getScoringType();

        $this->assertEquals($expected, $result);

    } // END function test_getScoringType

    /**
     * provide_getScoringType()
     *
     * Provides data for the getScoringType method of the
     * App_Model_Competition class
     */
    public function provide_getScoringType ( )
    {
        return array(
            array('points', true, 1),
            array('rank', false, 1),
        );

    } // END function provide_getScoringType

    /**
     * test__getOrder()
     *
     * Tests the _getOrder of the App_Model_Competition
     *
     * @covers          App_Model_Competition::_getOrder
     * @dataProvider    provide__getOrder
     */
    public function test__getOrder ($expected, $goal)
    {
        $subject = $this->getBuiltMock('App_Model_Competition', array('getValue'));

        $subject->expects($this->once())
            ->method('getValue')
            ->with($this->equalTo('goal'))
            ->will($this->returnValue($goal));

        $result = $this->getMethod('App_Model_Competition', '_getOrder')->invoke($subject);

        $this->assertEquals($expected, $result);

    } // END function test__getOrder

    /**
     * provide__getOrder()
     *
     * Provides data for the _getOrder method of the
     * App_Model_Competition class
     */
    public function provide__getOrder ( )
    {
        return array(
            array('score ASC', 'time'),
            array('score DESC', 'blah'),
        );

    } // END function provide__getOrder

    /**
     * test_getAthleteIds()
     *
     * Tests the getAthleteIds of the App_Model_Competition
     *
     * @covers          App_Model_Competition::getAthleteIds
     * @dataProvider    provide_getAthleteIds
     */
    public function test_getAthleteIds ($expected, $athletes, $scaleId, $gender)
    {
        $subject = $this->getBuiltMock('App_Model_Competition', array('getAthletes'));

        $subject->expects($this->once())
            ->method('getAthletes')
            ->with($this->equalTo($scaleId), $this->equalTo($gender))
            ->will($this->returnValue($athletes));

        $result = $subject->getAthleteIds($scaleId, $gender);

        $this->assertEquals($expected, $result);

    } // END function test_getAthleteIds

    /**
     * provide_getAthleteIds()
     *
     * Provides data for the getAthleteIds method of the
     * App_Model_Competition class
     */
    public function provide_getAthleteIds ( )
    {
        return array(
            'simple 2 athlete test' => array(
                array(1, 4),
                array(
                    (object)array('id' => 1),
                    (object)array('id' => 4),
                ),
                1,
                'male',
            ),

        );

    } // END function provide_getAthleteIds

    /**
     * test_getLeaderboards()
     *
     * Tests the getLeaderboards of the App_Model_Competition
     *
     * @covers          App_Model_Competition::getLeaderboards
     * @dataProvider    provide_getLeaderboards
     */
    public function test_getLeaderboards ( )
    {
        /*
    public function getLeaderboards ($scaleId)
    {
        $scores     = $this->getScores($scaleId);
        $points     = $this->getPoints($scores);
        $results    = array();
        $pointValue = current($points);
        $scoreValue = 0;
        $rankValue  = 1;


        foreach ($scores as $i => $score) {
            print_r($score); die;

            if ($score['score'] != $scoreValue) {
                $scoreValue = $score['score'];
                $pointValue = $points[$i];
                $rankValue = $i + 1;
            }

            $results[$score['athlete_id']] = array_merge($score, array(
                'points'    => (int)$pointValue,
                'rank'      => (int)$rankValue,
            ));
        }

        // var_dump($results); die;
        return $results;

         */

        $subject    = $this->getBuiltMock('App_Model_Competition', array(
            'getScores', 'getPoints'
        ));


    } // END function test_getLeaderboards

    /**
     * provide_getLeaderboards()
     *
     * Provides data for the getLeaderboards method of the
     * App_Model_Competition class
     */
    public function provide_getLeaderboards ( )
    {
        return array(
            array(),
        );

    } // END function provide_getLeaderboards

} // END class Tests_App_Model_CompetitionTest