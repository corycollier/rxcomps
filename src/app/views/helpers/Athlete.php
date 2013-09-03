<?php
/**
 * Athlete List Item View Helper
 *
 * This view helper displays information related to an Athlete in a list-item format
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
 * Athlete List Item View Helper
 *
 * This view helper displays information related to an Athlete in a list-item format
 *
 * @category    RxComps
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_Athlete
    extends Rx_View_Helper_Model
{
    /**
     * Property to define the model type associated with this helper
     *
     * @var string
     */
    protected $_modelName = 'App_Model_Athlete';

    /**
     * athlete()
     *
     * Main method of the view helper
     *
     * @param array $model
     * @return string
     */
    public function athlete ($model)
    {
        $this->model($model, $this->_modelName);

        return $this;

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

        $givenId = '';
        if ($athlete->row->given_id) {
            $givenId = $athlete->row->given_id . ' - ';
        }

        $link = $view->htmlAnchor(ucwords($athlete->row->name), array(
            'controller'=> 'athletes',
            'action'    => 'view',
            'id'        => $athlete->row->id,
            'event_id'  => $athlete->row->event_id,
        ));

        $scale = $athlete->row->findParentRow('App_Model_DbTable_Scale');

        $title = sprintf(
            '<h3>%s%s <span class="alt">(%s) [%s]</span></h3>',
            $givenId,
            $link,
            $athlete->row->gym,
            $scale->name
        );

        return $title;

    } // END function _getTitle

} // END class App_View_Helper_AthleteItem