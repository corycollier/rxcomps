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
    extends PHPUnit_Framework_TestCase
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

        $method = new ReflectionMethod('App_Model_Leaderboard', '_getEventModel');
        $method->setAccessible(true);

        $result = $method->invoke($subject);

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

        $method = new ReflectionMethod('App_Model_Leaderboard', '_sortAthleteResults');
        $method->setAccessible(true);
        $results = $method->invoke($subject, $athletes);

        $this->assertEquals($expected, $results);

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
                        'id' => 2,
                        'points' => 50,
                    ),
                    1 => array(
                        'id' => 1,
                        'points' => 30,
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
    public function test__mergeAthleteResults ($expected, $athletes, $id, $data = array())
    {
        $subject = new App_Model_Leaderboard;

        $method = new ReflectionMethod('App_Model_Leaderboard', '_mergeAthleteResults');
        $method->setAccessible(true);
        $results = $method->invoke($subject, $athletes, $id, $data);

        $this->assertEquals($expected, $results);

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
        return array(
            'no existing athletes' => array(
                'expected'  => array(
                    100 => array(
                        'points'        => 80,
                        'competitions'  => array(
                            2 => array(
                                'score'     => 500,
                                'rank'      => 3,
                                'points'    => 80,
                            ),
                        ),
                    ),
                ),
                'athletes'  => array(),
                'id'        => 100,
                'data'      => array(
                    'score'             => 500,
                    'rank'              => 3,
                    'points'            => 80,
                    'competition_id'    => 2,
                ),
            ),

            '1 existing athlete, but not the same one' => array(
                'expected'  => array(
                    200 => array(
                        'points'        => 90,
                        'competitions'  => array(
                            2 => array(
                                'score'     => 600,
                                'rank'      => 2,
                                'points'    => 90,
                            ),
                        ),
                    ),
                    100 => array(
                        'points'        => 80,
                        'competitions'  => array(
                            2 => array(
                                'score'     => 500,
                                'rank'      => 3,
                                'points'    => 80,
                            ),
                        ),
                    ),
                ),
                'athletes'  => array(
                    200 => array(
                        'points'        => 90,
                        'competitions'  => array(
                            2 => array(
                                'score'     => 600,
                                'rank'      => 2,
                                'points'    => 90,
                            ),
                        ),
                    ),
                ),
                'id'        => 100,
                'data'      => array(
                    'score'             => 500,
                    'rank'              => 3,
                    'points'            => 80,
                    'competition_id'    => 2,
                ),
            ),

            '2 existing athletes, one is the same' => array(
                'expected'  => array(
                    200 => array(
                        'points'        => 90,
                        'competitions'  => array(
                            2 => array(
                                'score'     => 600,
                                'rank'      => 2,
                                'points'    => 90,
                            ),
                        ),
                    ),
                    100 => array(
                        'points'        => 130,
                        'competitions'  => array(
                            2 => array(
                                'score'     => 500,
                                'rank'      => 3,
                                'points'    => 80,
                            ),
                            3 => array(
                                'score'     => 200,
                                'rank'      => 6,
                                'points'    => 50,
                            ),
                        ),
                    ),
                ),
                'athletes'  => array(
                    200 => array(
                        'points'        => 90,
                        'competitions'  => array(
                            2 => array(
                                'score'     => 600,
                                'rank'      => 2,
                                'points'    => 90,
                            ),
                        ),
                    ),
                    100 => array(
                        'points'        => 80,
                        'competitions'  => array(
                            2 => array(
                                'score'     => 500,
                                'rank'      => 3,
                                'points'    => 80,
                            ),
                        ),
                    ),
                ),
                'id'        => 100,
                'data'      => array(
                    'score'             => 200,
                    'rank'              => 6,
                    'points'            => 50,
                    'competition_id'    => 3,
                ),
            ),
        );

    } // END function provide__mergeAthleteResults


} // END class Tests_App_Model_LeaderboardTest