<?php
/**
 * Competition Form
 *
 * This form allows for the editing of data related to competitions in an event
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
 * Competition Form
 *
 * This form allows for the editing of data related to competitions in an event
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Form
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Form_Competition
    extends Rx_Form_Abstract
{
    /**
     * init()
     *
     * Setting up the form elements for the competition form
     */
    public function init ( )
    {
        $this->addElement('hidden', 'id', array(
            'ignore'        => true,
        ));

        $this->addElement('select', 'goal', array(
            'label'         => 'Goal',
            'placeholder'   => 'Select goal',
            'required'      => true,
            'filters'       => array('StringTrim', 'StringToLower'),
            'multiOptions'  => array(
                'time'  => 'Time',
                'amrap' => 'AMRAP',
                'max'   => 'Max'
            ),
        ));

        $this->addElement('text', 'name', array(
            'label'         => 'Name',
            'placeholder'   => 'Enter name',
            'required'      => true,
            'filters'       => array('StringTrim', 'StringToLower'),
        ));

        $this->addElement('textarea', 'description', array(
            'label'         => 'Description',
            'placeholder'   => 'Enter description',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('select', 'event_id', array(
            'label'         => 'Event',
            'placeholder'   => 'Select Event',
            'required'      => true,
        ));

        $this->addElement('radio', 'scoring_type', array(
            'label'         => 'Scoring Type',
            'label_class'   => 'form-radio',
            'separator'     => PHP_EOL,
            'multiOptions'  => array(
                'points'    => 'Points',
                'rank'      => 'Rank',
            ),
            'class'         => 'toggle-scoring-type',
        ));

        $this->addElement('textarea', 'scoring', array(
            'label'         => 'Scoring System',
            'placeholder'   => implode(' ', array(
                'Enter the points for each rank, in order of first to last.',
                'Separate each rank/points with a newline'
            )),
            'filters'       => array('StringTrim'),
            'class'         => 'hidden scoring-type-points',
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
        $eventsTable = $model->getParent('Event')->getTable();
        $events = $eventsTable->fetchAll(
            $eventsTable->buildWhere(array_diff_key($params, array(
                'description'   => null,
                'name'          => null,
            )))
        );

        $element = $this->getElement('event_id');

        foreach ($events as $event) {
            $element->addMultiOption($event->id, $event->name);
        }

    } // END function injectDependencies

} // END class App_Form_Competition