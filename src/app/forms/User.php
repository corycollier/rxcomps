<?php
/**
 * User Form
 *
 * The form for editing a single User
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * User Form
 *
 * The form for editing a single User
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
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

    	$this->addElement('email', 'email', array(
    		'label' 		=> 'Email',
    		'placeholder'	=> 'Enter email',
    		'required'		=> true,
            'filters'    	=> array('StringTrim', 'StringToLower'),
            'validators'    => array(
                'EmailAddress',
            )
		));

        $this->addElement('password', 'passwd', array(
            'label'         => 'Password',
            'placeholder'   => 'Enter password',
            // 'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('password', 'confirm_password', array(
            'label'         => 'Confirm Password',
            'placeholder'   => 'Confirm password',
            // 'required'      => true,
            'filters'       => array('StringTrim'),
            'validators'    => array(
                'PasswordConfirmation',
            ),
        ));

        $this->addElement('text', 'first_name', array(
            'label'         => 'First Name',
            'placeholder'   => 'Enter First Name',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'last_name', array(
            'label'         => 'Last Name',
            'placeholder'   => 'Enter Last Name',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'address1', array(
            'label'         => 'Address 1',
            'placeholder'   => 'Enter Address (line 1)',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'address2', array(
            'label'         => 'Address 2',
            'placeholder'   => 'Enter Address (line 2)',
            'required'      => false,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'city', array(
            'label'         => 'City',
            'placeholder'   => 'Enter City',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'state', array(
            'label'         => 'State',
            'placeholder'   => 'Enter State (2 letter)',
            'required'      => true,
            'filters'       => array('StringTrim', 'StringToUpper'),
        ));

        $this->addElement('text', 'postal', array(
            'label'         => 'Postal Code',
            'placeholder'   => 'Enter Postal Code',
            'required'      => true,
            'filters'       => array('StringTrim'),
            'validators'    => array(
                // 'PostCode',
            ),
        ));

        $this->addElement('text', 'country', array(
            'label'         => 'Country',
            'placeholder'   => 'Enter Country',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        // $this->addElement('date', 'birthday', array(
        //     'label'      => 'Birth Date',
        //     'placeholder'   => 'Enter Birthday',
        //     // 'required'      => true,
        // ));

    	$this->addElement('submit', 'save', array(
    		'label' 		=> 'Save',
    		'ignore'		=> true,
		));

        // set the address display group
        $this->addDisplayGroup(array(
            'email', 'passwd', 'confirm_password'
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

        $this->addDisplayGroup(array(
            'save',
        ), 'buttons');

        $this->setDisplayGroupDecorators(array(
            'FormElements',
            'Fieldset'
        ));

    } // END function init

} // END class App_Form_User
