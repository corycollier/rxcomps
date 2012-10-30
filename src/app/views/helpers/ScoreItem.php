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
     * ScoreItem()
     *
     * Main method of the view helper
     *
     * @param array $score
     * @return string
     */
    public function scoreItem ($score)
    {
        $view = $this->view;
        $auth = $view->auth();

        $actions = '';
        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($score->score, array(
            'action'    => 'view',
            'id'        => $score->id,
        )));

        if ($auth->hasIdentity()) {
            $actions = $view->htmlList(array(
                $view->htmlAnchor('Edit', array(
                    'action'    => 'edit',
                    'id'        => $score->id,
                )),
                $view->htmlAnchor('Delete', array(
                    'action'    => 'delete',
                    'id'        => $score->id,
                )),
            ), false, array(
                'class' => 'actions',
            ), false);
        }

        return $title . $actions;

    } // END function ScoreItem

} // END class App_View_Helper_ScoreItem