<?php
/**
 * Registrations Model
 *
 * This model represents individual events of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Registrations Model
 *
 * This model represents individual events of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_Registration
    extends Rx_Model_Abstract
    implements Zend_Acl_Resource_Interface, App_Model_Interface_Eventable
{
    /**
     * Message to indicate that the user provided already exists
     */
    const EXCEPTION_USER_ALREADY_EXISTS = 'The user with email [%s] already exists';

    /**
     * The subject to use to message a new registrant
     */
    const EMAIL_REGISTRATION_SUBJECT = 'Registered For %s';

    /**
     * getResourceId()
     *
     * Gets the resource id
     *
     * @return string
     */
    public function getResourceId ( )
    {
        return 'registrations';
    }

    /**
     * create()
     *
     * Local override of the create method, to allow for parent model creation
     * before the registration is created
     *
     * @param array $values
     * @return App_Model_Registration $this for object-chaining
     */
    public function create ($values = array())
    {
        $user = $this->getParent('User');
        $event = $this->getParent('Event')->load($values['event_id']);

        if (array_key_exists('user', $values)) {
            $user->create($values);
            $user->load($user->id);
            $values['user_id'] = $user->id;
        }

        $athlete = $this->getParent('Athlete');
        $athlete->create($values);

        $values['athlete_id'] = $athlete->id;

        // $form = $this->getForm();
        // $form->removeSubForm('athlete');
        // $form->removeSubForm('user');

        $values = $this->_validate($values);
        return $this->_create($values);

    } // END function create

    /**
     * getEventId()
     *
     * This method gets the event id
     *
     * @return integer
     */
    public function getEvent ( )
    {
        return $this->getParent('Event');
    }


}// END class App_Model_Registration

