<?php
/**
 * Athlete List Item View Helper
 *
 * This view helper displays information related to an Athlete in a list-item format
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
 * Athlete List Item View Helper
 *
 * This view helper displays information related to an Athlete in a list-item format
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_AthleteItem
    extends Zend_View_Helper_HtmlElement
{
    /**
     * athleteItem()
     *
     * Main method of the view helper
     *
     * @param array $Athlete
     * @return string
     */
    public function athleteItem ($athlete)
    {
        $view = $this->view;
        $auth = $view->auth();

        $actions = '';
        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($athlete->name, array(
            'action'    => 'view',
            'id'        => $athlete->id,
        )));

        if ($auth->hasIdentity()) {
            $actions = $view->htmlList(array(
                $view->htmlAnchor('Edit', array(
                    'action'    => 'edit',
                    'id'        => $athlete->id,
                )),
                $view->htmlAnchor('Delete', array(
                    'action'    => 'delete',
                    'id'        => $athlete->id,
                )),
            ), false, array(
                'class' => 'actions',
            ), false);
        }

        return $title . $actions;

    } // END function athleteItem

} // END class App_View_Helper_AthleteItem