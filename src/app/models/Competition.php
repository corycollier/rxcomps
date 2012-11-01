<?php
/**
 * Competitions Model
 *
 * This model represents individual Competitions of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Competitions Model
 *
 * This model represents individual Competitions of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_Competition
    extends Rx_Model_Abstract
{
    /**
     * create()
     *
     * Creates a single instance of a competition in the database.
     * This method was overridden so some default values could be set before
     * calling it's parent method
     *
     * @param array $values
     * @return App_Model_Competition $this for a fluent interface
     */
    public function create ($values)
    {
        $created = new Zend_Date;

        $values['created'] = $created;
        $values['updated'] = $created;

        $this->_create($values);

        $this->_saveScoring(@$values['scoring']);

        return $this;

    } // END function create


    /**
     * edit()
     *
     * Edits a single instance of a competition in the database.
     * This method was overridden so some default values could be set before
     * calling it's parent method
     *
     * @param array $values
     * @return App_Model_Competition $this for a fluent interface
     */
    public function edit ($values)
    {
        $updated = new Zend_Date;

        $values['updated'] = $updated;

        $this->_edit($values);

        $this->_saveScoring(@$values['scoring']);

        return $this;

    } // END function edit

    /**
     * load()
     *
     * Local override of the load method, to add some items to the form that
     * wouldn't otherwise be available
     *
     * @param integer $identity
     * @return App_Model_Competition $this for object-chaining
     */
    public function load ($identity)
    {
        parent::load($identity);

        $form = $this->getForm();

        $table = $this->_getScoringTable();

        $row = $table->fetchRow(sprintf('competition_id = %d', $this->id));

        $form->getElement('scoring')->setValue($row->definition);

    } // END function load

    /**
     * _saveScoring()
     *
     * Method to save the scoring associated with this competition
     *
     * @param text $definition
     * @return App_Model_Competition $this for object-chaining
     */
    protected function _saveScoring ($definition)
    {
        $table = $this->_getScoringTable();

        $row = $table->fetchRow(sprintf('competition_id = %d', $this->id));

        if (! $row) {
            $table->insert(array(
                'competition_id' => $this->id,
                'definition'    => $definition,
            ));
        } else {
            $row->definition = $definition;
            $row->save();
        }

        return $this;

    } // END function _saveScoring

    /**
     * _getScoringTable()
     *
     * Gets a new instance of the scorings table
     *
     * @return App_Model_DbTable_Scoring
     */
    protected function _getScoringTable ( )
    {
        return new App_Model_DbTable_Scoring;

    } // END function _getScoringTable

}// END class App_Model_Competitions
