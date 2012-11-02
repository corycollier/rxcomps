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
     * event()
     *
     * Returns the aggregate results of an event's competitions leaderboard results
     *
     * @todo Make this not horrible
     * @param integer $eventId
     * @return array
     */
    public function load ($eventId, $scaleId)
    {
        $event = $this->_getEventModel();
        $table = $this->getEventTable();
        $row = $table->fetchRow(sprintf('id = %d', $eventId));
        $event->fromRow($row);

        $competitions = $event->getChildren('Competition');

        $results = array();
        foreach ($competitions as $competition) {
            $results[$competition->id] = $competition->getLeaderboards($scaleId);
        }

        $athletes = array();
        foreach ($results as $competitionId => $competitionResults) {
            foreach ($competitionResults as $athleteId => $athleteResults) {
                if (! array_key_exists($athleteId, $athletes)) {
                    $athletes[$athleteId] = $athleteResults;
                    $athletes[$athleteId]['competitions'] = array();

                } else {
                    $athletes[$athleteId]['points'] = (int)($athletes[$athleteId]['points'] + $athleteResults['points']);
                }

                $athletes[$athleteId]['competitions'][$athleteResults['competition_id']] = array(
                    'score' => $athleteResults['score'],
                    'rank'  => $athleteResults['rank'],
                );

                unset($athletes[$athleteId]['competition_id']);
                unset($athletes[$athleteId]['rank']);
                unset($athletes[$athleteId]['score']);
            }
        }

        // var_dump($athletes); die;

        // remove the numeric index
        sort($athletes);

        // create a sorting index
        $sortingIndex = array();
        foreach ($athletes as $athleteId => $athleteResults) {
            $sortingIndex[$athleteId] = (int)$athleteResults['points'];
        }

        array_multisort($sortingIndex, SORT_DESC, $athletes);

        return $athletes;

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