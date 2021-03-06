<?php
/**
 * Unit Test Suite for the Leaderboard class
 *
 * This unit test suite should test all of the custom functionality provided by
 * the App_Model_Leaderboard class
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
 * Unit Test Suite for the Leaderboard
 *
 * This unit test suite should test all of the custom functionality provided by
 * the App_Model_Leaderboard class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Model_LeaderboardTest
    extends Rx_PHPUnit_TestCase
{

    /**
     * test__getEventModel()
     *
     * Tests the _getEventModel method of the App_Model_Leaderboard class
     *
     * @covers App_Model_Leaderboard::_getEventModel
     */
    public function test__getEventModel ( )
    {
        $subject = new App_Model_Leaderboard;

        $result = $this->getMethod('App_Model_Leaderboard', '_getEventModel')->invoke($subject);

        $this->assertInstanceOf('App_Model_Event', $result);

    } // END function test__getEventModel

    /**
     * test__sortAthleteResults()
     *
     * Tests the _sortAthleteResults method of the App_Model_Leaderboard class
     *
     * @covers App_Model_Leaderboard::_sortAthleteResults
     * @dataProvider provide__sortAthleteResults
     */
    public function test__sortAthleteResults ($expected, $athletes)
    {
        $subject = new App_Model_Leaderboard;

        $result = $this->getMethod('App_Model_Leaderboard', '_sortAthleteResults')
            ->invoke($subject, $athletes);

        $this->assertEquals($expected, $result);

    } // END function test__sortAthleteResults

    /**
     * provide__sortAthleteResults()
     *
     * Provides data to use for testing the _sortAthleteResults method of
     * the App_Model_Leaderboard class
     *
     * @return array
     */
    public function provide__sortAthleteResults ( )
    {
        return array(
            '2 athletes' => array(
                'expected' => array(
                    0 => array(
                        'id' => 1,
                        'points' => 30,
                    ),
                    1 => array(
                        'id' => 2,
                        'points' => 50,
                    ),
                ),
                'athletes' => array(
                    2 => array(
                        'id' => 1,
                        'points' => 30,
                    ),
                    1 => array(
                        'id' => 2,
                        'points' => 50,
                    ),
                )
            ),
        );

    } // END function provide__sortAthleteResults

    /**
     * test__mergeAthleteResults()
     *
     * Tests the _mergeAthleteResults method of the App_Model_Leaderboard class
     *
     * @covers App_Model_Leaderboard::_mergeAthleteResults
     * @dataProvider provide__mergeAthleteResults
     */
    public function test__mergeAthleteResults ($expected, $athletes, $id,
        $competitionFilters = array(), $data = array())
    {
        $subject = new App_Model_Leaderboard;

        $result = $this->getMethod('App_Model_Leaderboard', '_mergeAthleteResults')
            ->invoke($subject, $athletes, $id, $competitionFilters, $data);

        $this->assertEquals($expected, $result);

    } // END function test__mergeAthleteResults

    /**
     * provide__mergeAthleteResults()
     *
     * Provides data to use for testing the _mergeAthleteResults method of
     * the App_Model_Leaderboard class
     *
     * @return array
     */
    public function provide__mergeAthleteResults ( )
    {
            // 'points' => $data['points'],
            // 'score_id' => @$data['id'],
            // 'athlete_id'    => @$data['athlete_id'],
            // 'competition_id'    => $data['competition_id'],
            // 'placeholder_score' => @$data['placeholder_score'],
        return array(
            'no existing athletes' => array(
                'expected'  => array(
                    100 => array(
                        'points'        => 80,
                        'athlete_id'    => 100,
                        'competitions'  => array(
                            2 => array(
                                'goal'      => 'time',
                                'score'     => 500,
                                'rank'      => 3,
                                'points'    => 80,
                                'score_id'  => 1,
                                'placeholder_score' => null,
                                'athlete_id'    => 100,
                                'competition_id'    => 2,
                            ),
                        ),
                    ),
                ),
                'athletes'  => array(),
                'id'        => 100,
                'filters'   => array(),
                'data'      => array(
                    'id'                => 1,
                    'score'             => 500,
                    'rank'              => 3,
                    'points'            => 80,
                    'competition_id'    => 2,
                    'athlete_id'        => 100,
                ),
            ),

            '1 existing athlete, but not the same one' => array(
                'expected'  => array(
                    200 => array(
                        'points'        => 90,
                        'athlete_id'    => 200,
                        'competitions'  => array(
                            2 => array(
                                'goal'      => 'time',
                                'score'     => 600,
                                'rank'      => 2,
                                'points'    => 90,
                                'athlete_id'=> 200,
                                'competition_id'=> 2,
                            ),
                        ),
                    ),
                    100 => array(
                        'points'        => 80,
                        'athlete_id'=> 100,
                        'competitions'  => array(
                            2 => array(
                                'goal'      => 'time',
                                'score'     => 500,
                                'rank'      => 3,
                                'points'    => 80,
                                'score_id'  => 1,
                                'athlete_id'=> 100,
                                'placeholder_score' => null,
                                'competition_id'=> 2,
                            ),
                        ),
                    ),
                ),
                'athletes'  => array(
                    200 => array(
                        'points'        => 90,
                        'athlete_id'    => 200,
                        'competitions'  => array(
                            2 => array(
                                'goal'      => 'time',
                                'score'     => 600,
                                'rank'      => 2,
                                'points'    => 90,
                                'athlete_id'=> 200,
                                'competition_id'=> 2,
                            ),
                        ),
                    ),
                ),
                'id'        => 100,
                'filters'   => array(),
                'data'      => array(
                    'id'                => 1,
                    'score'             => 500,
                    'rank'              => 3,
                    'points'            => 80,
                    'competition_id'    => 2,
                    'athlete_id'        => 100,
                ),
            ),

            '2 existing athletes, one is the same' => array(
                'expected'  => array(
                    200 => array(
                        'points'        => 90,
                        'athlete_id'    => 200,
                        'competitions'  => array(
                            2 => array(
                                'goal'      => 'time',
                                'score'     => 600,
                                'rank'      => 2,
                                'points'    => 90,
                                'athlete_id'=> 200,
                                'competition_id'=> 2,
                            ),
                        ),
                    ),
                    100 => array(
                        'points'        => 130.0,
                        'athlete_id'    => 100,
                        'competitions'  => array(
                            2 => array(
                                'goal'      => 'time',
                                'score'     => 500,
                                'rank'      => 3,
                                'points'    => 80,
                                'athlete_id'=> 100,
                                'competition_id'=> 2,
                            ),
                            3 => array(
                                'goal'      => 'time',
                                'score'     => 200,
                                'rank'      => 6,
                                'points'    => 50,
                                'score_id'  => 1,
                                'placeholder_score' => null,
                                'athlete_id'=> 100,
                                'competition_id'=> 3,
                            ),
                        ),
                    ),
                ),
                'athletes'  => array(
                    200 => array(
                        'points'        => 90,
                        'athlete_id'    => 200,
                        'competitions'  => array(
                            2 => array(
                                'goal'      => 'time',
                                'score'     => 600,
                                'rank'      => 2,
                                'points'    => 90,
                                'athlete_id'=> 200,
                                'competition_id'=> 2,
                            ),
                        ),
                    ),
                    100 => array(
                        'points'        => 80,
                        'athlete_id'    => 100,
                        'competitions'  => array(
                            2 => array(
                                'goal'      => 'time',
                                'score'     => 500,
                                'rank'      => 3,
                                'points'    => 80,
                                'athlete_id'=> 100,
                                'competition_id'=> 2,
                            ),
                        ),
                    ),
                ),
                'id'        => 100,
                'filters'   => array(),
                'data'      => array(
                    'id'                => 1,
                    'score'             => 200,
                    'rank'              => 6,
                    'points'            => 50,
                    'competition_id'    => 3,
                    'athlete_id'        => 100,
                ),
            ),
        );

    } // END function provide__mergeAthleteResults


} // END class Tests_App_Model_LeaderboardTest