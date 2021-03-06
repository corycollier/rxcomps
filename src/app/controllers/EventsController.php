<?php
/**
 * Event Controller
 *
 * This controller handles all necessary steps to create view and modify events
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Event Controller
 *
 * This controller handles all necessary steps to create view and modify events
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class EventsController
    extends Rx_Controller_Model
{
    /**
     * Specify the name of the model to be used
     *
     * @var string
     */
    protected $_modelName = 'Event';

    /**
     * indexAction()
     *
     * This is the main action for the events controller
     */
    public function indexAction ( )
    {

    } // END function indexAction

} // END class App_Controller_EventsController