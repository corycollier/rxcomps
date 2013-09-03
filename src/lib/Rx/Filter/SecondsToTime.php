<?php
/**
 * Seconds to Time Filter
 *
 * A filter to translate seconds into time
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Filter
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Seconds to Time Filter
 *
 * A filter to translate seconds into time
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  Filter
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Rx_Filter_SecondsToTime
    implements Zend_Filter_Interface
{
    /**
     * filter()
     *
     * The main entry point to the filter
     *
     * @param string $value
     * @return string
     */
    public function filter ($value)
    {
        $hours = floor($value / (60 * 60));

        $minutes = floor(($value - ($hours * 60 * 60)) / 60);

        $seconds = floor(
            ($value - ($hours * 60 * 60) - ($minutes * 60))
        );

        if (! $hours) {
            return sprintf('%d:%02d', $minutes, $seconds);
        }

        return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);

    } // END function filter


} // END class Rx_Filter_SecondsToTime