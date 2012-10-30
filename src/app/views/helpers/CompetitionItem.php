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
    public function competitionItem ($competition)
    {
        $view = $this->view;
        $auth = $view->auth();

        $actions = '';
        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($competition->name, array(
            'action'    => 'view',
            'id'        => $competition['id'],
        )));

        if ($auth->hasIdentity()) {
            $actions = $view->htmlList(array(
                $view->htmlAnchor('Edit', array(
                    'action'    => 'edit',
                    'id'        => $competition->id,
                )),
                $view->htmlAnchor('Delete', array(
                    'action'    => 'delete',
                    'id'        => $competition->id,
                )),
            ), false, array(
                'class' => 'actions',
            ), false);
        }

        return $title . $actions;

    } // END function CompetitionItem

} // END class App_View_Helper_CompetitionItem