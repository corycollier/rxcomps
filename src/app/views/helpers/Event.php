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
     * event()
     *
     * main entry point into the helper
     *
     * @return App_View_Helper_Event
     */
    public function event ( )
    {
        if (! $this->_model) {
            $event = new App_Model_Event;

            // make sure we have the event id
            $request =  $this->view->request();

            $eventId =  $request->getParam('event_id')
                ? $request->getParam('event_id')
                : $request->getParam('id');


            $event->load($eventId);

            $this->model($event);
        }

        return $this;
    }

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
        $result = 'registered';

        if (! $user->isRegistered($this->_model)) {
            $result = $this->view->htmlAnchor('Register', array(
                'controller' => 'registrations',
                'action'    => 'create',
                'event_id'  => $this->_model->id,
            ));
        }

        return $result;

    } // END function register

}