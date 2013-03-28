<?php
/**
 * User Form
 *
 * The form for entering credit card information
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
 * User Form
 *
 * The form for entering credit card information
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_Form_CreditCard
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Implementation of the init hook to add form elements and decorators
     */
    public function init ( )
    {
        $this->addElement('text', 'credit_card_number', array(
            'label'         => 'Login',
            'placeholder'   => 'Enter Credit Card Number',
            'required'      => true,
            'filters'       => array('StringTrim'),
            'validators'    => array(
                'CreditCard',
            )
        ));

        $this->addElement('text', 'name', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter First Name',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'address1', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter Address (line 1)',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'address2', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter Address (line 2)',
            'required'      => false,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'city', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter City',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'state', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter State (2 letter)',
            'required'      => true,
            'filters'       => array('StringTrim', 'StringToUpper'),
        ));

        $this->addElement('text', 'postal', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter Postal Code',
            'required'      => true,
            'filters'       => array('StringTrim'),
            'validators'    => array(
                'PostCode',
            ),
        ));

        $this->addElement('text', 'country', array(
            // 'label'      => 'Password',
            'placeholder'   => 'Enter Country',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('submit', 'save', array(
            'label'         => 'Login',
            'ignore'        => true,
        ));

    } // END function init

} // END class App_Form_User
