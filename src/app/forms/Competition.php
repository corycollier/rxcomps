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
        /**
          `id` INT NOT NULL AUTO_INCREMENT ,
          `name` VARCHAR(255) NOT NULL ,
          `description` TEXT NULL ,
          `date` TIMESTAMP NOT NULL DEFAULT 0 ,
          `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ,
          `updated` TIMESTAMP NOT NULL DEFAULT 0 ,
          `event_id` INT NOT NULL ,
          `goal` ENUM('time', 'amrap', 'max') NOT NULL DEFAULT 'time' ,
        */

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

    }

} // END class App_Form_Competition