<?php
/**
 * CSV View Helper
 *
 * This view helper accepts an array of information and returns a csv formatted
 * string
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       File available since release 2.1.0
 * @filesource
 */

/**
 * CSV View Helper
 *
 * This view helper accepts an array of information and returns a csv formatted
 * string
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 */

class Rx_View_Helper_Csv
    extends Zend_View_Helper_Abstract
{
    /**
     * csv()
     *
     * Main entry point for the view helper to return a string
     *
     * @param array $data
     * @return string
     */
    public function csv ($data = array())
    {
        $headers = array_keys($data[0]);

        $result = sprintf('"%s"', implode('", "', $this->_filter($headers)));

        foreach ($data as $values) {
            $result .=  sprintf(PHP_EOL . '"%s"', implode('", "', $this->_filter($values)));
        }

        return $result;

    } // END funciton csv

    /**
     * _filter()
     *
     * Method to filter a string
     *
     * @param string $string
     * @return string
     */
    protected function _filter ($data)
    {
        foreach ($data as $i => $datum) {
            $data[$i] = strtr($datum, array(
                PHP_EOL => '',
                '"'     => '',
            ));
        }

        return $data;

    } // END function _filter

} // END class Rx_View_Helper_Csv