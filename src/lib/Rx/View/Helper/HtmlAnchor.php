<?php
/**
 * View Helper For Html Anchors
 *
 * This view helper will allow the quick creation of anchor tags in view scripts
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * View Helper For Html Anchors
 *
 * This view helper will allow the quick creation of anchor tags in view scripts
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_View_Helper_HtmlAnchor
    extends Zend_View_Helper_HtmlElement
{
    /**
     * htmlAnchor()
     *
     * This is the entry point for the view helper
     */
    public function htmlAnchor ($text, $urlOptions = array(), $attribs = array())
    {
        $template = '<a href="%s"%s>%s</a>';

        return sprintf(
            $template,
            $this->view->url($urlOptions),
            $this->_htmlAttribs($attribs),
            $text
        );

    } // END function htmlAnchor


} // END class Rx_View_Helper_ClassName