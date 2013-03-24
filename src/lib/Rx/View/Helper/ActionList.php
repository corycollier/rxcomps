<?php
/**
 * Action List View Helper
 *
 * This view helper is to be used to simplify how a list of actions are
 * displayed
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Action List View Helper
 *
 * This view helper is to be used to simplify how a list of actions are
 * displayed
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Rx_View_Helper_ActionList
    extends Zend_View_Helper_HtmlList
{
    /**
     * actionList()
     *
     * An override of the htmlList functionality to clean up view scripts
     *
     * @param array $items
     * @param boolean $ordered
     * @param array $attribs
     * @param boolean $escape
     * @return string
     */
    public function actionList (array $items, $ordered = false, $attribs = false, $escape = false)
    {
        $attribs['class'] = @$attribs['class'] . ' subnav';

        return $this->htmlList($items, $ordered, $attribs, $escape);

    } // END function actionList

} // END class App_View_Helper_ActionList