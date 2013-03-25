<?php
/**
 * User Form
 *
 * The form for editing a single User for the 2012 Infidel Throwdown
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * User Form
 *
 * The form for editing a single User for the 2012 Infidel Throwdown
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Form_User
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Implementation of the init hook to add form elements and decorators
     */
    public function init ( )
    {
        $this->addElement('hidden', 'id', array(
            'ignore'        => true,
        ));

    	$this->addElement('text', 'email', array(
    		// 'label' 		=> 'Email',
    		'placeholder'	=> 'Enter email',
    		'required'		=> true,
            'filters'    	=> array('StringTrim', 'StringToLower'),
		));

        $this->addElement('password', 'passwd', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter password',
            'required'      => true,
        ));

        $this->addElement('text', 'first_name', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter First Name',
            'required'      => true,
        ));

        $this->addElement('text', 'last_name', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter Last Name',
            'required'      => true,
        ));

        $this->addElement('text', 'address1', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter Address (line 1)',
            'required'      => true,
        ));

        $this->addElement('text', 'address2', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter Address (line 2)',
            'required'      => false,
        ));

        $this->addElement('text', 'city', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter City',
            'required'      => true,
        ));

        $this->addElement('text', 'state', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter State (2 letter)',
            'required'      => true,
        ));

        $this->addElement('text', 'postal', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter Postal Code',
            'required'      => true,
        ));

        $this->addElement('text', 'country', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter Country',
            'required'      => true,
        ));

        $this->addElement('date', 'birthday', array(
            'label'      => 'Birth Date',
            'placeholder'   => 'Enter Birthday',
            'required'      => true,
        ));

    	$this->addElement('submit', 'login', array(
    		'label' 		=> 'Login',
    		'ignore'		=> true,
		));

        // set the address display group
        $this->addDisplayGroup(array(
            'email', 'passwd',
            ), 'credentials', array(
            'legend' => 'Credentials'
            )
        );

        // set the address display group
        $this->addDisplayGroup(array(
            'first_name', 'last_name', 'birthday',
            ), 'personal', array(
            'legend' => 'Personal Information (not shared)'
            )
        );

        // set the address display group
        $this->addDisplayGroup(array(
                'address1', 'address2', 'city', 'state', 'country', 'postal'
            ),
            'address',
            array(
                'legend' => 'Address Information (not shared)',
            )
        );

        $this->setStandardDecorators();

        $this->setDisplayGroupDecorators(array(
            'FormElements',
            'Fieldset'
        ));

    } // END function init

} // END class App_Form_User
