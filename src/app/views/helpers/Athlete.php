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
        $this->model($model->row, $this->_modelName);

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

        $link = $view->htmlAnchor(ucwords($athlete->row->name), array(
            'controller'=> 'athletes',
            'action'    => 'view',
            'id'        => $athlete->row->id,
            'event_id'  => $athlete->row->event_id,
        ));

        $title = sprintf('<h3>%s <span class="alt">(%s)</span></h3>', $link, $athlete->row->gym);

        return $title;

    } // END function _getTitle

} // END class App_View_Helper_AthleteItem