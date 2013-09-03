<?php
/**
 * Registration List Item View Helper
 *
 * This view helper displays information related to an Registration in a list-item format
 *
 * @category    RxComps
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
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
 * @category    RxComps
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_Registration
    extends Rx_View_Helper_Model
{
    /**
     * Property to define the model type associated with this helper
     *
     * @var string
     */
    protected $_modelName = 'App_Model_Registration';

    /**
     * RegistrationItem()
     *
     * Main method of the view helper
     *
     * @param array $model
     * @return string
     */
    public function registration ($model)
    {
        $this->model($model, $this->_modelName);

        return $this;

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

        $athlete = $registration->row->findParentRow('App_Model_DbTable_Athlete');

        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($athlete->name, array(
            'controller'=> 'registrations',
            'action'    => 'view',
            'id'        => $registration->id,
        )));

        return ucwords($title);

    } // END function _getTitle

} // END class App_View_Helper_RegistrationItem
