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
        $this->_insertAthletes($model, $params);
        $this->_insertCompetitions($model, $params);

        return $this;

    } // END function injectDependencies

    /**
     * _insertAthletes()
     *
     * Populate the selection of athletes form element
     *
     * @var Rx_Model_Abstract $model
     * @return Rx_Form_Abstract $this for a fluent interface
     */
    protected function _insertAthletes ($model, $params = array())
    {
        // athletes
        $table = $model->getParent('Athlete')->getTable();
        $athletes = $table->fetchAll(
            $table->buildWhere($params)
        );

        $element = $this->getElement('athlete_id');

        foreach ($athletes as $athlete) {
            $element->addMultiOption($athlete->id, $athlete->name);
        }

    } // END function _insertAthletes

    /**
     * _insertCompetitions()
     *
     * Populate the selection of competitions form element
     *
     * @var Rx_Model_Abstract $model
     * @return Rx_Form_Abstract $this for a fluent interface
     */
    protected function _insertCompetitions ($model, $params = array())
    {
        // athletes
        $table = $model->getParent('Competition')->getTable();
        $competitions = $table->fetchAll(
            $table->buildWhere($params)
        );

        $element = $this->getElement('competition_id');

        foreach ($competitions as $competition) {
            $element->addMultiOption($competition->id, $competition->name);
        }

    } // END function _insertCompetitions

} // END class App_Form_Score