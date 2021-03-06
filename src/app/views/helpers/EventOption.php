<?php
/**
 * EventOption List Item View Helper
 *
 * This view helper displays information related to an EventOption in a list-item format
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
 * EventOption List Item View Helper
 *
 * This view helper displays information related to an EventOption in a list-item format
 *
 * @category    RxComps
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_EventOption
    extends Rx_View_Helper_Model
{
    /**
     * Property to define the model type associated with this helper
     *
     * @var string
     */
    protected $_modelName = 'App_Model_EventOption';

    /**
     * eventOptionItem()
     *
     * Main method of the view helper
     *
     * @param array $model
     * @return string
     */
    public function eventOption ($model)
    {
        $this->model($model, $this->_modelName);

        return $this;

    } // END function eventOption

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

        $link = $view->htmlAnchor(ucwords($eventOption->row->name), array(
            'controller'=> 'event-options',
            'action'    => 'view',
            'id'        => $eventOption->row->id,
            'event_id'  => $eventOption->row->event_id,
        ));

        // var_dump($athlete); die;

        $title = sprintf('<h3>%s</h3>', $link);

        return $title;

    } // END function _getTitle

} // END class App_View_Helper_AthleteItem