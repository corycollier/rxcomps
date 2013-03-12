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
        $title = $this->_getTitle($athlete);

        $actions = $this->_getActions($athlete);

        return sprintf('<div class="athlete-item">%s%s</div>', $title, $actions);

    } // END function athleteItem

    /**
     * _getTitle()
     *
     * Gets the title value for an athlete
     *
     * @param App_Model_Athlete
     * @return string
     */
    protected function _getTitle ($athlete)
    {
        $view = $this->view;

        $link = $view->htmlAnchor(ucwords($athlete->name), array(
            'controller'=> 'athletes',
            'action'    => 'view',
            'id'        => $athlete->id,
            'event_id'  => $athlete->event_id,
        ));

        // var_dump($athlete); die;

        $title = sprintf('<h3>%s <span class="alt">(%s)</span></h3>', $link, $athlete->gym);

        return $title;

    } // END function _getTitle

    /**
     * _getActions()
     *
     * gets markup displaying links to perform actions on an athlete
     *
     * @param App_Model_Athlete
     * @return string
     */
    protected function _getActions ($athlete)
    {
        $view = $this->view;
        $auth = $view->auth();

        $actions = '';

        if ($auth->hasIdentity()) {
            $actions = $view->htmlList(array(
                $view->htmlAnchor('Edit', array(
                    'controller'=> 'athletes',
                    'action'    => 'edit',
                    'id'        => $athlete->id,
                    'event_id'  => $athlete->event_id,
                )),
                $view->htmlAnchor('Delete', array(
                    'controller'=> 'athletes',
                    'action'    => 'delete',
                    'id'        => $athlete->id,
                    'event_id'  => $athlete->event_id,
                )),
            ), false, array(
                'class' => 'subnav',
            ), false);
        }

        return $actions;

    } // END function _getActions

} // END class App_View_Helper_AthleteItem