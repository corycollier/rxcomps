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

class App_View_Helper_EventListItem
    extends Zend_View_Helper_HtmlElement
{
    /**
     * eventListItem()
     *
     * Main method of the view helper
     *
     * @param array $event
     * @return string
     */
    public function eventListItem ($event)
    {
        $auth = $this->_getAuth();
        $view = $this->view;

        $title = '<h3>%s</h3>';
        $actions = '';

        if ($auth->hasIdentity()) {
            $actions = $view->htmlList(array(
                $view->htmlAnchor('Edit', array(
                    'action'    => 'edit',
                    'id'        => $event['id'],
                )),
                $view->htmlAnchor('Delete', array(
                    'action'    => 'delete',
                    'id'        => $event['id'],
                )),
            ), false, array(
                'class' => 'actions',
            ), false);
        }

        return sprintf($title, $view->htmlAnchor($event['name'], array(
                'action'    => 'view',
                'id'        => $event['id'],
            )))
            . $actions;


    } // END function eventListItem

    /**
     * _getAuth
     *
     * Gets the global authentication
     *
     * @return Zend_Auth
     */
    protected function _getAuth ( )
    {
        return Zend_Auth::getInstance();

    } // END function _getAuth

} // END class App_View_Helper_EventListItem