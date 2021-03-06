<?php
/**
 * Scale Controller
 *
 * This controller handles all necessary steps to create view and modify Scales
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
 * Scale Controller
 *
 * This controller handles all necessary steps to create view and modify Scales
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class ScalesController
    extends Rx_Controller_Model
{
    /**
     * Specify the name of the model to be used
     *
     * @var string
     */
    protected $_modelName = 'Scale';

    /**
     * indexAction()
     *
     * This is the main action for the Scales controller
     */
    public function indexAction ( )
    {

    } // END function indexAction

    /**
     * listAction()
     *
     * List all of the model data, paginated, of course
     */
    public function listAction ( )
    {
        $model = $this->getModel('Scale');
        $request = $this->getRequest();

        $this->view->items = $model->paginate($request->getParams());

    } // END function listAction

} // END class App_Controller_ScalesController