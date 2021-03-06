<?php
/**
 * Model Controller
 *
 * This controller acts as the base controller definition for requests to modify
 * or view model information
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Model Controller
 *
 * This controller acts as the base controller definition for requests to modify
 * or view model information
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_Controller_Model
    extends Rx_Controller_Action
{
    /**
     * Tell the developer that the _modelName property is required
     */
    const EXCEPTION_NO_MODEL_NAME_SPECIFIED
        = 'Specify the _modelName attribute for this controller [%s]';

    /**
     * Message to indicate a successful creation of model data
     */
    const MSG_CREATE_SUCCESS = 'Successfully created a %s';

    /**
     * Message to indicate a successful creation of model data
     */
    const MSG_CREATE_FAILURE = 'Failure to create a %s';

    /**
     * Message to indicate a successful editing of model data
     */
    const MSG_EDIT_SUCCESS = 'Successfully edited a %s';

    /**
     * Message to indicate a successful editing of model data
     */
    const MSG_EDIT_FAILURE = 'Failure to edit a %s';

    /**
     * Message to indicate a failure to load the model by the given id
     */
    const MSG_LOAD_FAILURE = 'Failed to load the %s';

    /**
     * Message to indicate a successful deletion of model data
     */
    const MSG_DELETE_SUCCESS = 'Sucessfully deleted a %s';

    /**
     * Message to indicate that given form data is invalid
     */
    const MSG_FORM_INVALID = 'Form data is invalid. Please review errors below';

    /**
     * Short-hand name of the model to associate with this controller
     *
     * @var string
     */
    protected $_modelName;

    /**
     * init()
     *
     * Local implementation of the init hook
     */
    public function init ( )
    {
        if (! $this->_modelName) {
            throw new Rx_Controller_Exception(sprintf(
                self::EXCEPTION_NO_MODEL_NAME_SPECIFIED, get_class($this)
            ));
        }

        $helper = $this->_helper->getHelper('contextSwitch');

        if (! $helper->hasContext('csv')) {
            $helper->addContexts(array(
                'csv'  => array(
                    'suffix'    => 'csv',
                    'headers'   => array('Content-Type' => 'text/csv'),
                )
            ));
            $helper->addActionContext('list', 'json')
                ->addActionContext('list', 'csv')
                ->initContext();
        }

    } // END function init

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
        $params     = $request->getParams();

        $form->injectDependencies($model, $params);
        $form->populate($params);

        if ($request->isPost()) {
            try {
                $this->_create($model, $request);
            } catch (Zend_Exception $exception) {
                $this->getHelper('FlashMessenger')->addMessage($exception->getMessage(), 'error');
            }
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
        $message = sprintf(self::MSG_CREATE_SUCCESS, $this->_modelName);
        $params = array_merge($request->getParams(), $request->getPost());
        $form = $model->getForm();

        if (!$form->isValid($params)) {
            throw new Rx_Controller_Exception(self::MSG_FORM_INVALID);
        }

        $model->create($form->getValues());

        $this->flashAndRedirect($message, 'success', array(
            'module'        => $request->getModuleName(),
            'controller'    => $request->getControllerName(),
            'action'        => 'view',
            'id'            => $model->id,
        ));

    } // END function _create

    /**
     * editAction()
     *
     * Action to allow the editing of model data
     */
    public function editAction ( )
    {
        $model = $this->getModel($this->_modelName);
        $request = $this->getRequest();
        $form = $model->getForm();
        $params = $request->getParams();

        $model->load($request->getParam('id'));

        $form->injectDependencies($model, $params);

        if (! $model->id) {
            $message = sprintf(self::MSG_LOAD_FAILURE, $this->_modelName);
            $this->flashAndRedirect($message, 'error', array(
                'module'        => $request->getModuleName(),
                'controller'    => $request->getControllerName(),
                'action'        => 'index',
            ));
        }

        if ($request->isPost()) {
            try {
                $this->_edit($model, $request);
            } catch (Zend_Exception $exception) {
                $get = $this->_getGetRequest();
                $this->flashAndRedirect($exception->getMessage(), 'error', $get);
            }
        }

        $this->view->form = $form;
        $this->view->model = $model;

    } // END function editAction

    /**
     * _edit()
     *
     * The actual editing functionality
     *
     * @param Rx_Model_Abstract $model
     * @param Zend_Controller_Request_Http $request
     * @throws Rx_Controller_Exception
     */
    protected function _edit ($model, $request)
    {
        $form = $model->getForm();
        $form->injectDependencies($model, $request->getParams());
        $form->populate($model->filterValues($request->getParams()));

        $message = $this->_getEditMessage();
        $params = array_merge($request->getParams(), $request->getPost());

        if (! $form->isValid($params)) {
            throw new Rx_Controller_Exception(self::MSG_FORM_INVALID);
        }

        $model->edit($form->getValues());

        $get = $this->_getGetRequest();

        $this->flashAndRedirect($message, 'success', $get);

    } // END function _edit

    /**
     * viewAction()
     *
     * Action to view a single model record
     */
    public function viewAction ( )
    {
        $model = $this->getModel($this->_modelName);
        $request = $this->getRequest();

        $model->load($request->getParam('id'));

        if (! $model->id) {
            $message = sprintf(self::MSG_LOAD_FAILURE, $this->_modelName);
            $this->flashAndRedirect($message, 'error', array(
                'module'        => $request->getModuleName(),
                'controller'    => $request->getControllerName(),
                'action'        => 'index',
            ), 'default', true);
        }

        $this->view->model = $model;

    } // END function viewAction

    /**
     * deleteAction()
     *
     * Allows the destruction of model data
     */
    public function deleteAction ( )
    {
        $model = $this->getModel($this->_modelName);
        $request = $this->getRequest();

        $model->load($request->getParam('id'));

        if ($request->isPost()) {
            try {
                $this->_delete($model, $request);
            } catch (Zend_Exception $exception) {
                $this->getHelper('FlashMessenger')->addMessage($exception->getMessage(), 'error');
            }
        }

        $this->view->model = $model;
        $this->view->form = new Rx_Form_Confirmation;

    } // END function deleteAction

    /**
     * _delete()
     *
     * The actual deleting functionality
     *
     * @param Rx_Model_Abstract $model
     * @param Zend_Controller_Request_Http $request
     * @throws Rx_Controller_Exception
     */
    public function _delete ($model, $request)
    {
        $message = sprintf(self::MSG_DELETE_SUCCESS, $this->_modelName);
        $model->delete();
        $this->flashAndRedirect($message, 'success', array(
            'module'        => $request->getModuleName(),
            'controller'    => $request->getControllerName(),
            'action'        => 'index',
        ), 'default', true);

    }

    /**
     * listAction()
     *
     * List all of the model data, paginated, of course
     */
    public function listAction ( )
    {
        $model = $this->getModel($this->_modelName);
        $request = $this->getRequest();

        $this->view->items = $model->paginate($request->getParams());

    } // END function listAction

    /**
     * postDispatch()
     *
     * Post dispatch implementation
     */
    public function postDispatch ( )
    {
        parent::postDispatch();

        $this->view->paginator = new Zend_Paginator(
            $this->getModel($this->_modelName)->getTable()->getPaginationAdapter()
        );
    }

    /**
     * _getEditMessage()
     *
     * Method to get the edit message for a successful edit of a model
     *
     * @return string
     */
    protected function _getEditMessage ( )
    {
        return sprintf(self::MSG_EDIT_SUCCESS, $this->_modelName);

    } // END function _getEditMessage

} // END class Rx_Controller_Model