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
            'label'         => 'Credit Card Number',
            'placeholder'   => 'Enter Credit Card Number',
            'required'      => true,
            'filters'       => array('StringTrim'),
            'validators'    => array(
                'CreditCard',
            )
        ));

        $this->addElement('text', 'exp_month', array(
            'label'         => 'Expiration Month',
            'placeholder'   => 'Exp Month',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'exp_year', array(
            'label'         => 'Expiration Year',
            'placeholder'   => 'Exp Year',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'name', array(
            'label'         => 'Billing Name',
            'placeholder'   => 'Enter First Name',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'address', array(
            'label'         => 'Billing Address',
            'placeholder'   => 'Enter Address',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'city', array(
            'label'         => 'Billing City',
            'placeholder'   => 'Enter City',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'state', array(
            'label'         => 'Billing State',
            'placeholder'   => 'Enter State (2 letter)',
            'required'      => true,
            'filters'       => array('StringTrim', 'StringToUpper'),
        ));

        $this->addElement('text', 'postal', array(
            'label'         => 'Billing Zip',
            'placeholder'   => 'Enter Postal Code',
            'required'      => true,
            'filters'       => array('StringTrim'),
            'validators'    => array(
                // 'PostCode',
            ),
        ));

        $this->addElement('text', 'country', array(
            'label'         => 'Billing Country',
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
