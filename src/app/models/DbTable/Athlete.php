<?php
/**
 * Athletes Database Table
 *
 * This model represents a database table of athletes to the application
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
 * Athletes Database Table
 *
 * This model represents a database table of athletes to the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_DbTable_Athlete
    extends Rx_Model_DbTable_Abstract
{
    /**
     * The name of the database table to use for this class
     *
     * @var string
     */
    protected $_name = 'athletes';

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

} // END class App_Model_DbTable_Athletes