<?php
/**
 * Leaderboard model
 *
 * This is the leaderboard model, which doesn't have a dbTable directly
 * associated with it
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Leaderboard model
 *
 * This is the leaderboard model, which doesn't have a dbTable directly
 * associated with it
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_Leaderboard
{
    /**
     * getScoreTable()
     *
     * Gets an instance of the score table class
     *
     * @return App_Model_DbTable_Score
     */
    public function getScoreTable ( )
    {
        return new App_Model_DbTable_Score;

    } // END function getScoreTable

    /**
     * getCompetitionTable()
     *
     * Gets an instance of the competition table class
     *
     * @return App_Model_DbTable_Competition
     */
    public function getCompetitionTable ( )
    {
        return new App_Model_DbTable_Competition;

    } // END function getCompetitionTable

    /**
     * load()
     *
     * Loads up the leaderboards for a given competition
     *
     * @param integer $competitionId
     * @return Zend_Db_Table_Rowset $this for object chaining
     */
    public function load ($competitionId)
    {
        $table = $this->getScoreTable();

        return $table->fetchAll(
            $table->select()
                ->where(sprintf('competition_id = %d', $competitionId))
                ->order('score DESC')
        );

    } // END function load

    /**
     * event()
     *
     * Returns the aggregate results of an event's competitions leaderboard results
     *
     * @param integer $eventId
     * @return array
     */
    public function event ($eventId)
    {
        $table = $this->getCompetitionTable();

        $competitions = $table->fetchAll(
            $table->select()
                ->where(sprintf('event_id = %d', $eventId))

        );

        var_dump($competitions); die;

    } // END function event

} // END class App_Model_Leaderboard