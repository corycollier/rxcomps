<?php
/**
 * Registration Form
 *
 * This form contains the input filtering and validating definitions for requests
 * to either create, or edit an event
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Registration Form
 *
 * This form contains the input filtering and validating definitions for requests
 * to either create, or edit an event
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Form_Registration
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Local implementation of the init hook
     */
    public function init ( )
    {
        // $this->addElement('select', 'role', array(
        //     'label'         => 'Role',
        //     'placeholder'   => 'Select Role',
        //     'required'      => true,
        //     'filters'       => array('StringTrim', 'StringToLower'),
        //     'multiOptions'  => array(
        //         'user'      => 'Athlete',
        //         'judge'     => 'Judge',
        //     ),
        // ));

        // $form = new Zend_Form_SubForm;
        $this->addElement('hidden', 'role', array(
            'value' => 'user',
        ));

        // $this->addSubForm($form, 'registration');
        $this->addSubForm($this->getUserForm(), 'user');
        $this->addSubForm($this->getAthleteForm(), 'athlete');
        $this->addSubForm($this->getCreditCardForm(), 'credit_card');

        // $form = new Zend_Form_SubForm;
        $this->addElement('hidden', 'id', array(
            'ignore'        => true,
        ));

        $this->addElement('hidden', 'user_id', array(
            'required'      => false,
        ));

        $this->addElement('hidden', 'event_id', array(
            'required'      => true,
        ));

        $this->addElement('hidden', 'athlete_id', array(
            'required'      => false,
        ));

        $this->addElement('submit', 'save', array(
            'label'         => 'Save',
            'ignore'        => true,
        ));

    } // END function init

    /**
     * getUserForm()
     *
     * Gets a User form instance
     *
     * @return App_Form_User
     */
    public function getUserForm ( )
    {
        $form = new App_Form_User;
        $form->removeDecorator('Form');
        $form->removeElement('save');
        $form->removeDecorator('Fieldset');
        $form->setIsArray(true);
        $form->setElementsBelongTo('user');
        return $form;

    } // END function getUserForm

    /**
     * getAthleteForm()
     *
     * Gets an Athlete form instance
     *
     * @return App_Form_Athlete
     */
    public function getAthleteForm ( )
    {
        $form = new App_Form_Athlete;
        $form->removeDecorator('Form');
        $form->removeElement('save');
        $form->getDecorator('Fieldset')->setLegend('Registration Information');
        $form->setIsArray(true);
        $form->setElementsBelongTo('athlete');
        return $form;

    } // END function getAthleteForm

    /**
     * getCreditCardForm()
     *
     * Gets a Credit Card form instance
     *
     * @return App_Form_CreditCard
     */
    public function getCreditCardForm ( )
    {
        $form = new App_Form_CreditCard;
        $form->removeDecorator('Form');
        $form->removeElement('save');
        $form->getDecorator('Fieldset')->setLegend('Billing Information');
        $form->setIsArray(true);
        $form->setElementsBelongTo('credit_card');
        return $form;

    }

    /**
     * injectDependencies()
     *
     * Inject all of a model's dependencies into this form
     *
     * @var Rx_Model_Abstract $model
     * @return Rx_Form_Abstract $this for a fluent interface
     */
    public function injectDependencies ($model, $params = array())
    {
        // if the user is logged in, remove the add user form
        $authInfo = $this->getAuth()->getStorage()->read();
        if ($authInfo) {
            $this->getElement('user_id')->setValue($authInfo->id);
            $this->removeSubForm('user');
        }

        // inject the athlete model dependencies
        $athleteSubForm = $this->getSubForm('athlete');
        if ($athleteSubForm) {
            $this->getSubForm('athlete')
                ->injectDependencies($model->getParent('Athlete'), $params);
        }

    } // END function injectDependencies

    /**
     * _getAuth
     *
     * Gets the global authentication
     *
     * @return Zend_Auth
     */
    protected function getAuth ( )
    {
        return Zend_Auth::getInstance();

    } // END function _getAuth

} // END class App_Form_Registration