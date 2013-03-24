<?php
/**
 * Score List Item View Helper
 *
 * This view helper displays information related to an Score in a list-item format
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
 * Score List Item View Helper
 *
 * This view helper displays information related to an Score in a list-item format
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_ScoreItem
    extends Zend_View_Helper_HtmlElement
{
    /**
     * scoreItem()
     *
     * Main method of the view helper
     *
     * @param array $score
     * @return string
     */
    public function scoreItem ($score, $user, $params = array())
    {
        $title = $this->_getTitle($score);

        $actions = $this->view->model($score, 'App_Model_Score')->links($user, $params);

        return sprintf('<div class="list-item score-item">%s%s</div>', $title, $actions);

    } // END function scoreItem

    /**
     * _getTitle()
     *
     * Gets the title value for an score
     *
     * @param App_Model_Score
     * @return string
     */
    protected function _getTitle ($score)
    {
        $view = $this->view;

        $athlete = $score->findParentRow('App_Model_DbTable_Athlete');
        $competition = $score->findParentRow('App_Model_DbTable_Competition');

        if ($competition->goal == 'time') {
            $filter = new Rx_Filter_SecondsToTime;
            $score->score = $filter->filter($score->score);
        }

        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($score->score, array(
            'controller'=> 'scores',
            'action'    => 'view',
            'id'        => $score->id,
        )));

        $details = sprintf('<p>%s %s</p>',
            'Performed by: ' . $view->htmlAnchor($athlete->name, array(
                'controller'=> 'athletes',
                'action'    => 'view',
                'id'        => $athlete->id,
            )),
            'for the event: ' . $view->htmlAnchor($competition->name, array(
                'controller'=> 'competitions',
                'action'    => 'view',
                'id'        => $competition->id,
            ))
        );

        return ucwords($title) . $details;

    } // END function _getTitle

} // END class App_View_Helper_ScoreItem
