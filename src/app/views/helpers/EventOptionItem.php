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

class App_View_Helper_EventOptionItem
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
    public function eventOptionItem ($eventOption)
    {
        $title = $this->_getTitle($eventOption);

        $actions = $this->_getActions($eventOption);

        return sprintf('<div class="event-option-item">%s%s</div>', $title, $actions);

    } // END function athleteItem

    /**
     * _getTitle()
     *
     * Gets the title value for an eventOption
     *
     * @param App_Model_Athlete
     * @return string
     */
    protected function _getTitle ($eventOption)
    {
        $view = $this->view;

        $link = $view->htmlAnchor(ucwords($eventOption->name), array(
            'controller'=> 'event-options',
            'action'    => 'view',
            'id'        => $eventOption->id,
            'event_id'  => $eventOption->event_id,
        ));

        // var_dump($athlete); die;

        $title = sprintf('<h3>%s</h3>', $link);

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
    protected function _getActions ($eventOption)
    {
        $view = $this->view;
        $auth = $view->auth();

        $actions = '';

        if ($auth->hasIdentity()) {
            $actions = $view->htmlList(array(
                $view->htmlAnchor('Edit', array(
                    'controller'=> 'event-options',
                    'action'    => 'edit',
                    'id'        => $eventOption->id,
                    'event_id'  => $eventOption->event_id,
                )),
                $view->htmlAnchor('Delete', array(
                    'controller'=> 'event-options',
                    'action'    => 'delete',
                    'id'        => $eventOption->id,
                    'event_id'  => $eventOption->event_id,
                )),
            ), false, array(
                'class' => 'subnav',
            ), false);
        }

        return $actions;

    } // END function _getActions

} // END class App_View_Helper_AthleteItem