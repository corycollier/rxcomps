<?php
/**
 * Table Data View Helper
 *
 * This view helper aims to make it easier to access table information
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Table Data View Helper
 *
 * This view helper aims to make it easier to access table information
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Rx_View_Helper_TableData
    extends Zend_View_Helper_HtmlElement
{
    /**
     * property to hold an abstract model instance
     *
     * @var Rx_Model_Abstract
     */
    protected $_model;

    /**
     * __construct()
     *
     * Constructor
     *
     */
    public function __construct ( )
    {
        $this->_model = new Rx_Model_Abstract;
    }

    /**
     * getTable()
     *
     * Gets a given table from the _model property's ability to autoload them
     *
     * @param string $table
     * @return Zend_Db_Table_Abstract
     */
    public function getTable ($table)
    {
        $model = $this->_getModel();
        $table = $model->getTable($table);
        return $table;

    } // END function getTable

    /**
     * _getModel()
     *
     * returns the _model property
     *
     * @return Rx_Model_Abstract
     */
    protected function _getModel ()
    {
        return $this->_model;

    } // END function _getModel


} // END class Rx_View_Helper_TableData