<?php
/**
 * Leaderboard Headers View Helper
 *
 * This view helper should display table headers for a leaderboard
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
 * Leaderboard Headers View Helper
 *
 * This view helper should display table headers for a leaderboard
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_LeaderboardHeaders
    extends Zend_View_Helper_HtmlElement
{
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
     * leaderboardHeaders()
     *
     * Leaderboard headers
     *
     * @param array $data
     * @return string
     */
    public function leaderboardHeaders ($data)
    {
        $table = $this->_getCompetitionTable();
        $competitions = $table->fetchAll(
            $table->select()->where('id in (?)', array_keys($data['competitions']))
        );

        $results = array();
        foreach ($competitions as $competition) {
            $results[] = sprintf('%s', $competition->name);
        }

        return implode(PHP_EOL, array(
            '<tr>',
            '<th>Team</th>',
            sprintf('<th>%s</th>', implode('</th><th>', $results)),
            '</tr>',
        ));

    } // END function leaderboardHeaders

} // END class App_View_Helper_ClassName