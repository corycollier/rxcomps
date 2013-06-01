<?php
/**
 * Scores Controller
 *
 * This controller handles all necessary steps to create view and modify Scores
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Scores Controller
 *
 * This controller handles all necessary steps to create view and modify Scores
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class ScoresController
    extends Rx_Controller_Model
{
    /**
     * Specify the name of the model to be used
     *
     * @var string
     */
    protected $_modelName = 'Score';

    /**
     * indexAction()
     *
     * This is the main action for the Scores controller
     */
    public function indexAction ( )
    {

    } // END function indexAction

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

        $message = sprintf(self::MSG_EDIT_SUCCESS, $this->_modelName);
        $params = array_merge($request->getParams(), $request->getPost());

        if (! $form->isValid($params)) {
            throw new Rx_Controller_Exception(self::MSG_FORM_INVALID);
        }

        var_dump($form->getValues()); die;

        $model->edit($params);
        $this->flashAndRedirect($message, 'success', $request->getParams());

    } // END function _edit

} // END class App_Controller_ScoresController