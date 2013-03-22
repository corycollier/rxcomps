<?php
/**
 * Competition List Item View Helper
 *
 * This view helper displays information related to an Competition in a list-item format
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Competition List Item View Helper
 *
 * This view helper displays information related to an Competition in a list-item format
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_CompetitionItem
    extends Zend_View_Helper_HtmlElement
{
    /**
     * competitionItem()
     *
     * Main method of the view helper
     *
     * @param array $competition
     * @return string
     */
    public function competitionItem ($competition, $user, $params = array())
    {
        $title = $this->_getTitle($competition);

        $actions = $this->view->model($competition, 'App_Model_Competition')->links($user, $params);

        return sprintf('<div class="competition-item">%s%s</div>', $title, $actions);

    } // END function CompetitionItem

    /**
     * _getTitle()
     *
     * Gets the title value for an competition
     *
     * @param App_Model_Competition
     * @return string
     */
    protected function _getTitle ($competition)
    {
        $view = $this->view;
        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor(ucwords($competition->name), array(
            'controller'    => 'competitions',
            'action'    => 'view',
            'id'        => $competition->id,
            'event_id'  => $view->event()->id(),
        )));

        return ucwords($title);

    } // END function _getTitle

} // END class App_View_Helper_CompetitionItem