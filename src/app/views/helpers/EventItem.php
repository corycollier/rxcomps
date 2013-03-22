<?php
/**
 * Event List Item View Helper
 *
 * This view helper displays information related to an event in a list-item format
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
 * Event List Item View Helper
 *
 * This view helper displays information related to an event in a list-item format
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_EventItem
    extends Zend_View_Helper_HtmlElement
{
    /**
     * eventItem()
     *
     * Main method of the view helper
     *
     * @param array $event
     * @return string
     */
    public function eventItem ($event, $user, $params = array())
    {
        $title = $this->_getTitle($event);

        $actions = $this->view->model($event, 'App_Model_Event')->links($user, $params);

        return sprintf('<div class="event-item">%s%s</div>', $title, $actions);

    } // END function eventItem

    /**
     * _getTitle()
     *
     * Gets the title value for an event
     *
     * @param App_Model_Event
     * @return string
     */
    protected function _getTitle ($event)
    {
        $view = $this->view;
        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($event->name, array(
            'controller'=> 'events',
            'action'    => 'view',
            'id'        => $event->id,
        )));

        return $title;

    } // END function _getTitle

} // END class App_View_Helper_EventItem