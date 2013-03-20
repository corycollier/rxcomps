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

        $this->addElement('select', 'gender', array(
            'label'         => 'Gender',
            'placeholder'   => 'Select Gender',
            'required'      => true,
            'filters'       => array('StringTrim', 'StringToLower'),
            'multiOptions'  => array(
                'male'      => 'Male',
                'female'    => 'Female',
                'team'      => 'Team',
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
        $table = $model->getParent('Scale')->getTable();

        $scales = $table->fetchAll(
            $table->select()
                ->where(sprintf('event_id = %d', @$params['event_id']))
        );

        $element = $this->getElement('scale_id');

        foreach ($scales as $scale) {
            $element->addMultiOption($scale->id, $scale->name);
        }

        return $this;

    } // END function _insertScales

    /**
     * isValid()
     *
     * Local override of the isValid method, to ensure that options are set
     * on the multi-option elements
     *
     * @param array $values
     * @return boolean
     */
    public function isValid ($values = array(), $context = null)
    {
        // $element = $this->getElement('scale_id');
        // if (!$element->getMultiOptions()) {
        //     $this->_insertScales(new App_Model_Athlete, $values);
        // }

        //     var_dump($values);
        $result = parent::isValid($values, $context);

        if (! $result) {
            var_dump($this->getValues());
            var_dump($values);
            die;

        }

        return $result;

    } // END function isValid

} // END class App_Form_Athlete