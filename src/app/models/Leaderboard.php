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
     * getAthletesTable()
     *
     * Gets an instance of the athlete table class
     *
     * @return App_Model_DbTable_Competition
     */
    public function getAthletesTable ( )
    {
        return new App_Model_DbTable_Athlete;

    } // END function getAthletesTable

    /**
     * getEventTable()
     *
     * Gets an instance of the event table class
     *
     * @return App_Model_DbTable_Competition
     */
    public function getEventTable ( )
    {
        return new App_Model_DbTable_Event;

    } // END function getEventTable

    /**
     * load()
     *
     * Loads up the leaderboards for a given competition
     *
     * @param integer $competitionId
     * @return Zend_Db_Table_Rowset $this for object chaining
     */
    public function load ($competitionId, $scaleId)
    {
        $table = $this->getScoreTable();

        return $table->fetchAll(
            $table->select()
                ->where(sprintf('competition_id = %d', $competitionId))
                ->where('athlete_id IN (?)', $this->getAthleteIds($scaleId))
                ->order('score DESC')
        );

    } // END function load

    /**
     * getAthleteIds()
     *
     * Gets the athlete identifiers for a given scale Id
     *
     * @param integer $scaleId
     * @return array
     */
    public function getAthleteIds ($scaleId)
    {
        $table = $this->getAthletesTable();
        $athletes = $table->fetchAll(
            $table->select()
                ->where(sprintf('scale_id = %d', $scaleId))
        );

        $results = array();
        foreach ($athletes as $athlete) {
            $results[] = $athlete->id;
        }

        return $results;
    }

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
        $event = $this->_getEventModel();
        $table = $this->getEventTable();
        $row = $table->fetchRow(sprintf('id = %d', $eventId));
        $event->fromRow($row);

        $competitions = $event->getChildren('Competition');

        $results = array();
        foreach ($competitions as $competition) {
            $results[$competition->id] = $competition->getLeaderboards();
        }

        print_r($results); die;


    } // END function event

    /**
     * _getEventModel()
     *
     * Gets a new instance of the event model
     *
     * @return
     */
    protected function _getEventModel ( )
    {
        return new App_Model_Event;

    } // END function _getEventModel

} // END class App_Model_Leaderboard