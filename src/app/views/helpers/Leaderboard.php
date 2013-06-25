<?php
/**
 * Leaderboard View Helper
 *
 * This view helper is for leaderboards
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Leaderboard View Helper
 *
 * This view helper is for leaderboards
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_View_Helper_Leaderboard
    extends Rx_View_Helper_TableData
{
    /**
     * a list of athletes
     *
     * @var array
     */
    protected $_athletes = array();

    /**
     * a list of competitions
     *
     * @var array
     */
    protected $_competitions = array();

    /**
     * leaderboard()
     *
     * Entry point to the view helper
     *
     * @return App_View_Helper_Leaderboard $this
     */
    public function leaderboard ( )
    {
        return $this;
    }

    /**
     * table()
     *
     * Method to return a table of information for a provided set of data
     *
     * @param array $data
     * @return string
     */
    public function table ($data = array(), $user)
    {
        // var_dump($data);die;
        return '<table class="data-table leaderboards-table">'
            . $this->headers(current($data))
            . $this->rows($data, $user)
            . '</table>';

    } // END function table

    /**
     * headers()
     *
     * Leaderboard headers
     *
     * @param array $data
     * @return string
     */
    public function headers ($data)
    {
        $competitions = $this->_getCompetitions($data);
        $headers = $this->_getHeaders($competitions);
        return sprintf('<tr><th class="athlete-name">Team</th>%s</th>', implode('', $headers));

    } // END function headers

    /**
     * rows()
     *
     * Method to return markup representing all of the rows that should be
     * displayed given the provided data
     *
     * @param array $data
     * @return string
     */
    public function rows ($data, $user = null)
    {
        // set some variables to default values
        $rank = 1;
        $points = 0;
        $result = '';

        foreach ($data as $index => $athlete) {
            if ($athlete['points'] != $points) {
                $rank = $index + 1;
            }
            $result .= $this->row($athlete, $rank, $user);
            $points = $athlete['points'];
        }

        return $result;

    } // END function rows

    /**
     * row()
     *
     * Gets a string representation of a leaderboard result
     *
     * @param array $data
     * @return string
     */
    public function row ($data, $rank, $user = null)
    {
        if (! array_key_exists('athlete_id', $data)) {
            return '';
        }

        $athlete = $this->getAthlete($data['athlete_id']);

        $link = $this->_link(ucwords($athlete->name), array(
            'controller'    => 'athletes',
            'action'        => 'view',
            'id'            => $athlete->id,
        ));

        $title = '<td class="athlete-name">%s %d <span class="alt">(%d)</span></td>';
        $title = sprintf($title, $link, $rank, $data['points']);
        $competitions = $this->getCompetitionResults($data, $user);

        return '<tr>' . $title . implode('', $competitions) . '</tr>';

    } // END function row

    /**
     * getAthlete()
     *
     * Gets the athlete from either the local property (if already found),
     * or performs a database lookup of the athlete
     *
     * @param string|integer $id
     * @return Zend_Db_Table_Row
     */
    public function getAthlete ($id)
    {
        if (! array_key_exists($id, $this->_athletes)) {
            $table = $this->getTable('Athlete');
            $this->_athletes[$id] = $table->fetchRow(sprintf('id = %d', $id));
        }

        return $this->_athletes[$id];

    } // END function getAthlete

    /**
     * getCompetition()
     *
     * Gets the competition from either the local property (if already found),
     * or performs a database lookup of the competition
     *
     * @param string|integer $id
     * @return Zend_Db_Table_Row
     */
    public function getCompetition ($id)
    {
        if (! array_key_exists($id, $this->_competitions)) {
            $table = $this->getTable('Competition');
            $this->_competitions[$id] = $table->fetchRow(sprintf('id = %d', $id));
        }

        return $this->_competitions[$id];

    } // END function getCompetition

    /**
     * getCompetitionResults()
     *
     * Gets the results for each competition, in an array of strings
     *
     * @return array
     */
    public function getCompetitionResults ($data, $user = null)
    {
        $results = array();

        foreach ($data['competitions'] as $id => $competition) {
            $results[] = $this->getCompetitionResult($id, $competition, $user);
        }

        return $results;

    } // END function getCompetitionResults

    /**
     * getCompetitionResult()
     *
     * Gets the markup representing a single competition result
     *
     * @param  array $competition
     * @return string
     */
    public function getCompetitionResult ($id, $competition = array(), $user = null)
    {
        $filter = new Rx_Filter_SecondsToTime;
        $template = '<td class="%s">
            <a href="#" class="expand-details">%d</a>
            <span class="alt">(%s) %s</span>
            </td>';

        if ($competition['goal'] == 'time') {
            $competition['score'] = $filter->filter($competition['score']);
        }

        if (@$competition['placeholder_score']) {
            $competition['score'] = '--';
        }

        return sprintf($template,
            $this->isFiltered($id) ? 'filtered' : '',
            $competition['rank'],
            $competition['score'],
            $this->_getScoreEditLink($id, $competition, $user)
        );

    } // END function getCompetitionResult

    /**
     * _getScoreEditLink
     *
     * Gets an edit/create link if the user has access, returns an empty string
     * if the current user does not
     *
     * @param  integer|string $competitionId
     * @param  array $data
     * @return string
     */
    protected function _getScoreEditLink ($competitionId, $data, $user = null)
    {
        $html = '<div class="admin-edit-link small default btn icon-right icon-pencil">%s</div>';

        $action = 'edit';
        if (isset($data['placeholder_score']) && $data['placeholder_score']) {
            $action = 'create';
        }

        // var_dump($data); die;
        $link = $this->_link($action, array(
            'module'        => 'default',
            'controller'    => 'scores',
            'action'        => $action,
            'id'            => $data['score_id'],
            'competition_id'=> $competitionId,
            'athlete_id'    => $data['athlete_id'],

        ));

        return sprintf($html, $link);
    }
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
        if (! is_array($data) || ! array_key_exists('competitions', $data)) {
            return array();
        }

        $competitionIds = array_keys($data['competitions']);
        $table = $this->getTable('Competition');
        $competitions = $table->fetchAll(
            $table->select()->where('id in (?)', $competitionIds)
        );
        return $competitions;
    }

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
            $this->_link('<i class="icon-plus"></i>', array(
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
            $this->_link('<i class="icon-cancel-circled"></i>', array(
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

    /**
     * _link()
     *
     * Returns anchor markup
     *
     * @param string $label
     * @param array $params
     * @return string
     */
    protected function _link ($label, $params = array())
    {
        return $this->view->htmlAnchor($label, $params);
    }

    /**
     * getLink()
     *
     * Gets a link to the leaderboard, if needed. returns an empty string otherwise
     *
     * @param object $gender
     * @param object $scale
     */
    public function getLink ( )
    {

    } // END function getLink

} // END class App_View_Helper_Leaderboard