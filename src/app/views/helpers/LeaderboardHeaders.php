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
        if (! count($data)) {
            return '';
        }

        $table = $this->_getCompetitionTable();
        $competitions = $table->fetchAll(
            $table->select()->where('id in (?)', array_keys($data['competitions']))
        );

        $results = array();

        $filters = $this->getRequest()->getParam('filters');

        foreach ($competitions as $competition) {

            $isFiltered =  $this->isFiltered($competition->id);

            if ($isFiltered) {
                $results[] = sprintf('<th class="filtered">%s %s</th>',
                    $competition->name,
                    $this->view->htmlAnchor('+', array(
                        'filters' => ltrim(implode(',', array_diff(explode(',', $filters), array($competition->id))), ','),
                    ))
                );

            } else {

                $results[] = sprintf('<th class="">%s %s</th>',
                    $competition->name,
                    $this->view->htmlAnchor('x', array(
                        'filters' => ltrim($filters . ',' . $competition->id, ','),
                    ))
                );

            }

        }

        return implode(PHP_EOL, array(
            '<tr>',
            '<th class="athlete-name">Team</th>',
            implode('', $results),
            '</tr>',
        ));

    } // END function leaderboardHeaders

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

} // END class App_View_Helper_ClassName