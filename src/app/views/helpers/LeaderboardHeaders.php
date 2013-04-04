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
     * _getCompetitions()
     *
     * Gets the competition records, by checking for values in a data array
     *
     * @param array $data
     * @return Zend_Db_Table_Rowset
     */
    protected function _getCompetitions ($data = array())
    {
        if (! array_key_exists('competitions', $data)) {
            return array();
        }

        $competitionIds = array_keys($data['competitions']);
        $table = $this->_getCompetitionTable();
        $competitions = $table->fetchAll(
            $table->select()->where('id in (?)', $competitionIds)
        );
        return $competitions;
    }

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
        $competitions = $this->_getCompetitions($data);
        $headers = $this->_getHeaders($competitions);
        return sprintf('<tr><th class="athlete-name">Team</th>%s</th>', implode('', $headers));

    } // END function leaderboardHeaders

    /**
     * _getHeaders()
     *
     * Gets an array of headings for a given set of competitions
     *
     * @param Zend_Db_Table_Rowset $competitions
     * @return array
     */
    protected function _getHeaders ($competitions)
    {
        $results = array();
        $filters = $this->getRequest()->getParam('filters');
        foreach ($competitions as $competition) {
            $results[] = $this->_getHeading($competition, $filters);
        }

        return $results;

    } // END function _getHeaders

    /**
     * _getHeading()
     *
     * Method to get a heading for a given competition
     *
     * @param Zend_Db_Table_Row $competition
     * @param string $filters
     * @return string
     */
    protected function _getHeading ($competition, $filters = '')
    {
        $isFiltered =  $this->isFiltered($competition->id);

        if ($isFiltered) {
            return $this->_getFilteredHeading($competition, $filters);
        }

        return $this->_getUnfilteredHeading($competition, $filters);

    } // END function _getHeading

    /**
     * _getFilteredHeading()
     *
     * gets filtered heading html
     *
     * @param Zend_Db_Table_Row $competition
     * @return string
     */
    protected function _getFilteredHeading ($competition, $filters = array())
    {
        return sprintf('<th class="filtered">%s %s</th>',
            $competition->name,
            $this->view->htmlAnchor('<i class="icon-plus"></i>', array(
                'filters' => ltrim(implode(',', array_diff(explode(',', $filters), array($competition->id))), ','),
            ))
        );

    } // END function _getFilteredHeading

    /**
     * _getUnfilteredHeading()
     *
     * gets unfiltered heading html
     *
     * @param Zend_Db_Table_Row $competition
     * @return string
     */
    protected function _getUnfilteredHeading ($competition, $filters = array())
    {
        return  sprintf('<th class="">%s %s</th>',
            $competition->name,
            $this->view->htmlAnchor('<i class="icon-cancel-circled"></i>', array(
                'filters' => ltrim($filters . ',' . $competition->id, ','),
            ))
        );

    } // END function _getUnfilteredHeading

    /**
     * isFiltered()
     *
     * Determines if a given competition is in the list of filtered competitions
     *
     * @param integer|string $competitionId
     * @return boolean
     */
    public function isFiltered ($competitionId)
    {
        $filters = $this->getFilters();

        if (in_array($competitionId, $filters)) {
            return true;
        }

        return false;

    } // END function isFiltered

    /**
     * getFilters()
     *
     * Gets list of filters from the request, and returns them as an array
     *
     * @return array()
     */
    public function getFilters ( )
    {
        $request = $this->getRequest();

        $filters = $request->getParam('filters');

        $filters = explode(',', trim($filters));

        return $filters;

    } // END function getFilters

    /**
     * getRequest()
     *
     * Returns access to the request object
     *
     * @return Zend_Controller_Request_Http
     */
    public function getRequest ( )
    {
        return $this->view->request();

    } // END function getRequest

} // END class App_View_Helper_ClassName