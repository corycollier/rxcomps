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
     * unitTestCheck()
     *
     * Because XDebug doesn't provide code coverage metrics for classes that are
     * empty, we provide a simple method to allow verification that the class
     * is, in fact, code covered
     *
     * @return string
     */
    public function unitTestCheck ( )
    {
        return 'unit test check';
    }

} // END class Rx_Model_DbTable_Abstract