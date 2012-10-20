<?php
/**
 * Rx Form
 *
 * This form defines the default custom functionality for forms when using the
 * Rx library
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Rx Form
 *
 * This form defines the default custom functionality for forms when using the
 * Rx library
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_Form_Abstract
    extends Zend_Form
{
    /**
     * getButtonSubForm()
     *
     * Get's a subform containing submit and reset buttons
     *
     * @return Zend_Form_SubForm
     */
    public function getButtonSubForm ( )
    {
        $form = $this->buildSubForm();

        $form->addElement('reset', 'reset', array(
            'label'     => '',
            'ignore'    => true,
        ));

        $form->addElement('submit', 'submit', array(
            'label'     => 'Submit',
            'ignore'    => true,
        ));

        $form->setDecorators(array(
            'FormElements',
            'Fieldset',
        ));

        $form->setElementDecorators(array(
            'ViewHelper',
        ));

        $form->getDecorator('Fieldset')->setOption('class', 'buttons');

        return $form;

    } // END function getButtonSubForm

    /**
     * buildSubForm()
     *
     * Method to get a new instance of a subform
     *
     * @return Zend_Form
     */
    public function buildSubForm ( )
    {
        return new Zend_Form_SubForm;

    } // END function buildSubForm

} // END class Rx_Form_Abstract