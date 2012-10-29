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

class App_View_Helper_ScoreListItem
    extends Zend_View_Helper_HtmlElement
{
    /**
     * ScoreListItem()
     *
     * Main method of the view helper
     *
     * @param array $score
     * @return string
     */
    public function scoreListItem ($score)
    {
        $view = $this->view;
        $auth = $view->auth();

        $title = '<h3>%s</h3>';
        $actions = '';

        if ($auth->hasIdentity()) {
            $actions = $view->htmlList(array(
                $view->htmlAnchor('Edit', array(
                    'action'    => 'edit',
                    'id'        => $score['id'],
                )),
                $view->htmlAnchor('Delete', array(
                    'action'    => 'delete',
                    'id'        => $score['id'],
                )),
            ), false, array(
                'class' => 'actions',
            ), false);
        }

        return sprintf($title, $view->htmlAnchor($score['score'], array(
                'action'    => 'view',
                'id'        => $score['id'],
            )))
            . $actions;

    } // END function ScoreListItem

} // END class App_View_Helper_ScoreListItem