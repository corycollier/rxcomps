<?php
/**
 * Registration List Item View Helper
 *
 * This view helper displays information related to an Registration in a list-item format
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
 * Registration List Item View Helper
 *
 * This view helper displays information related to an Registration in a list-item format
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_RegistrationItem
    extends Zend_View_Helper_HtmlElement
{
    /**
     * RegistrationItem()
     *
     * Main method of the view helper
     *
     * @param array $Registration
     * @return string
     */
    public function registrationItem ($registration, $user, $params = array())
    {
        $title = $this->_getTitle($registration);

        $actions = $this->view->model($registration, 'App_Model_Registration')->links($user, $params);

        return sprintf('<div class="registration-item">%s%s</div>', $title, $actions);

    } // END function RegistrationItem

    /**
     * _getTitle()
     *
     * Gets the title value for an Registration
     *
     * @param App_Model_Registration
     * @return string
     */
    protected function _getTitle ($registration)
    {
        $view = $this->view;

        $athlete = $registration->findParentRow('App_Model_DbTable_Athlete');

        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($athlete->name, array(
            'controller'=> 'Registrations',
            'action'    => 'view',
            'id'        => $registration->id,
        )));

        return ucwords($title);

    } // END function _getTitle

} // END class App_View_Helper_RegistrationItem
