<?php
/**
 * Scale Form
 *
 * This form contains the input filtering and validating definitions for requests
 * to either create, or edit an Scale
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
 * Scale Form
 *
 * This form contains the input filtering and validating definitions for requests
 * to either create, or edit an Scale
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Form_Scale
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Local implementation of the init hook
     */
    public function init ( )
    {
        $this->addElement('hidden', 'id', array(
            'ignore'        => true,
        ));

        $this->addElement('text', 'name', array(
            'label'         => 'Name',
            'placeholder'   => 'Enter name',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'code', array(
            'label'         => 'Code',
            'placeholder'   => 'Enter short code',
            'required'      => true,
            'filters'       => array('StringTrim', 'Alpha'),
        ));

        $this->addElement('select', 'event_id', array(
            'label'         => 'Event',
            'placeholder'   => 'Select Event',
            'required'      => true,
        ));

        $this->addElement('numeric', 'max_count', array(
            'label'         => 'Slots Available',
            'placeholder'   => 'Max Participants',
            'required'      => true,
            'filters'       => array('StringTrim'),
            'class'         => 'numeric input',
        ));

        $this->addElement('numeric', 'price', array(
            'label'         => 'Price',
            'placeholder'   => 'Price of registration',
            'required'      => true,
            'filters'       => array('StringTrim'),
            'class'         => 'numeric input',
        ));

        $this->addElement('text', 'remote_id', array(
            'label'         => 'Remote ID',
            'placeholder'   => 'Enter remote ide',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('submit', 'save', array(
            'label'         => 'Save',
            'ignore'        => true,
        ));

        $this->setStandardDecorators();

    } // END function init

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
        $events = $model->getParent('Event')->getTable()->fetchAll();

        $element = $this->getElement('event_id');

        foreach ($events as $event) {
            $element->addMultiOption($event->id, $event->name);
        }

    } // END function injectDependencies

} // END class App_Form_Scale