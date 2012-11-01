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
     * test_getScoreTable()
     *
     * Tests the getScoreTable method of the App_Model_Leaderboard class
     *
     * @covers App_Model_Leaderboard::getScoreTable
     */
    public function test_getScoreTable ( )
    {
        $subject = new App_Model_Leaderboard;

        $result = $subject->getScoreTable();

        $this->assertInstanceOf('App_Model_DbTable_Score', $result);

    } // END function test_getScoreTable

    /**
     * test_getCompetitionTable()
     *
     * Tests the getCompetitionTable method of the App_Model_Leaderboard class
     *
     * @covers App_Model_Leaderboard::getCompetitionTable
     */
    public function test_getCompetitionTable ( )
    {
        $subject = new App_Model_Leaderboard;

        $result = $subject->getCompetitionTable();

        $this->assertInstanceOf('App_Model_DbTable_Competition', $result);

    } // END function test_getCompetitionTable

    /**
     * test_getAthletesTable()
     *
     * Tests the getAthletesTable method of the App_Model_Leaderboard class
     *
     * @covers App_Model_Leaderboard::getAthletesTable
     */
    public function test_getAthletesTable ( )
    {
        $subject = new App_Model_Leaderboard;

        $result = $subject->getAthletesTable();

        $this->assertInstanceOf('App_Model_DbTable_Athlete', $result);

    } // END function test_getAthletesTable


} // END class Tests_App_Model_LeaderboardTest