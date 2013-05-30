<?php
/**
 * Event View Helper
 *
 * This view helper helps get access to the current event being worked on
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Event View Helper
 *
 * This view helper helps get access to the current event being worked on
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_View_Helper_Event
    extends Rx_View_Helper_Model
{
    /**
     * Property to define the model type associated with this helper
     *
     * @var string
     */
    protected $_modelName = 'App_Model_Event';

    /**
     * event()
     *
     * main entry point into the helper
     *
     * @param App_Model_Event|null $model Dependency injection
     * @return App_View_Helper_Event
     */
    public function event ($model)
    {
        $this->model($model, $this->_modelName);

        return $this;

    } // END function event

    /**
     * _getTitle()
     *
     * Gets the title value for an event
     *
     * @param App_Model_Event
     * @return string
     */
    protected function _getTitle ($event)
    {
        $view = $this->view;
        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($event->row->name, array(
            'controller'=> 'events',
            'action'    => 'view',
            'id'        => $event->row->id,
            'event_id'  => $event->row->id,
        )));

        return $title;

    } // END function _getTitle


    /**
     * register()
     *
     * returns either a link to allow a user to register, or a message indicating
     * that the user has already registered for that event
     *
     * @return string
     */
    public function register ($user)
    {
        $result = '';

        if (! $user->isRegistered($this->_model)) {

            $link = $this->view->htmlAnchor(' Register ', array(
                'controller' => 'registrations',
                'action'    => 'create',
                'event_id'  => $this->_model->id,
            ));

            $result = '<div class="pretty medium success btn">' . $link . '</div>';

        }

        return $result;

    } // END function register

}