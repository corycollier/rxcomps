<?php
/**
 * Athletes Controller
 *
 * This controller handles all necessary steps to create view and modify Athletes
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Athletes Controller
 *
 * This controller handles all necessary steps to create view and modify Athletes
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.RxCompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class AthletesController
    extends Rx_Controller_Model
{
    /**
     * Specify the name of the model to be used
     *
     * @var string
     */
    protected $_modelName = 'Athlete';

    /**
     * init()
     *
     * Local override of the init hook
     */
    public function init ( )
    {
        parent::init();

        $this->_helper->getHelper('contextSwitch')
            ->addContexts(array(
                'remote'  => array(
                    'suffix'    => 'remote',
                    'headers'   => array('Content-Type' => 'text/html'),
                )
            ))
            ->addActionContext('view', 'json')
            ->addActionContext('view', 'remote')
            ->initContext();
    }

    /**
     * indexAction()
     *
     * This is the main action for the Athletes controller
     */
    public function indexAction ( )
    {

    } // END function indexAction

} // END class App_Controller_AthletesController