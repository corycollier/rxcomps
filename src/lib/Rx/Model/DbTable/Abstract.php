<?php
/**
 * Base Model DbTable
 *
 * This class should provide all of the custom functionality that will be shared
 * for all applications that utilize the Rx library
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Model_DbTable
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Base Model DbTable
 *
 * This class should provide all of the custom functionality that will be shared
 * for all applications that utilize the Rx library
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Model_DbTable
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_Model_DbTable_Abstract
    extends Zend_Db_Table_Abstract
{
    /**
     * single instance of the paginator per table
     *
     * @var Zend_Paginator_Adapter_DbTableSelect
     */
    protected $_paginator;

    /**
     * getPaginationAdapter()
     *
     * Gets a single instance of a DbTableSelect pagination adapter
     *
     * @return Zend_Paginator_Adapter_DbTableSelect
     */
    public function getPaginationAdapter ($params = array())
    {
        if (! $this->_paginator || $params) {
            $this->_paginator = new Zend_Paginator_Adapter_DbTableSelect(
                $this->buildWhere($params)
            );
        }

        return $this->_paginator;

    } // END function getPaginationAdapter

    /**
     * buildWhere()
     *
     * Builds a where statement from an associative array
     *
     * @param array $data
     * @return Zend_Db_Table_Select
     */
    public function buildWhere ($data = array())
    {
        $select = $this->select();
        $values = $this->filterValues(array_diff_key($data, array('id' => null)));

        foreach ($values as $key => $value) {
            $select->where(sprintf("{$key} = '%s'", $value));
        }

        return $select;

    } // END function buildWhere

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
        $info = $this->info();
        $columns = array_flip($info['cols']);

        return array_intersect_key($values, $columns);

    } // END function filterValues

    /**
     * insert()
     *
     * Overriding the insert method to ensure that values to this table are
     * filtered by the schema first
     *
     * @param array $values
     *
     */
    public function insert ($values)
    {
        return parent::insert($this->filterValues($values));

    } // END function insert

    /**
     * update()
     *
     * Overriding the update method to ensure that values to this table are
     * filtered by the schema first
     *
     * @param array $values
     *
     */
    public function update ($values, $where = null)
    {
        return parent::update($this->filterValues($values), $where);

    } // END function update

} // END class Rx_Model_DbTable_Abstract