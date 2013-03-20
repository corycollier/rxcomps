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
     * List of tables that have been loaded into this model
     *
     * @var array
     */
    protected $_tables = array();

    /**
     * Property holds the autoloader to use for loading tables
     *
     * @var Zend_Loader_PluginLoader
     */
    protected $_tableAutoloader;

    /**
     * Property holds the autoloader to use for loading models
     *
     * @var Zend_Loader_PluginLoader
     */
    protected $_modelAutoloader;

    /**
     * holds a row object, which contains the currently loaded record
     *
     * @var Zend_Db_Table_Row
     */
    public $row;

    /**
     * Stores the id of the model
     *
     * @var integer
     */
    public $id;

    /**
     * __construct()
     *
     * Setup the autoloader
     */
    public function __construct()
    {
        $this->_tableAutoloader = new Zend_Loader_PluginLoader;
        $this->_modelAutoloader = new Zend_Loader_PluginLoader;

        $this->_tableAutoloader
            ->addPrefixPath('Rx_Model_DbTable', ROOT_PATH . '/lib/Rx/Model/DbTable')
            ->addPrefixPath('App_Model_DbTable', APPLICATION_PATH . '/models/DbTable/');

        $this->_modelAutoloader
            ->addPrefixPath('Rx_Model', ROOT_PATH . '/lib/Rx/Model/')
            ->addPrefixPath('App_Model', APPLICATION_PATH . '/models/');

    } // END function __construct

    /**
     * getName()
     *
     * gets the short-hand name of the model
     *
     * @return string
     */
    public function getName ( )
    {
        $classNameParts = explode('_', get_class($this));

        return end($classNameParts);

    } // END function getName

    /**
     * getValue()
     *
     * Gets the value from the internal form, for a given property name
     *
     * @param string $name
     * @return string
     */
    public function getValue ($name)
    {
        $form = $this->getForm();

        return $form->getValue($name);

    } // END function getValue

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

    // /**
    //  * getTable()
    //  *
    //  * Gets the table, which is loosely tied to this model
    //  *
    //  * @return Zend_Db_Table_Abstract
    //  */
    // public function getTable ($name = null, $forceNew = false)
    // {
    //     $class = get_class($this);
    //     $class = strtr($class, array(
    //         '_Model_' => '_Model_DbTable_',
    //     ));

    //     if ($name) {
    //         $parts = explode('_', $class);
    //         $last = count($parts) - 1;
    //         $parts[$last] = $name;
    //         $class = implode('_', $parts);
    //         return new $class;
    //     }

    //     if (! $this->_table || $forceNew) {
    //         $this->_table = new $class;
    //     }

    //     return $this->_table;

    // } // END function getTable


    /**
     * getTable()
     *
     * Returns the first instance of a DbTable class that matches the shortName given
     *
     * @param string $shortName
     * @return D2E_Db_Table_Abstract
     */
    public function getTable ($shortName = null, $forceNew = false)
    {
        // if (! array_key_exists($shortName, $this->_tables) || $forceNew) {
        //     $this->_tables[$shortName] = new $table;
        // }

        if (! $shortName) {
            $class = get_class($this);
            $class = strtr($class, array(
                '_Model_' => '_Model_DbTable_',
            ));
            $parts = explode('_', $class);
            $shortName = end($parts);
        }

        $table = $this->_tableAutoloader->load($shortName);

        if (! array_key_exists($table, $this->_tables) || $forceNew) {
            $this->_tables[$table] = new $table;
        }

        return $this->_tables[$table];

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

        $row = $dbTable->fetchRow($select->where('id = ?', $identity));

        if ($row) {
            $this->fromRow($row);
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
        return $this->_edit($values);

    } // END function edit

    /**
     * _edit()
     *
     * Where the bulk of the work happens
     *
     * @param array $values
     * @return Rx_Model_Abstract $this for object chaining
     */
    protected function _edit ($values = array())
    {
        $dbTable = $this->getTable();
        $form = $this->getForm();

        if (! $form->isValid($values)) {
            throw new Rx_Model_Exception(self::EXCEPTION_INVALID_DATA);
        }

        $values = $form->getValues();

        $dbTable->update($values, sprintf('id = %d', $this->id));

        return $this;

    } // END function _edit

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
        return $this->_create($values);

    } // END function create

    /**
     * _create()
     *
     * Does the bulk of the creating work
     *
     * @param array $values
     * @return Rx_Model_Abstract $this for object chaining
     */
    protected function _create ($values = array())
    {
        $dbTable = $this->getTable();
        $form = $this->getForm();

        if (! $form->isValid($values)) {
            var_dump(get_class($form));
            die;

            throw new Rx_Model_Exception(self::EXCEPTION_INVALID_DATA);
        }

        $values = $form->getValues();

        try {
            $this->id = $dbTable->insert($values);
        } catch (Zend_Db_Statement_Exception $exception) {
            var_dump($exception); die;
            // var_dump($values); die;
        }

        return $this;

    } // END function _create

    /**
     * delete()
     *
     * Delets the model by it's current id value
     */
    public function delete ( )
    {
        $this->_delete();

    } // END function delete

    /**
     * _delete()
     *
     * Does the bulk of the work for deleting
     */
    protected function _delete ( )
    {
        if (! $this->id) {
            throw new Rx_Model_Exception(self::EXCEPTION_DELETE_CONSTRAINT);
        }

        $dbTable = $this->getTable();
        $select = $dbTable->select();

        $dbTable->delete(sprintf('id = %d', $this->id));

    } // END function _delete

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
        return $this->getTable()->filterValues($values);

    } // END function filterValues

    /**
     * paginate()
     *
     * get a paginated set of data
     *
     * @return array
     */
    public function paginate ($params)
    {
        $dbTable    = $this->getTable();
        $paginator  = $dbTable->getPaginationAdapter($params);

        $page = @$params['page'] ? $params['page'] : 1;
        $count = @$params['count'] ? $params['count'] : 20;

        $offset = ($page - 1) * $count;

        return $paginator->getItems($offset, $count);

    } // END function paginate

    /**
     * getParent()
     *
     * Shortens up the ability to get parent rows for a given row
     *
     * @param string $shortName
     * @return Zend_Db_Table_Row
     */
    public function getParent ($shortName)
    {
        $fullTableName = sprintf('App_Model_DbTable_%s', $shortName);
        $fullModelName = sprintf('App_Model_%s', $shortName);
        $model = new $fullModelName;

        if ($this->row) {
            $parentRow = $this->row->findParentRow($fullTableName);
            $model->fromRow($parentRow);
        }

        return $model;

    } // END function getParent

    /**
     * getChildren()
     *
     * Gets the child models of this one
     *
     * @return ArrayObject
     */
    public function getChildren ($shortName)
    {
        $result = new ArrayObject;

        $fullTableName = sprintf('App_Model_DbTable_%s', $shortName);
        $fullModelName = sprintf('App_Model_%s', $shortName);

        $rowset = $this->row->findDependentRowset($fullTableName);

        foreach ($rowset as $row) {
            $model = new $fullModelName;
            $model->fromRow($row);
            $result[] = $model;
        }

        return $result;

    } // END function getChildren

    /**
     * fromRow()
     *
     * Populates a model from a row object
     *
     * @param Zend_Db_Table_Row
     * @return Rx_Model_Abstract $this for object chaining
     */
    public function fromRow ($row)
    {
        $this->row = $row;
        $this->getForm()->populate($row->toArray());
        $this->id = $row->id;

    } // END function fromRow

} // END class Rx_Model_Abstract