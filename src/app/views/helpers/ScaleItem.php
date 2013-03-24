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

class App_View_Helper_ScaleItem
    extends Zend_View_Helper_HtmlElement
{
    /**
     * scaleItem()
     *
     * Main method of the view helper
     *
     * @param array $scale
     * @return string
     */
    public function scaleItem ($scale, $user, $params = array())
    {
        $title = $this->_getTitle($scale);

        $actions = $this->view->model($scale, 'App_Model_Scale')->links($user, $params);

        return sprintf('<div class="list-item scale-item">%s%s</div>', $title, $actions);

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
        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($scale->name, array(
            'controller'=> 'scales',
            'action'    => 'view',
            'id'        => $scale->id,
        )));

        return $title;

    } // END function _getTitle

} // END class App_View_Helper_ScaleItem