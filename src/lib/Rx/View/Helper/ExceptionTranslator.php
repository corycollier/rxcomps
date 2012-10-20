<?php
/**
 * Exception Translator
 *
 * This action helper serves to translate exceptions to better serve the end user
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Exception Translator
 *
 * This action helper serves to translate exceptions to better serve the end user
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_View_Helper_ExceptionTranslator
    extends Zend_View_Helper_Abstract
{
    /**
     * Property to store a map of exception classes and codes to appropriate messages
     *
     * @var array
     */
    protected $_map = array(
        // 'Zend_Db_Statement_Exception' => array(
        //     23000    => 'This data already exists',
        // ),

        // 'Zend_Exception' => array(
        //     23000    => 'This data already exists',
        // ),
    );

    /**
     * exceptionTranslator()
     *
     * Main entry point into the view helper
     *
     * @param Zend_Exception $exception
     * @return string
     */
    public function exceptionTranslator (Zend_Exception $exception)
    {
        $class = get_class($exception);
        $code = $exception->getCode();

        return @$this->_map[$class][$code]
            ? $this->_map[$class][$code]
            : $exception->getMessage();

    } // END function exceptionTranslator

} // END class Rx_View_Helper_ExceptionTranslator