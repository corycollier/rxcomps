<?php
/**
 * Time To Seconds
 *
 * Filter to translate a time entry into seconds, instead of the standard
 * hh:mm:ss format
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Filter
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Time To Seconds
 *
 * Filter to translate a time entry into seconds, instead of the standard
 * hh:mm:ss format
 *
 * @category    RxCompetition
 * @package     Rx
 * @subpackage  Filter
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_Filter_TimeToSeconds
    implements Zend_Filter_Interface
{
    /**
     * filter()
     *
     * Implementation of the filter
     *
     * @param string $value
     * @return string
     */
    public function filter ($value)
    {
        $parts = explode(':', $value);

        $seconds = array_pop($parts);

        $minutes = (int)array_pop($parts) * 60;

        $hours = (int)array_pop($parts) * 60 * 60;

        return $hours + $minutes + $seconds;

    } // END function filter

} // END class Rx_Filter_TimeToSeconds