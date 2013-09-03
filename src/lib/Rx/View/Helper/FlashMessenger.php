<?php
/**
 * Flash Messenger View Helper
 *
 * This view helper is to display the messages that the controller sends to the
 * flash messenger action helper
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Flash Messenger View Helper
 *
 * This view helper is to display the messages that the controller sends to the
 * flash messenger action helper
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_View_Helper_FlashMessenger
    extends Zend_View_Helper_HtmlList
{
    /**
     * flashMessenger()
     *
     * Main method of the view helper
     *
     * @return string
     */
    public function flashMessenger ($flashMessenger)
    {
        $errors     = $flashMessenger->getCurrentMessages('error');
        $information = $flashMessenger->getCurrentMessages('information');
        $successes  = $flashMessenger->getCurrentMessages('success');

        $flashMessenger->clearMessages('error');
        $flashMessenger->clearMessages('information');
        $flashMessenger->clearMessages('success');

        return sprintf('<div class="flash-messages">%s%s%s</div>',
            $errors       ? $this->htmlList($errors,      false, array('class' => 'danger alert'))   : '',
            $information  ? $this->htmlList($information, false, array('class' => 'primary alert'))    : '',
            $successes    ? $this->htmlList($successes,   false, array('class' => 'success alert')) : ''
        );

    } // END function flashMessenger

} // END class Rx_View_Helper_FlashMessenger