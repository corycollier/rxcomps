<?php
/**
 * Event Form
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
 * Event Form
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

class App_Form_Event
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Local implementation of the init hook
     */
    public function init ( )
    {
        $this->addElement('text', 'name', array(
            'label'         => 'Name',
            'placeholder'   => 'Enter name',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('textarea', 'description', array(
            'label'         => 'Description',
            'placeholder'   => 'Enter description',
            'required'      => true,
        ));

        $this->addElement('submit', 'save', array(
            'label'         => 'Save',
            'ignore'        => true,
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

} // END class App_Form_Event