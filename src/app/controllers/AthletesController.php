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

        if ($request->getParam('q')) {
            if ($form->isValid($request->getParams())) {
                $this->view->results = $model->search('App_Model_Athlete', $request->getParam('q'));
            }
        }

        $this->view->form = $form;
    }

} // END class App_Controller_AthletesController