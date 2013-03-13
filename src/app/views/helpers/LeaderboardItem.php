<?php
/**
 * Leaderboard Item View Helper
 *
 * This view helper takes an associative array of data, and retrieves associated
 * model information from it
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Leaderboard Item View Helper
 *
 * This view helper takes an associative array of data, and retrieves associated
 * model information from it
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_LeaderboardItem
    extends Zend_View_Helper_HtmlElement
{
    /**
     * _getAthleteTable()
     *
     * Gets a new instance of an athlete table
     *
     * @return App_Model_DbTable_Athlete
     */
    protected function _getAthleteTable ( )
    {
        return new App_Model_DbTable_Athlete;

    } // END function _getAthleteTable

    /**
     * _getCompetitionTable()
     *
     * Gets a new instance of an competition table
     *
     * @return App_Model_DbTable_Competition
     */
    protected function _getCompetitionTable ( )
    {
        return new App_Model_DbTable_Competition;

    } // END function _getCompetitionTable

    /**
     * leaderboardItem()
     *
     * Gets a string representation of a leaderboard result
     *
     * @param array $data
     * @return string
     */
    public function leaderboardItem ($data, $rank)
    {
        if (! count($data)) {
            return '';
        }

        $table = $this->_getAthleteTable();
        $athlete = $table->fetchRow(sprintf('id = %d', $data['athlete_id']));

        $competitions = $this->getCompetitionResults($data);

        return implode(PHP_EOL, array(
            '<tr>',
            sprintf('<td class="athlete-name"><span class="alt">(%d)</span> %s %d</td>',
                $data['points'],
                $this->view->htmlAnchor(ucwords($athlete->name), array(
                    'controller'    => 'athletes',
                    'action'        => 'view',
                    'id'            => $athlete->id,
                )),
                $rank
            ),
            implode(PHP_EOL, $this->getCompetitionResults($data)),
            '</tr>',
        ));

    } // END function leaderboardItem

    /**
     * getCompetitionResults()
     *
     * Gets the results for each competition, in an array of strings
     *
     * @return array
     */
    public function getCompetitionResults ($data)
    {
        $results = array();

        $filter = new Rx_Filter_SecondsToTime;

        $goal = $data['goal'];

        foreach ($data['competitions'] as $competitionId => $competitionResults) {

            if ($goal == 'time') {
                $competitionResults['score'] = $filter->filter($competitionResults['score']);
            }

            if (@$competitionResults['placeholder_score']) {
                $competitionResults['score'] = '--';
            }

            // $results[] = sprintf('%d (%d)', $competitionResults['rank'], $competitionResults['score']);
            // $results[] = sprintf('%d', $competitionResults['rank']);
            $results[] = sprintf(implode(PHP_EOL, array(
                    '<td class="%s">',
                    '<a href="#" class="expand-details">%d</a>',
                    '<ul class="details">',
                    '<li><strong>Score</strong> %s %s</li>',
                    // '<li><strong>Points</strong> %d</li>',
                    '</ul>',
                    '</td>',
                )),
                $this->isFiltered($competitionId) ? 'filtered' : '',
                $competitionResults['rank'],
                $competitionResults['score'],
                $this->_getScoreEditLink($competitionId, $data)
                // $competitionResults['points']
            );
        }
        return $results;

    } // END function getCompetitionResults

    protected function _getScoreEditLink ($competitionId, $data)
    {
        if (! $this->view->auth()->hasIdentity()) {
            return '';
        }

        $action = 'edit';
        if ($data['competitions'][$competitionId]['placeholder_score']) {
            $action = 'create';
        }

        $label = '(' . $action . ')';

        return $this->view->htmlAnchor($label, array(
            'module'        => 'default',
            'controller'    => 'scores',
            'action'        => $action,
            'id'            => @$data['competitions'][$competitionId]['score_id'],
            'competition_id'=> $competitionId,
            'athlete_id'    => $data['athlete_id'],

        ));
    }

    public function isFiltered ($competitionId)
    {
        $request = $this->getRequest();

        $filters = $request->getParam('filters');

        $filters = $this->getFilters();

        if (in_array($competitionId, $filters)) {
            return true;
        }

        return false;

    }

    public function getFilters ( )
    {
        $request = $this->getRequest();

        $filters = $request->getParam('filters');

        $filters = explode(',', trim($filters));

        return $filters;
    }

    public function getRequest ( )
    {
        return Zend_Controller_Front::getInstance()->getRequest();

    } // END function getRequest


} // END class App_View_Helper_LeaderboardItem