<?php
/**
 * Competitions Model
 *
 * This model represents individual Competitions of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Competitions Model
 *
 * This model represents individual Competitions of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_Competition
    extends Rx_Model_Abstract
{
    /**
     * create()
     *
     * Creates a single instance of a competition in the database.
     * This method was overridden so some default values could be set before
     * calling it's parent method
     *
     * @param array $values
     * @return App_Model_Competition $this for a fluent interface
     */
    public function create ($values)
    {
        $created = new Zend_Date;

        $values['created'] = $created;
        $values['updated'] = $created;

        $this->_create($values);

        if ($values['scoring_type'] != 'points') {
            return $this;
        }

        $this->_saveScoring(@$values['scoring']);

        return $this;

    } // END function create


    /**
     * edit()
     *
     * Edits a single instance of a competition in the database.
     * This method was overridden so some default values could be set before
     * calling it's parent method
     *
     * @param array $values
     * @return App_Model_Competition $this for a fluent interface
     */
    public function edit ($values)
    {
        $updated = new Zend_Date;

        $values['updated'] = $updated;

        $this->_edit($values);

        if ($values['scoring_type'] != 'points') {
            return;
        }

        $this->_saveScoring(@$values['scoring']);

        return $this;

    } // END function edit

    /**
     * load()
     *
     * Local override of the load method, to add some items to the form that
     * wouldn't otherwise be available
     *
     * @param integer $identity
     * @return App_Model_Competition $this for object-chaining
     */
    public function load ($identity)
    {
        parent::load($identity);

        $form = $this->getForm();

        if ($this->getScoringType() != 'points') {
            return;
        }

        $table = $this->getTable('Scoring');

        $row = $table->fetchRow(sprintf('competition_id = %d', $this->id));

        $form->getElement('scoring')->setValue($row->definition);

    } // END function load

    /**
     * _saveScoring()
     *
     * Method to save the scoring associated with this competition
     *
     * @param text $definition
     * @return App_Model_Competition $this for object-chaining
     */
    protected function _saveScoring ($definition)
    {
        $table = $this->getTable('Scoring');

        $row = $table->fetchRow(sprintf('competition_id = %d', $this->id));

        if (! $row) {
            $table->insert(array(
                'competition_id' => $this->id,
                'definition'    => $definition,
            ));
        } else {
            $row->definition = $definition;
            $row->save();
        }

        return $this;

    } // END function _saveScoring

    /**
     * getLeaderboards()
     *
     * Gets an array representing the leaderboards
     *
     * @return array
     */
    public function getLeaderboards ($scaleId)
    {
        $scores     = $this->getScores($scaleId);
        $points     = $this->getPoints($scaleId, $scores);
        $results    = array();
        $pointValue = current($points);
        $scoreValue = 0;
        $rankValue  = 1;


        foreach ($scores as $i => $score) {
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

    } // END function leaderboards

    /**
     * getScores()
     *
     * Gets all of the scores for a given scale
     *
     * @param  string $scaleId the numeric identifier for the scale
     * @return array the resulting scores
     */
    public function getScores ($scaleId)
    {
        $scores = array();
        $athleteIds = $this->getAthleteIds($scaleId);
        if (count($athleteIds)) {
            $scoreTable = $this->getTable('Score');
            $scores = $scoreTable->fetchAll(
                $scoreTable->buildWhere(array(
                    'competition_id' => $this->id,
                ))
                ->where('athlete_id IN (?)', $athleteIds)
                ->order($this->_getOrder())
            )->toArray();
        }

        return $scores;

    } // END function getScores

    /**
     * getPoints()
     *
     * Gets the points associated for the given scale
     * @param  string|integer $scaleId the numeric identifier for the scale
     * @return array          the points to associate by rank
     */
    public function getPoints ($scaleId, $scores)
    {
        $points = range(1, count($scores));

        if ($this->getScoringType() == 'points') {
            $scoringTable = $this->getTable('Scoring');
            $scoring = $scoringTable->fetchRow(sprintf('competition_id = %d', $this->id));
            $points = explode(PHP_EOL, $scoring->definition);
        }

        return $points;

    } // END function getPoints

    /**
     * getScoringType()
     *
     * Returns if the type of scoring is by points (custom), or rank (standard)
     *
     * @return string the type of scoring [points|rank]
     */
    public function getScoringType ( )
    {
        $scoringTable = $this->getTable('Scoring');
        $scoring = $scoringTable->fetchRow(sprintf('competition_id = %d', $this->id));

        // if there is an associated scorings record, then this must be scored by points
        if ($scoring) {
            return 'points';
        }

        return 'rank';

    } // END function getScoringType

    /**
     * _getOrder()
     *
     * Gets the order based on the goal of the competition
     *
     * @return string
     */
    protected function _getOrder ( )
    {
        $order = 'score DESC';

        if ($this->getValue('goal') == 'time') {
            $order = 'score ASC';
        }

        return $order;

    } // END function _getOrder

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
        $table = $this->getTable('Athlete');
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

}// END class App_Model_Competitions
