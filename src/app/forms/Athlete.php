<?php
/**
 * Athlete Form
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
 * Athlete Form
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

class App_Form_Athlete
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

        $this->addElement('select', 'gender', array(
            'label'         => 'Gender',
            'placeholder'   => 'Select Gender',
            'required'      => true,
            'filters'       => array('StringTrim', 'StringToLower'),
            'multiOptions'  => array(
                'male'      => 'Male',
                'female'    => 'Female',
                'team'      => 'Team'
            ),
        ));

        $this->addElement('select', 'event_id', array(
            'label'         => 'Event',
            'placeholder'   => 'Select Event',
            'required'      => true,
        ));

        $this->addElement('select', 'scale_id', array(
            'label'         => 'Scale',
            'placeholder'   => 'Select Scale',
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
        $this->_insertEvents($model, $params);
        $this->_insertScales($model, $params);

        return $this;

    } // END function injectDependencies

    /**
     * _insertEvents()
     *
     * Inserts event options into the event_id form element
     *
     * @param App_Model_Athlete $model
     * @param array $params
     * @return App_Form_Athlete $this for object-chaining
     */
    protected function _insertEvents ($model, $params = array())
    {
        $events = $model->getParent('Event')->getTable()->fetchAll();

        $element = $this->getElement('event_id');

        foreach ($events as $event) {
            $element->addMultiOption($event->id, $event->name);
        }

        return $this;

    } // END function _insertEvents

    /**
     * _insertScales()
     *
     * Inserts scales options into the scale_id form element
     *
     * @param App_Model_Athlete $model
     * @param array $params
     * @return App_Form_Athlete $this for object-chaining
     */
    protected function _insertScales ($model, $params = array())
    {
        $scales = $model->getParent('Scale')->getTable()->fetchAll();

        $element = $this->getElement('scale_id');

        foreach ($scales as $scale) {
            $element->addMultiOption($scale->id, $scale->name);
        }

        return $this;

    } // END function _insertScales

} // END class App_Form_Athlete