<?php
/**
 * Scale List Item View Helper
 *
 * This view helper displays information related to an scale in a list-item format
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
 * Scale List Item View Helper
 *
 * This view helper displays information related to an scale in a list-item format
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_View_Helper_Scale
    extends Rx_View_Helper_Model
{
    /**
     * Property to define the model type associated with this helper
     *
     * @var string
     */
    protected $_modelName = 'App_Model_Scale';

    /**
     * scaleItem()
     *
     * Main method of the view helper
     *
     * @param array $scale
     * @return string
     */
    public function scale ($model)
    {
        $this->model($model, $this->_modelName);

        return $this;

    } // END function scaleItem

    /**
     * _getTitle()
     *
     * Gets the title value for an scale
     *
     * @param App_Model_Scale
     * @return string
     */
    protected function _getTitle ($scale)
    {
        $view = $this->view;
        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($scale->row->name, array(
            'controller'=> 'scales',
            'action'    => 'view',
            'id'        => $scale->row->id,
        )));

        return $title;

    } // END function _getTitle

} // END class App_View_Helper_ScaleItem