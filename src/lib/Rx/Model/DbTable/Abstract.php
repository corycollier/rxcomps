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
    public function getPaginationAdapter ( )
    {
        if (! $this->_paginator) {
            $this->_paginator = new Zend_Paginator_Adapter_DbTableSelect(
                $this->select()
            );
        }

        return $this->_paginator;

    } // END function getPaginationAdapter

} // END class Rx_Model_DbTable_Abstract