<?php
/**
 * Login Form
 *
 * The form for entering user credentials to allow access to the system
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Login Form
 *
 * The form for entering user credentials to allow access to the system
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_Form_Login
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Implementation of the init hook to add form elements and decorators
     */
    public function init ( )
    {
        $this->addElement('text', 'email', array(
            'label'      => 'Email',
            'placeholder'   => 'Enter email',
            'required'      => true,
            'filters'       => array('StringTrim', 'StringToLower'),
            'validators'    => array(
                'EmailAddress',
            )
        ));

        $this->addElement('password', 'passwd', array(
            'label'      => 'Password',
            'placeholder'   => 'Enter password',
            'required'      => true,
        ));

        $this->addElement('submit', 'login', array(
            'label'         => 'Login',
            'ignore'        => true,
        ));

    } // END function init

} // END class App_Form_User
