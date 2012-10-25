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

        $this->addElement('select', 'event', array(
            'label'         => 'Event',
            'placeholder'   => 'Select Event',
            'required'      => true,
        ));

        $this->addElement('submit', 'save', array(
            'label'         => 'Save',
            'ignore'        => true,
        ));

    }

} // END class App_Form_Competition