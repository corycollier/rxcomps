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
    	$this->addElement('text', 'email', array(
    		'label' 		=> 'Email',
    		'placeholder'	=> 'Enter email',
    		'required'		=> true,
            'filters'    	=> array('StringTrim', 'StringToLower'),

		));

    	$this->addElement('password', 'passwd', array(
    		'label' 		=> 'Password',
    		'placeholder'	=> 'Enter password',
    		'required'		=> true,
		));

    	$this->addElement('submit', 'login', array(
    		'label' 		=> 'Login',
    		'ignore'		=> true,
		));

        $this->setElementDecorators(array(
            'ViewHelper',
            'Label',
            'Errors',
            array('HtmlTag', array(
                'tag'   => 'div',
                'class' => 'form-element'
            )),
        ));

        $this->setDecorators(array(
            'FormElements',
            'Fieldset',
            'Form',
        ));

    } // END function init

} // END class App_Form_User
