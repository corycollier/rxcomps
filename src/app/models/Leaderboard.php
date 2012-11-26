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
     *  Message to indicate an exception due to invalid data
     */
    const EXCEPTION_INVALID_DATA = 'Invalid Data Exception. Missing %s';

    /**
     * event()
     *
     * Returns the aggregate results of an event's competitions leaderboard results
     *
     * @todo Make this not horrible
     * @param integer $eventId
     * @return array
     */
    public function load ($eventId, $scaleId, $competitionFilters = '')
    {
        $event = $this->_getEventModel();
        $event->load($eventId);

        $competitionFilters = explode(',', trim($competitionFilters));

        $competitions = $event->getChildren('Competition');

        $results = array();
        foreach ($competitions as $competition) {
            $results[$competition->id] = $competition->getLeaderboards($scaleId);
        }

        $athletes = array();
        foreach ($results as $competitionId => $competitionResults) {
            foreach ($competitionResults as $athleteId => $athleteResults) {
                $athletes = $this->_mergeAthleteResults(
                    $athletes,
                    $athleteId,
                    $competitionFilters,
                    $athleteResults
                );
            }
        }

        return $this->_sortAthleteResults($athletes);

    } // END function event

    /**
     * _mergeAthleteResults()
     *
     * Merges the current results (id, and data) into the rest of the results (athletes)
     *
     * @param array $athletes
     * @param string|integer $id
     * @param array $data
     * @return array
     */
    protected function _mergeAthleteResults ($athletes, $id,
        $competitionFilters = array(), $data = array())
    {

        if (! array_key_exists($id, $athletes)) {
            $athletes[$id] = $data;
            $athletes[$id]['competitions'] = array();
        } else {
            $athletes[$id]['points'] = (int)($athletes[$id]['points'] + $data['points']);
        }

        // if these results should be filtered ...
        if (in_array($data['competition_id'], $competitionFilters)) {
            $athletes[$id]['points'] = $athletes[$id]['points'] - $data['points'];
        }

        $athletes[$id]['competitions'][$data['competition_id']] = array(
            'score' => $data['score'],
            'rank'  => $data['rank'],
            'points' => $data['points'],
            'score_id' => $data['id'],
        );

        unset($athletes[$id]['competition_id']);
        unset($athletes[$id]['rank']);
        unset($athletes[$id]['score']);
        unset($athletes[$id]['id']);

        return $athletes;

    } // END function _mergeAthleteResults

    /**
     * _sortAthleteResults()
     *
     * Sorts the athlete results information by points (in descending order)
     *
     * @param array $athletes
     * @return array
     */
    protected function _sortAthleteResults ($athletes)
    {
        // remove the numeric index
        sort($athletes);

        // create a sorting index
        $sortingIndex = array();
        foreach ($athletes as $i => $athleteResults) {
            $sortingIndex[$i] = (int)$athleteResults['points'];
        }

        array_multisort($sortingIndex, SORT_DESC, $athletes);

        return $athletes;

    } // END function _sortAthleteResults

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