<?php
/**
 * Eventable Interface
 *
 * This interface defines the functionality required of models to be owned
 * by an event model
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Eventable Interface
 *
 * This interface defines the functionality required of models to be owned
 * by an event model
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */


interface App_Model_Interface_Eventable
{
    /**
     * getEvent()
     *
     * This method should return the parent event for this model
     *
     * @return App_Model_Event The event that owns this model
     */
    public function getEvent();

} // END interface App_Model_Interface_Eventable