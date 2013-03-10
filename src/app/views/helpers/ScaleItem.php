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
    public function scaleItem ($scale)
    {
        $title = $this->_getTitle($scale);

        $actions = $this->_getActions($scale);

        return sprintf('<div class="scale-item">%s%s</div>', $title, $actions);

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

    /**
     * _getActions()
     *
     * gets markup displaying links to perform actions on an scale
     *
     * @param App_Model_Scale
     * @return string
     */
    protected function _getActions ($scale)
    {
        $view = $this->view;
        $auth = $view->auth();

        $actions = '';

        if ($auth->hasIdentity()) {
            $actions = $view->htmlList(array(
                $view->htmlAnchor('Edit', array(
                    'controller'=> 'scales',
                    'action'    => 'edit',
                    'id'        => $scale->id,
                )),
                $view->htmlAnchor('Delete', array(
                    'controller'=> 'scales',
                    'action'    => 'delete',
                    'id'        => $scale->id,
                )),
            ), false, array(
                'class' => 'subnav',
            ), false);
        }

        return $actions;

    } // END function _getActions


} // END class App_View_Helper_ScaleItem