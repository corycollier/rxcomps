<?php
/**
 * Score Form
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
 * Score Form
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

class App_Form_Score
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

        $this->addElement('text', 'score', array(
            'label'         => 'Score',
            'placeholder'   => 'Enter Score',
            'required'      => true,
            'filters'       => array('StringTrim', 'Digits'),
        ));

        $this->addElement('select', 'athlete_id', array(
            'label'         => 'Athlete',
            'placeholder'   => 'Select Athlete',
            'required'      => true,
        ));

        $this->addElement('select', 'competition_id', array(
            'label'         => 'Competition',
            'placeholder'   => 'Select Competition',
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
        // athletes
        $athletesTable = $model->getParent('Athlete')->getTable();
        $athletes = $athletesTable->fetchAll(
            $athletesTable->buildWhere($params)
        );

        $element = $this->getElement('athlete_id');

        foreach ($athletes as $athlete) {
            $element->addMultiOption($athlete->id, $athlete->name);
        }

        // competitions
        $competitionsTable = $model->getParent('Competition')->getTable();
        $competitions = $competitionsTable->fetchAll(
            $competitionsTable->buildWhere($params)
        );

        $element = $this->getElement('competition_id');

        foreach ($competitions as $competition) {
            $element->addMultiOption($competition->id, $competition->name);
        }

    } // END function injectDependencies

} // END class App_Form_Score