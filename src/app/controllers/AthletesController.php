<?php
/**
 * Athletes Controller
 *
 * This controller handles all necessary steps to create view and modify Athletes
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
 * Athletes Controller
 *
 * This controller handles all necessary steps to create view and modify Athletes
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Controller
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
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

        $helper = $this->_helper->getHelper('contextSwitch');

        if (! $helper->hasContext('remote')) {
            $helper->addContexts(array(
                'remote'  => array(
                    'suffix'    => 'remote',
                    'headers'   => array('Content-Type' => 'text/html'),
                )
            ));
            $helper->addActionContext('view', 'json')
                ->addActionContext('view', 'remote')
                ->initContext();
        }
    }

    /**
     * indexAction()
     *
     * This is the main action for the Athletes controller
     */
    public function indexAction ( )
    {

    } // END function indexAction

    /**
     * searchAction()
     *
     * Action to search athletes by query
     */
    public function searchAction ( )
    {
        $model = new App_Model_Lucene;
        $form = new Rx_Form_Search;

        $request = $this->getRequest();
        $this->view->results = array();
        $query = $request->getParam('q');
        $eventId = $request->getParam('event_id');

        if ($query && $eventId) {
            if ($form->isValid($request->getParams())) {
                $this->view->results = $model->search('App_Model_Athlete', $eventId, $query);
            }
        }

        $this->view->form = $form;
    }

//     public function listAction ( )
//     {

//         $model = $this->getModel($this->_modelName);
//         $request = $this->getRequest();

//         $db = $this->getFrontController()
//             ->getParam('bootstrap')
//             ->getResource('db');

//         $db->select()
//             ->from(array('a' => 'athletes'),
//                     array('scale_id', 'given_id', 'gender', 'gym', 'name'))

// $select = $db->select()
//              ->from(array('p' => 'products'),
//                     array('product_id', 'product_name'))
//              ->join(array('l' => 'line_items'),
//                     'p.product_id = l.product_id');


//         if ($request->getParam('format') == 'csv') {

//         } else {
//             $this->view->items = $model->paginate($request->getParams());
//         }
//     }

} // END class App_Controller_AthletesController