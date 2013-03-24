<?php
/**
 * Rx Action Controller
 *
 * This controller acts as the default controller to extend from when
 * using the Rx libarry
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Rx Action Controller
 *
 * This controller acts as the default controller to extend from when
 * using the Rx libarry
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Rx_Controller_Action
    extends Zend_Controller_Action
{
    /**
     * preDispatch()
     *
     * local implementation of the preDispatch hook
     */
    public function preDispatch ( )
    {
        $this->getHelper('Acl')->check($this->getRequest());

    } // END function preDispatch

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
        return new $class;

    } // END function getModel

    /**
     * getTable()
     *
     * Gets a new instance of a model
     *
     * @return App_Model_Users
     */
    public function getTable ($table)
    {
        $class = sprintf('App_Model_DbTable_%s', $table);
        return new $class;

    } // END function getTable

    /**
     * getLog()
     *
     * Gets the log resource from the bootstrapper
     *
     * @return Zend_Log|boolean
     */
    public function getLog ( )
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;

    } // END function getLog

    /**
     * flashAndRedirect()
     *
     * Adds a message to the FlashMessenger helper, and redirects
     *
     * @param  string $message
     * @param  string $namespace
     * @param  array $urlParams
     */
    public function flashAndRedirect ($message, $namespace, $urlParams)
    {
        $flash      = $this->getHelper('FlashMessenger');
        $redirector = $this->getHelper('Redirector');

        $flash->addMessage($message, $namespace);
        $redirector->gotoRoute($urlParams);

    } // END function flashAndRedirect

    /**
     * postDispatch()
     *
     * Local implementation of the postDispatch hook
     */
    public function postDispatch ( )
    {
        $this->view->flashMessenger = $this->getHelper('FlashMessenger');
    }

} // END class Rx_Controller_Action