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

class App_View_Helper_CompetitionListItem
    extends Zend_View_Helper_HtmlElement
{
    /**
     * CompetitionListItem()
     *
     * Main method of the view helper
     *
     * @param array $competition
     * @return string
     */
    public function CompetitionListItem ($competition)
    {
        $view = $this->view;
        $auth = $view->auth();

        $title = '<h3>%s</h3>';
        $actions = '';

        if ($auth->hasIdentity()) {
            $actions = $view->htmlList(array(
                $view->htmlAnchor('Edit', array(
                    'action'    => 'edit',
                    'id'        => $competition['id'],
                )),
                $view->htmlAnchor('Delete', array(
                    'action'    => 'delete',
                    'id'        => $competition['id'],
                )),
            ), false, array(
                'class' => 'actions',
            ), false);
        }

        return sprintf($title, $view->htmlAnchor($competition['name'], array(
                'action'    => 'view',
                'id'        => $competition['id'],
            )))
            . $actions;

    } // END function CompetitionListItem

} // END class App_View_Helper_CompetitionListItem