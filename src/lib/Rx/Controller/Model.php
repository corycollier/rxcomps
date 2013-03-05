<?php
/**
 * Model Controller
 *
 * This controller acts as the base controller definition for requests to modify
 * or view model information
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
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
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
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

        $form->injectDependencies($model, $request->getParams());
        $form->populate($model->filterValues($request->getParams()));

        if ($request->isPost()) {
            $this->_create($model, $request);
        }

        $this->view->form = $form;

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


    /**
     * editAction()
     *
     * Action to allow the editing of model data
     */
    public function editAction ( )
    {
        $model = $this->getModel($this->_modelName);
        $form = $model->getForm();
        $request = $this->getRequest();
        $flash = $this->getHelper('FlashMessenger');
        $redirector = $this->getHelper('Redirector');

        $model->load($request->getParam('id'));
        $form->injectDependencies($model, $request->getParams());
        $form->populate($model->filterValues($request->getParams()));

        if (! $model->id) {
            $flash->addMessage(sprintf(
                self::MSG_LOAD_FAILURE, $this->_modelName
            ), 'error');
            $redirector->gotoRoute(array(
                'module'        => $request->getModuleName(),
                'controller'    => $request->getControllerName(),
                'action'        => 'index',
            ), 'default', true);
        }

        if ($request->isPost()) {
            try {
                $params = array_merge($request->getParams(), $request->getPost());
                $model->edit($params);
                $flash->addMessage(sprintf(
                    self::MSG_EDIT_SUCCESS, $this->_modelName
                ), 'success');
            } catch (Zend_Exception $exception) {
                $flash->addMessage($exception->getMessage(), 'error');
            }
        }

        $this->view->form = $form;

    } // END function editAction

    /**
     * viewAction()
     *
     * Action to view a single model record
     *
     */
    public function viewAction ( )
    {
        $model = $this->getModel($this->_modelName);
        $request = $this->getRequest();
        $flash = $this->getHelper('FlashMessenger');
        $redirector = $this->getHelper('Redirector');

        $model->load($request->getParam('id'));

        if (! $model->id) {
            $flash->addMessage(sprintf(
                self::MSG_LOAD_FAILURE, $this->_modelName
            ), 'error');
            $redirector->gotoRoute(array(
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
        $flash = $this->getHelper('FlashMessenger');
        $redirector = $this->getHelper('Redirector');

        $model->load($request->getParam('id'));

        if ($request->isPost()) {
            try {
                $model->delete();
                $flash->addMessage(sprintf(
                    self::MSG_DELETE_SUCCESS, $this->_modelName
                ), 'success');
                $redirector->gotoRoute(array(
                    'module'        => $request->getModuleName(),
                    'controller'    => $request->getControllerName(),
                    'action'        => 'index',
                ), 'default', true);
            } catch (Zend_Exception $exception) {
                $flash->addMessage($exception->getMessage(), 'error');
            }
        }

        $this->view->model = $model;
        $this->view->form = new Rx_Form_Confirmation;

    } // END function deleteAction

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

    public function postDispatch ( )
    {
        parent::postDispatch();

        $this->view->paginator = new Zend_Paginator(
            $this->getModel($this->_modelName)->getTable()->getPaginationAdapter()
        );
    }

} // END class Rx_Controller_Model