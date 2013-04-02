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
     * Message to indicate that an registration was attempted for a non-existant event
     */
    const EXCEPTION_INVALID_EVENT = 'The event being registered for does not exist';

    /**
     * Message to indicate that the data provide is not valid
     */
    const EXCEPTION_INVALID_DATA = 'The data provided is not valid';

    const MB_CLASS_ID = 44;
    const MB_SERVICE_ID = 3072;

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

    public function getLog ( )
    {
        return Zend_Registry::getInstance()->get('log');
    }

    /**
     * getScalePrices()
     *
     *
     * @return [type] [description]
     */
    public function getScalePrice ($scale)
    {
        $table = $this->getTable('Scale');

        $result = $table->fetchRow($table->select()->where('id = ?', $scale));

        return $result->price;
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
        $logger = $this->getLog();

        $user = $this->getParent('User');
        $event = $this->getParent('Event')->load($values['event_id']);
        $scale = $this->getParent('Scale')->load($values['athlete']['scale_id']);
        $price = $this->getScalePrice($values['athlete']['scale_id']);
        $birthday = $this->getForm()->getSubForm('user')->getValue('birthday');

        if (! $event) {
            throw new Rx_Model_Exception(self::EXCEPTION_INVALID_EVENT);
        }

        if (! array_key_exists('athlete', $values)) {
            throw new Rx_Model_Exception(self::EXCEPTION_INVALID_DATA);
        }

        if ($price) {
            $this->_payForRegistration($values);
        }

        try {
            if (array_key_exists('user', $values)) {
                try {
                    $table = $user->getTable('User');
                    $row = $table->fetchRow(
                        $table->select()->where(sprintf('email = "%s"', $values['user']['email']))
                    );
                    $user->fromRow($row);
                    $user->create($values['user']);
                } catch (Zend_Exception $exception) {
                    $logger->err($exception->getMessage());
                }
                $values['user_id'] = $user->id;
            }

            $athlete = $this->getParent('Athlete');
            $athlete->create($values['athlete']);

            $values['athlete_id'] = $athlete->id;
            $result = $this->_create($values);
        } catch (Zend_Exception $exception) {
            $logger->err($exception->getMessage());
        }

        // $logger->log()
        //
        return $result;

    } // END function create

    /**
     * _payForRegistration()
     *
     *
     * @param  array  $values
     */
    protected function _payForRegistration ($values = array())
    {
        if (! isset($values['credit_card'])) {
            throw new Rx_Model_Exception(self::)
        }

        $logger = $this->getLog();

        $mindBodyOnlineApi = $this->getModel('MindBodyOnlineApi');
        $creditCard = array(
            'CreditCardNumber'   => $values['credit_card']['credit_card_number'],
            'BillingName'        => $values['credit_card']['name'],
            'BillingCity'        => $values['credit_card']['city'],
            'BillingAddress'     => $values['credit_card']['address'],
            'BillingState'       => $values['credit_card']['state'],
            'BillingPostalCode'  => $values['credit_card']['postal'],
            'ExpMonth'           => $values['credit_card']['exp_month'],
            'ExpYear'            => $values['credit_card']['exp_year'],
            'Amount'             => $price,
        );

        $values['user']['username'] = strtolower(implode('-', array(
            $values['user']['first_name'], $values['user']['last_name'], uniqid()
        )));

        // create the user in the mind-body system
        $remoteUser = $mindBodyOnlineApi->updateClient(array_merge($values['user'], array(
            'credit_card_number' => $creditCard,
            'birthday' => $birthday,
            'passwd' => hash('sha1', microtime()),
        )));

        $logger->info(sprintf('User entered in Mindbody with new ID %s', $remoteUser['id']));

        // bill the user
        $result = $mindBodyOnlineApi->purchaseEvent(
            $remoteUser['id'],
            self::MB_CLASS_ID,
            $scale->getValue('remote_id'),
            $price,
            $creditCard
        );

        $logger->info(sprintf(
            'User %s successfully charged %s, for event %s [%s], scale %s, auth# %s',
            $remoteUser['id'],
            $price,
            $result['cartitems']->CartItem->Item->Name,
            $values['event_id'],
            $values['athlete']['scale_id'],
            $result['id']
        ));
    }

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

