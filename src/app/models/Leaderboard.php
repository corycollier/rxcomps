<?php
/**
 * Leaderboard model
 *
 * This is the leaderboard model, which doesn't have a dbTable directly
 * associated with it
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
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
 * @category    RxComps
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_Leaderboard
    implements Zend_Acl_Resource_Interface
{
    /**
     *  Message to indicate an exception due to invalid data
     */
    const EXCEPTION_INVALID_DATA = 'Invalid Data Exception. Missing %s';

    public function load ( )
    {

    }

    /**
     * event()
     *
     * Returns the aggregate results of an event's competitions leaderboard results
     *
     * @todo Make this not horrible
     * @param integer $eventId
     * @return array
     */
    public function populate ($eventId, $scaleId, $gender = 'team', $competitionFilters = '')
    {
        $event = $this->_getEventModel();
        $event->load($eventId);

        $competitionFilters = explode(',', trim($competitionFilters));

        $competitions = $event->getChildren('Competition');

        $scoringType = 'points';
        if ($competitions) {
            if ($competition = current($competitions)) {
                $scoringType = $competition->getScoringType();
            }
        }

        $results = $this->getLeaderboardsFromCompetitions($competitions, $scaleId, $gender);

        $athletes = array();
        foreach ($results as $competitionId => $competitionResults) {
            $goal = 'time';
            foreach ($competitions as  $competition) {
                if ($competition->id == $competitionId) {
                    $goal = $competition->row->goal;
                }
            }

            foreach ($competitionResults as $athleteId => $athleteResults) {
                $athletes = $this->_mergeAthleteResults(
                    $athletes,
                    $athleteId,
                    $competitionFilters,
                    $athleteResults,
                    $goal
                );
            }
        }


        return $this->_sortAthleteResults($athletes, $scoringType);

    } // END function event

    /**
     * getLeaderboardsFromCompetitions()
     *
     * Gets the aggregate leaderboards from all competitions, for a given scale and gender
     *
     * @param array $competitions
     * @param string|integer $scaleId
     * @param string $gender
     * @return array
     */
    public function getLeaderboardsFromCompetitions ($competitions, $scaleId, $gender)
    {
        $results = array();
        foreach ($competitions as $competition) {
            $results[$competition->id] = $competition->getLeaderboards($scaleId, $gender);
        }

        return $results;

    } // END function getLeaderboardsFromCompetitions

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
        $competitionFilters = array(), $data = array(), $scoringType = 'time')
    {
        if (! array_key_exists($id, $athletes)) {
            $athletes[$id] = $data;
            $athletes[$id]['competitions'] = array();
        } else {
            $athletes[$id]['points'] = (float)($athletes[$id]['points'] + $data['points']);
        }

        // if these results should be filtered ...
        if (in_array($data['competition_id'], $competitionFilters)) {
            $athletes[$id]['points'] = $athletes[$id]['points'] - $data['points'];
        }

        $athletes[$id]['competitions'][$data['competition_id']] = array(
            'score' => $data['score'],
            'rank'  => $data['rank'],
            'points' => $data['points'],
            'score_id' => @$data['id'],
            'athlete_id'    => @$data['athlete_id'],
            'competition_id'    => $data['competition_id'],
            'placeholder_score' => @$data['placeholder_score'],
            'goal'              => $scoringType,
        );

        unset($athletes[$id]['competition_id']);
        unset($athletes[$id]['rank']);
        unset($athletes[$id]['score']);
        unset($athletes[$id]['id']);
        // unset($athletes[$id]['athlete_id']);

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
    protected function _sortAthleteResults ($athletes, $scoringType = 'rank')
    {
        // remove the numeric index
        sort($athletes);

        // var_dump($athletes); die;

        // create a sorting index
        $sortingIndex = array();
        foreach ($athletes as $i => $athleteResults) {
            $sortingIndex[$i] = (int)$athleteResults['points'];
        }

        array_multisort(
            $sortingIndex,
            ($scoringType == 'points')
                ? SORT_DESC
                : SORT_ASC,
            $athletes
        );

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

    /**
     * getResourceId()
     *
     * Gets the resource id
     *
     * @return string
     */
    public function getResourceId ( )
    {
        return 'leaderboards';
    }

    /**
     * getActiveLeaderboards()
     *
     * Gets the leaderboards that have people signed up in the division/gender combination
     *
     * @param App_Model_Event
     */
    public function getActiveLeaderboards ($event)
    {
        // @TODO fix this awfulness
        $sql = "select scale_id, gender, count(1) as count, s.name as name from athletes
            inner join scales s on s.id=athletes.scale_id
            where
                s.event_id=%d group by scale_id, gender";

        $table = new App_Model_DbTable_Athlete;


        $result = $table->getAdapter()->query(sprintf($sql, $event->id));

        $result->setFetchMode(Zend_Db::FETCH_OBJ);

        return $result->fetchall();

    } // END function getActiveLeaderboards

} // END class App_Model_Leaderboard