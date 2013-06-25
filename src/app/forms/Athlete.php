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

        $this->addElement('text', 'gym', array(
            'label'         => 'Gym',
            'placeholder'   => 'Enter gym name',
            'required'      => true,
            'filters'       => array('StringTrim'),
        ));

        $this->addElement('text', 'given_id', array(
            'label'         => 'Athlete ID',
            'placeholder'   => 'Enter the athlete id',
            'required'      => false,
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
                // 'team'      => 'Team',
            ),
        ));

        $this->addElement('hidden', 'event_id', array(
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
    public function injectDependencies ($model, $params = array())
    {
        $this->_insertScales($model, $params);

        $element = $this->getElement('event_id');

        if ($element) {
            $element->setValue(@$params['event_id']);
        }

        return $this;

    } // END function injectDependencies

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
        $scale = $model->getParent('Scale');
        $table = $scale->getTable();

        $scales = $table->getScalesByEventId(@$params['event_id']);

        $element = $this->getElement('scale_id');

        $table = $model->getTable('Athlete');

        $disable = array();

        foreach ($scales as $scale) {
            $athleteCount = $table->getScaleCount($scale->id);

            $spotsLeft = (int)$scale->max_count - (int)$athleteCount;
            $element->addMultiOption($scale->id, sprintf(
                '%s ($%0.2f) (%d %s left)',
                $scale->name,
                $scale->price,
                max(0, $spotsLeft),
                $spotsLeft == 1 ? 'spot' : 'spots'
            ));

            if ($spotsLeft < 1) {
                $disable[] = $scale->id;
            }
        }

        $element->setAttrib('disable', $disable);

        return $this;

    } // END function _insertScales

} // END class App_Form_Athlete