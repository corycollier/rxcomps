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

        $user = $this->getModel('User');

        $params = array_merge($request->getParams(), $request->getPost());

        if (!$model->getForm()->isValid($params)) {
            throw new Rx_Controller_Exception(self::MSG_FORM_INVALID);
        }

        try {
            $model->create($params);
        } catch (Zend_Exception $exception) {
            $this->getLog()->err($exception->getMessage());
            throw new Rx_Controller_Exception($exception->getMessage());
        }

        // if (isset($params['user'])) {
        //     $user->login($request->getParam('user'));
        // }

        $this->_mail($user, 'Registration Confirmation', 'registration-confirmation.phtml', array(
            'athlete'   => $model->getParent('Athlete'),
            'event'     => $model->getParent('Event'),
            'model'     => $model,
            'user'      => $user,
        ));

        $this->flashAndRedirect($message, 'success', array(
            'module'        => $request->getModuleName(),
            'controller'    => $request->getControllerName(),
            'action'        => 'view',
            'id'            => $model->id,
        ));

    } // END function _create

} // END class App_Controller_className
