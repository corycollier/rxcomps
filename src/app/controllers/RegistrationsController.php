<?php
/**
 * Registrations Controller
 *
 * This controller handles all of the displaying an routing of requests for
 * leaderboard information
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Registrations Controller
 *
 * This controller handles all of the displaying an routing of requests for
 * leaderboard information
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class RegistrationsController
    extends Rx_Controller_Model
{
    /**
     * Specify the name of the model to be used
     *
     * @var string
     */
    protected $_modelName = 'Registration';

    /**
     * indexAction()
     *
     * Default action for the leaderboards controller
     */
    public function indexAction ( )
    {

    } // END function indexAction

    /**
     * createAction()
     *
     * Action to allow the creation of model data
     */
    public function createAction ( )
    {
        $model      = $this->getModel($this->_modelName);
        $request    = $this->getRequest();
        $form       = $model->getForm();

        $form->injectDependencies($model, $request->getParams());
        $form->populate($model->filterValues($request->getParams()));

        if ($request->isPost()) {
            var_dump($request->getParams());
            die;
            $this->_create($model, $request);
        }

        $this->view->form = $form;
        $this->view->model = $model;

    } // END function createAction

    /**
     * _create()
     *
     * Isolating the create logic into a separate method, to ease testing
     *
     * @param Rx_Model_Abstract $model
     * @param Zend_Controller_Request_Abstract $request
     */
    protected function _create ($model, $request)
    {
        $flash      = $this->getHelper('FlashMessenger');
        $redirector = $this->getHelper('Redirector');

        try {
            $params = array_merge($request->getParams(), $request->getPost());
            $model->create($params);
            $flash->addMessage(sprintf(
                self::MSG_CREATE_SUCCESS, $this->_modelName
            ), 'success');
            $redirector->gotoRoute(array(
                'action'    => 'view',
                'id'        => $model->id
            ));
        } catch (Zend_Exception $exception) {
            $flash->addMessage($exception->getMessage(), 'error');
        }
    }

} // END class App_Controller_className