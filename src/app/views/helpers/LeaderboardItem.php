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
        $table = $this->_getAthleteTable();
        $athlete = $table->fetchRow(sprintf('id = %d', $data['athlete_id']));

        $competitions = $this->getCompetitionResults($data);

        return implode(PHP_EOL, array(
            '<tr>',
            sprintf('<td>%d (%d) %s</td>', $rank, $data['points'], $athlete->name),
            sprintf('<td>%s</td>', implode('</td><td>', $this->getCompetitionResults($data))),
            // sprintf('<td>%d</td>', $athlete->name),
            // sprintf('<td>%s</td>', $athlete->name),
            // sprintf('<td>%s</td>', $athlete->name),
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
        foreach ($data['competitions'] as $competitionId => $competitionResults) {
            $results[] = sprintf('%d (%d)', $competitionResults['rank'], $competitionResults['score']);
        }
        return $results;

    } // END function getCompetitionResults


} // END class App_View_Helper_LeaderboardItem