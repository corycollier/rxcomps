<?php
/**
 * View Plugin
 *
 * This plugin initializes all of the items necessary for the view
 *
 * @category    InfidelThrowdown
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2012 Firebase Gym, Inc (http://www.infidelthrowdown.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * View Plugin
 *
 * This plugin initializes all of the items necessary for the view
 *
 * @category    InfidelThrowdown
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2012 Firebase Gym, Inc (http://www.infidelthrowdown.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Plugin_View
    extends Zend_Controller_Plugin_Abstract
{
    /**
     * preDispatch()
     *
     * Local implementation of the preDispatch hook, to setup view assets
     */
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $front = Zend_Controller_Front::getInstance();
        $view = $front->getParam('bootstrap')->getResource('view');

        $params = $request->getParams();
        foreach ($params as $key => $value) {
            if (is_object($value) || is_array($value)) {
                unset($params[$key]);
            }
        }

        $view->title = 'Rx Competition : ' . implode(' : ', $params);

    } // END function preDispatch

} // END class App_Plugin_View