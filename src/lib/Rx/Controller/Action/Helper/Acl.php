<?php
/**
 * Acl Action Helper
 *
 * This action helper is designed for use with Rx action controllers, to
 * provide quick access to acl information
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Controller_Action_Helper
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Acl Action Helper
 *
 * This action helper is designed for use with Rx action controllers, to
 * provide quick access to acl information
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Controller_Action_Helper
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_Controller_Action_Helper_Acl
    extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * Message to indicate that access was denied for a request
     */
    const MSG_ACCESS_DENIED = 'Access Denied';

    /**
     * check()
     *
     * This checks to see if the current user has access to the location
     * specified in the request
     *
     * @param Zend_Controller_Request_Http $request
     *
     */
    public function check (Zend_Controller_Request_Http $request)
    {
        $controller = $this->getActionController();

        $controllerName = ucwords(rtrim($request->getControllerName(), 's'));

        $user   = $this->getModel('User');
        $model  = $this->getModel($controllerName);
        $id     = $request->getParam('id');

        if ($model && $id) {
            $model->load($id);
        }

        $isAllowed  = $user->isAllowed($request, $model);

        if (! $isAllowed) {
            $controller->getHelper('FlashMessenger')->addMessage(self::MSG_ACCESS_DENIED);
            $redirect = $controller->getHelper('Redirector')->gotoRoute(array(
                'module'    => 'default',
                'controller'=> 'error',
                'action'    => 'denied',
            ));
        }

    } // END function request

    /**
     * getModel()
     *
     * Gets a new instance of a model
     *
     * @return App_Model_Users
     */
    public function getModel ($model)
    {
        $class = sprintf('App_Model_%s', $model);

        if (class_exists($class) || $this->getAutoloader()->autoload($class)) {
            return new $class;
        }


    } // END function getModel

    public function getAutoloader ( )
    {
        return Zend_Loader_Autoloader::getInstance();
    }



} // END class Rx_Controller_Action_Helper_Acl