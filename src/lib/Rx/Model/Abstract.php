<?php
/**
 * Base Model Class
 *
 * This model serves as the standard for all application models
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Base Model Class
 *
 * This model serves as the standard for all application models
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_Model_Abstract
{
    /**
     * Message to indicate that the data provided is invalid
     */
    const EXCEPTION_INVALID_DATA = 'The data provided is not valid';

    /**
     * Message to indicate that the id wasn't set on the model before a delete was attempted
     */
    const EXCEPTION_DELETE_CONSTRAINT = 'The id must be set on the model before deletion';

    /**
     * Property to hold an instance of the form associated with this model
     *
     * @var Rx_Form
     */
    protected $_form;

    /**
     * Property to hold an instance of the table class associated with this model
     *
     * @var Zend_Db_Table_Abstract
     */
    protected $_table;

    /**
     * Stores the id of the model
     *
     * @var integer
     */
    public $id;

    /**
     * getForm()
     *
     * Gets the form, which is loosely tied to this model
     *
     * @return Rx_Form
     */
    public function getForm ($forceNew = false)
    {
        if (! $this->_form || $forceNew) {
            $class = get_class($this);
            $class = strtr($class, array(
                '_Model_' => '_Form_',
            ));
            $this->_form = new $class;
        }

        return $this->_form;

    } // END function getForm()

    /**
     * getTable()
     *
     * Gets the table, which is loosely tied to this model
     *
     * @return Zend_Db_Table_Abstract
     */
    public function getTable ($forceNew = false)
    {
        if (! $this->_table || $forceNew) {
            $class = get_class($this);
            $class = strtr($class, array(
                '_Model_' => '_Model_DbTable_',
            ));
            $this->_table = new $class;
        }

        return $this->_table;

    } // END function getTable

    /**
     * load()
     *
     * Loads the record by identity
     */
    public function load ($identity)
    {
        $dbTable = $this->getTable();
        $select = $dbTable->select();
        $form = $this->getForm();

        $row = $dbTable->fetchRow($select->where('id = ?', $identity));

        if ($row) {
            $this->id = $identity;
            $form->populate($row->toArray());
        }

        return $this;

    } // END function load

    /**
     * edit()
     *
     * Updates the existing item
     *
     * @param array $values
     * @return Rx_Model_Abstract $this for a fluent interface
     */
    public function edit ($values = array())
    {
        $dbTable = $this->getTable();
        $form = $this->getForm();

        if (! $form->isValid($values)) {
            throw new Rx_Model_Exception(self::EXCEPTION_INVALID_DATA);
        }

        $values = $form->getValues();

        $dbTable->update($values, sprintf('id = %d', $this->id));

        return $this;

    } // END function edit

    /**
     * create()
     *
     * Creates a record of the model
     *
     * @param array $values
     * @return Rx_Model_Abstract $this for a fluent interface
     */
    public function create ($values = array())
    {
        $dbTable = $this->getTable();
        $form = $this->getForm();

        if (! $form->isValid($values)) {
            throw new Rx_Model_Exception(self::EXCEPTION_INVALID_DATA);
        }

        $values = $form->getValues();
        $this->id = $dbTable->insert($values);

        return $this;

    } // END function create

    /**
     * delete()
     *
     * Delets the model by it's current id value
     */
    public function delete ( )
    {
        if (! $this->id) {
            throw new Rx_Model_Exception(self::EXCEPTION_DELETE_CONSTRAINT);
        }

        $dbTable = $this->getTable();

        $select = $dbTable->select();

        $dbTable->delete($select->where('id = ?', $this->id));

    } // END function delete

    /**
     * filterValues()
     *
     * Method to filter values provided to only what's recognized by this
     * model's table schema
     *
     * @param array $values
     * @return array
     */
    public function filterValues ($values = array())
    {
        $info = $this->getTable()->info();

        $columns = array_flip($info['cols']);

        return array_intersect_key($values, $columns);

    } // END function filterValues

} // END class Rx_Model_Abstract