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
     * Message to indicate that the requested autoloader is not valid
     */
    const INVALID_LOADER = '%s - This loader is not recognized';

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
     * Property holds a collection of autoloaders
     *
     * @var array
     */
    protected $_loaders = array(
        'table' => null,
        'model' => null,
        'form'  => null,
    );

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
        foreach ($this->_loaders as $type => $loader) {
            $this->_loaders[$type] = new Zend_Loader_PluginLoader;
        }

        $this->getLoader('table')
            ->addPrefixPath('Rx_Model_DbTable', ROOT_PATH . '/lib/Rx/Model/DbTable')
            ->addPrefixPath('App_Model_DbTable', APPLICATION_PATH . '/models/DbTable/');

        $this->getLoader('model')
            ->addPrefixPath('Rx_Model', ROOT_PATH . '/lib/Rx/Model/')
            ->addPrefixPath('App_Model', APPLICATION_PATH . '/models/');

        $this->getLoader('form')
            ->addPrefixPath('Rx_Form', ROOT_PATH . '/lib/Rx/Form/')
            ->addPrefixPath('App_Form', APPLICATION_PATH . '/forms/');

    } // END function __construct

    /**
     * getLoader()
     *
     * Gets the autoloader for a given type
     *
     * @param string $type
     * @return Zend_Loader_PluginLoader
     * @throws Rx_Model_Exception if the type requested doesn't exist
     */
    public function getLoader ($type)
    {
        $type = strtolower($type);
        if (! array_key_exists($type, $this->_loaders)) {
            throw new Rx_Model_Exception(self::INVALID_LOADER);
        }

        return $this->_loaders[$type];

    } // END function getLoader

    /**
     * getName()
     *
     * gets the short-hand name of the model
     *
     * @return string
     */
    public function getName ( )
    {
        return $this->_getShortName(get_class($this));

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
            $shortName = $this->_getShortName(get_class($this));
            $class = $this->getLoader('form')->load($shortName);
            $this->_form = new $class;
        }

        return $this->_form;

    } // END function getForm()

    /**
     * _getShortName()
     *
     * Method to get the short name of a given class
     *
     * @param string $class
     * @return string
     */
    protected function _getShortName ($class)
    {
        $parts = explode('_', $class);
        $shortName = end($parts);

        return $shortName;

    } // END function _getShortName

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
        $shortName = $shortName
            ? $shortName
            : $this->_getShortName(get_class($this));

        $table = $this->getLoader('table')->load($shortName);

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
     * @return Rx_Model_Abstract|boolean $this for a fluent interface
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

        $dbTable->update($values, sprintf('id = %d', $this->id));

        return $this;

    } // END function _edit

    /**
     * create()
     *
     * Creates a record of the model
     *
     * @param array $values
     * @return Rx_Model_Abstract|boolean $this for a fluent interface
     */
    public function create ($values = array())
    {
        unset($values['id']);
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
        unset($values['id']);
        $dbTable = $this->getTable();

        $this->id = $dbTable->insert($values);

        $this->load($this->id);

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
        $fullTableName = $this->getLoader('table')->load($shortName);
        $fullModelName = $this->getLoader('model')->load($shortName);
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
        if (!$this->row) {
            return $result;
        }

        $fullTableName = $this->getLoader('table')->load($shortName);
        $rowset = $this->row->findDependentRowset($fullTableName);

        foreach ($rowset as $row) {
            $model = $this->getModel($shortName);
            $model->fromRow($row);
            $result[] = $model;
        }

        return $result;

    } // END function getChildren

    /**
     * getModel()
     *
     * Gets a new model instance
     *
     * @param  string $shorName
     * @return Rx_Model_Abstract a new instance of the model
     */
    public function getModel ($shortName)
    {
        $class = $this->getLoader('model')->load($shortName);
        $model = new $class;
        return $model;

    } // END function getModel

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
        if (! $row) {
            return;
        }
        $this->row = $row;
        $this->getForm()->populate($row->toArray());
        $this->id = $row->id;

    } // END function fromRow

} // END class Rx_Model_Abstract