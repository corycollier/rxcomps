<?php
/**
 * Rx Action Controller
 *
 * This controller acts as the default controller to extend from when
 * using the Rx libarry
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
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
 * @category    RxComps
 * @package     Rx
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
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
        $this->view->request = $this->getRequest();

        $layout     = $this->getHelper('Layout');
        $request    = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $layout->disableLayout();
        }

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

    /**
     * _mail()
     *
     * Mails a user
     *
     * @param App_Model_User $user
     * @return App_Model_Registration $this for object-chaining
     */
    protected function _mail ($user, $subject, $viewScript, $params = array())
    {
        $mail = $this->_getMailObject();
        $view = $this->_getViewObject();

        foreach ($params as $key => $value) {
            $view->$key = $value;
        }

        $html = $view->render($viewScript);
        $text = strip_tags($html);

        $mail->setBodyHtml($html);
        $mail->setBodyText($text);
        $mail->setFrom('no-reply@rxcomps.com', 'No-Reply');
        $mail->addTo($user->getValue('email'));
        $mail->addBcc('corycollier@corycollier.com', 'Cory Collier');
        $mail->addBcc('lee@baconbeatdown.com', 'Lee Spears');
        $mail->setSubject($subject);

        $mail->send();

        return $this;

    } // END function _mail

    /**
     * _getMailObject()
     *
     * Gets a new mail object
     *
     * @return Zend_Mail
     */
    protected function _getMailObject ( )
    {
        return new Zend_Mail;

    } // END function _getMailObject

    /**
     * _getViewObject()
     *
     * Gets a new view object
     *
     * @return Zend_View
     */
    protected function _getViewObject ( )
    {
        $view = clone $this->view;
        $view->setScriptPath(APPLICATION_PATH . '/views/emails/');
        return $view;

    } // END function _getViewObject

} // END class Rx_Controller_Action