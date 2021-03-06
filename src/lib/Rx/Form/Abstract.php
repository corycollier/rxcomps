<?php
/**
 * Rx Form
 *
 * This form defines the default custom functionality for forms when using the
 * Rx library
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
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
 * @category    RxComps
 * @package     Rx
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_Form_Abstract
    extends Zend_Form
{
    /**
     * __construct()
     *
     * Overriding the default constructor, so that elements can be loaded
     */
    public function __construct ( )
    {
        $this->addPrefixPath('Rx_Form_Element_', 'Rx/Form/Element/', 'element');
        $this->addPrefixPath('Rx_Form_Decorator_', 'Rx/Form/Decorator/', 'decorator');
        $this->addElementPrefixPath('Rx_Validate_', 'Rx/Validate/', 'validate');
        parent::__construct();
        $this->setStandardDecorators();

    }

    /**
     * setStandardDecorators()
     *
     * This method sets the standard decorators for forms
     */
    public function setStandardDecorators ( )
    {
        $this->setDecorators(array(
            'FormElements',
            'Fieldset',
            'Form',
        ));

    } // END function setStandardDecorators

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

    /**
     * injectDependencies()
     *
     * Inject all of a model's dependencies into this form
     *
     * @var Rx_Model_Abstract $model
     * @return Rx_Form_Abstract $this for a fluent interface
     */
    public function injectDependencies ($model)
    {

    } // END function injectDependencies

} // END class Rx_Form_Abstract