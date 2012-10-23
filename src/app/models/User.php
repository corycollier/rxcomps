<?php
/**
 * Users Model
 *
 * This model represents individual users of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Users Model
 *
 * This model represents individual users of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_User
    extends Rx_Model_Abstract
{
    /**
     * Excpetion message to indicate that the login form is invalid
     */
    const EXCEPTION_LOGIN_FORM_NOT_VALID = 'Login form not valid';

    /**
     * Excpetion message to indicate that the login failed
     */
    const EXCEPTION_AUTH_FAILURE = 'Login Failure';

    /**
     * Property to hold an instance of the authentication adapter associated
     * with this model
     *
     * @var Zend_Auth_Adapter_DbTable
     */
    protected $_authAdapter;

    /**
     * login()
     *
     * Method to login a user
     *
     * @return Zend_Auth_Result
     */
    public function login ($params = array())
    {
        $form           = $this->getForm();
        $authAdapter    = $this->getAuthAdapter();
        $auth           = $this->getAuth();

        if (! $form->isValid($params)) {
            throw new Zend_Exception(self::EXCEPTION_LOGIN_FORM_NOT_VALID);
        }

        $result = $authAdapter->setIdentity($form->getValue('email'))
            ->setCredential($form->getValue('passwd'))
            ->authenticate();

        if ($result->getCode() == Zend_Auth_Result::SUCCESS) {
            $auth->getStorage()->write(
                $authAdapter->getResultRowObject()
            );
        } else {
            throw new Zend_Exception(self::EXCEPTION_AUTH_FAILURE);
        }

    } // END function login

    /**
     * logout()
     *
     * Logs out the current user
     */
    public function logout ( )
    {
        $this->getAuth()->clearIdentity();

    } // END function logout

    /**
     * getAuth()
     *
     * Returns the single instance of the Zend_Auth object
     *
     * @return Zend_Auth
     */
    public function getAuth ( )
    {
        return Zend_Auth::getInstance();

    } // END function getAuth

    /**
     * getAuthAdapter()
     *
     * Gets the authentication adapter for this user instance
     *
     * @return Zend_Auth_Adapter_DbTable
     */
    public function getAuthAdapter ( )
    {
        if (! $this->_authAdapter) {
            $this->_authAdapter = new Zend_Auth_Adapter_DbTable(
                Zend_Db_Table::getDefaultAdapter()
            );

            $this->_authAdapter
                ->setTableName('users')
                ->setIdentityColumn('email')
                ->setCredentialColumn('passwd')
                ->setCredentialTreatment('SHA1(?)');
        }

        return $this->_authAdapter;

    } // END function getAuthAdapter

    /**
     * getAuth()
     *
     * Gets the authentication adapter for this user instance
     *
     * @return Zend_Acl
     */
    public function getAcl ( )
    {
        return Zend_Registry::getInstance()->get('acl');

    } // END function getAcl

    /**
     * isAllowed()
     *
     * Returns if the user is allowed to go where the request says they're
     * trying to go
     *
     * @return boolean
     */
    public function isAllowed ($request)
    {
        // create local variables for the needed entities
        $acl = $this->getAcl();
        $role = $this->getRole();

        return $acl->isAllowed(
            $role, $request->getControllerName(), $request->getActionName()
        );

    } // END function getRole

    /**
     * getRole()
     *
     * Returns the role of the user
     *
     * @return string
     */
    public function getRole ( )
    {
        $auth = $this->getAuth();
        $role = 'guest';

        $data = $auth->getStorage()->read();

        if (@$data->email) {
            $role = 'admin';
        }

        return $role;

    } // END function getRole

    /**
     * edit()
     *
     * Local override of the edit method to ensure the password is saved
     * as it's sha1 converted hash
     *
     */
    public function edit ($values)
    {
        $values['passwd'] = hash('sha1', @$values['passwd']);

        return parent::edit($values);

    } // END function edit

    /**
     * create()
     *
     * Local override of the create method to ensure the password is saved
     * as it's sha1 converted hash
     *
     */
    public function create ($values)
    {
        $values['passwd'] = hash('sha1', @$values['passwd']);

        return parent::create($values);

    } // END function create

}// END class App_Model_Users

