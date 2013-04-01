<?php
/**
 * MindBodyOnlineApi model
 *
 * This model represents the interaction with the mind-body-online api
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * MindBodyOnlineApi model
 *
 * This model represents the interaction with the mind-body-online api
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_Model_MindBodyOnlineApi
{
    /**
     * The location of the WSDL
     */
    const WSDL_URI_CLIENT = 'https://api.mindbodyonline.com/0_5/ClientService.asmx?wsdl';
    const WSDL_URI_CLASS = 'https://api.mindbodyonline.com/0_5/ClassService.asmx?WSDL';
    const WSDL_URI_APPOINTMENT = 'https://api.mindbodyonline.com/0_5/AppointmentService.asmx?WSDL';
    const WSDL_URI_SITE = 'https://api.mindbodyonline.com/0_5/SiteService.asmx?WSDL';
    const WSDL_URI_SALE = 'https://api.mindbodyonline.com/0_5/SaleService.asmx?WSDL';

    const SITE_ID = 29673;

    const SOURCE_NAME = 'RxCompetitions';
    const SOURCE_PASSWORD = 'EOlu/DBwB63riPua0svGaQE8+HQ=';

    const USER_USERNAME = 'corycollier';
    const USER_PASSWORD = '3dc91a5047852ead0f14d885eb7965e2';

    const EXCEPTION_INVALID_SERVICE = 'The service requested does not exist';

    const EXCEPTION_FAILED_API_REQUEST = 'The api request [%s] failed with message [%s]';

    const EXCEPTION_PURCHASE_FAIL = 'The purchase failed with message [%s]';


    /**
     * The soap client instance for the model
     *
     * @var Zend_Soap_Client
     */
    protected $_soapClient = array(
        'client' => null,
        'class' => null,
        'site'  => null,
        'sale'  => null,
        'appointment' => null,
    );


    /**
     * __construct()
     *
     * The model constructor
     */
    public function __construct ( )
    {
        $this->_soapClient['class'] = new Zend_Soap_Client(self::WSDL_URI_CLASS, array(
            'soap_version'  => SOAP_1_1,
            'location'      => strtr(self::WSDL_URI_CLASS, array(
                '?wsdl' => null,
            )),
        ));

        $this->_soapClient['client'] = new Zend_Soap_Client(self::WSDL_URI_CLIENT, array(
            'soap_version' => SOAP_1_1,
            'location'      => strtr(self::WSDL_URI_CLIENT, array(
                '?wsdl' => null,
            )),
        ));

        $this->_soapClient['appointment'] = new Zend_Soap_Client(self::WSDL_URI_APPOINTMENT, array(
            'soap_version' => SOAP_1_1,
            'location'      => strtr(self::WSDL_URI_APPOINTMENT, array(
                '?wsdl' => null,
            )),
        ));

        $this->_soapClient['site'] = new Zend_Soap_Client(self::WSDL_URI_SITE, array(
            'soap_version' => SOAP_1_1,
            'location'      => strtr(self::WSDL_URI_SITE, array(
                '?wsdl' => null,
            )),
        ));

        $this->_soapClient['sale'] = new Zend_Soap_Client(self::WSDL_URI_SALE, array(
            'soap_version' => SOAP_1_1,
            'location'      => strtr(self::WSDL_URI_SALE, array(
                '?wsdl' => null,
            )),
        ));

    } // END function __construct

    /**
     * getSoapClient()
     *
     * Gets the _soapClient property value
     *
     * @return Zend_Soap_Client
     */
    public function getSoapClient ($service)
    {
        if (! array_key_exists($service, $this->_soapClient)) {
            throw new Rx_Model_Exception(self::EXCEPTION_INVALID_SERVICE);
        }

        return $this->_soapClient[$service];

    } // END function getSoapClient

    /**
     * prepareParams()
     *
     * Prepares given parameters for standard requests
     *
     * @param array $params
     * @return array
     */
    public function prepareParams ($params = array())
    {
        $params['SourceCredentials'] = array(
            'SourceName' => self::SOURCE_NAME,
            'Password' => self::SOURCE_PASSWORD,
            'SiteIDs' => array(self::SITE_ID),
        );

        $params['UserCredentials'] = array(
            'Username' => self::USER_USERNAME,
            'Password' => self::USER_PASSWORD,
            'SiteIDs' => array(self::SITE_ID),
        );

        $params['XmlDetail'] = 'Full';

        return array('Request' => $params);

    } // END function prepareParams

    /**
     * update()
     *
     * Updates information for a client in mind-body
     *
     */
    public function updateClient ($params = array(), $isTest = false)
    {
        $params = $this->mapParamsToUpdateClientDefaults($params);
        $params['Notes'] = 'Machine generated user';

        try {
            $result = $this->getSoapClient('client')
                ->AddOrUpdateClients($this->prepareParams(array(
                    'Test'          => $isTest,
                    'Clients'       => array(
                        'Client'    => $params,
                    ),
                )));

            $result = $result->AddOrUpdateClientsResult;

            if ($result->ErrorCode != 200) {
                throw new Rx_Model_Exception(sprintf(
                    self::EXCEPTION_FAILED_API_REQUEST,
                    'AddOrUpdateClients',
                    $result->Clients->Client->Messages->string
                ));
            }

            $result = (array)$result->Clients->Client;

            return array_change_key_case($result);

        } catch (SoapFault $fault) {
            throw new Rx_Model_Exception($fault->faultstring);
        }

    } // END function update

    /**
     * makeCreditCardInfo()
     *
     * Creates a new CreditCardInfo object
     *
     * @param array $params
     * @return CreditCardInfo
     */
    public function makeCreditCardInfo ($params = array())
    {
        $creditCardInfo = new CreditCardInfo;

        foreach ($params as $key => $value) {
            $creditCardInfo->$key = $value;
        }

        $creditCardInfo->SaveInfo = true;

        return $creditCardInfo;
    }

    /**
     * purchaseEvent()
     *
     *
     * @param  array   $params
     * @param  boolean $test
     * @return boolean
     */
    public function purchaseEvent ($clientId, $classId, $serviceItemId, $price, $creditCardInfo, $test = false)
    {
        require_once('Sale_Service.php');
        require_once('Mindbody_Class.php');

        $item = new CartItem;

        $item->DiscountAmount = 0.00;
        $item->Quantity = 1;
        $item->ClassIDs = array($classId);
        $item->Item = new Service;
        $item->Item->ID = $serviceItemId;
        $item->Item->Price = $price;
        $item->Item->ClassIDs = array($classId);
        $item->Item->Quantity = 1;

        $creditCardInfo['Amount'] = $price;

        $params = $this->prepareParams(array(
            'Test' => $test,
            'ClientID' => $clientId,
            'InStore'   => false,
            'CartItems' => array($item),
            'ClassIDs' => array($classId),
            'Payments' => array($this->makeCreditCardInfo($creditCardInfo)),
            'SendEmail' => true,
            'LocationID' => 1,
        ));

        $cart = new CheckoutShoppingCart;
        $cart->Request = $params['Request'];
        $service = new Sale_x0020_Service(self::WSDL_URI_SALE, array(
            'trace' => true,
        ));

        $result = $service->CheckoutShoppingCart($cart);

        if ($result->CheckoutShoppingCartResult->ErrorCode != 200) {
            throw new Rx_Model_Exception(sprintf(
                self::EXCEPTION_PURCHASE_FAIL, trim($result->CheckoutShoppingCartResult->Message)
            ));
        }

        $result = (array)$result->CheckoutShoppingCartResult->ShoppingCart;
        return array_change_key_case($result);

    } // END function purchaseEvent

    /**
     * getClients()
     *
     * Gets the clients for this
     *
     * @return array
     */
    public function getClients ($params = array())
    {
        try {
            $results = $this->getSoapClient('client')->GetClients($this->prepareParams($params));
        } catch (SoapFault $fault) {
            print_r(array('fault' => $fault->faultstring)); die;
        }

        return $results;

    } // END function getClients

    /**
     * getClasses()
     *
     *
     * @return array
     */
    public function getClasses ($params = array())
    {
        try {
            $results = $this->getSoapClient('class')->GetClasses($this->prepareParams($params));
        } catch (SoapFault $fault) {
            print_r(array('fault' => $fault->faultstring)); die;
        }

        return $results;

    } // END function getClasses

    /**
     * getProducts()
     *
     * Gets the products available
     *
     * @param  array  $params to filter the request
     * @return array
     */
    public function getProducts ($params = array())
    {
        try {
            $results = $this->getSoapClient('sale')->GetProducts($this->prepareParams($params));
        } catch (SoapFault $fault) {
            print_r(array('fault' => $fault->faultstring)); die;
        }

        return $results;
    }

    /**
     * getServices()
     *
     * Gets the services available
     *
     * @param  array  $params to filter the request
     * @return array
     */
    public function getServices ($params = array())
    {
        try {
            $results = $this->getSoapClient('sale')->GetServices($this->prepareParams($params));
        } catch (SoapFault $fault) {
            print_r(array('fault' => $fault->faultstring)); die;
        }

        return $results;

    }

    /**
     * getLocations()
     *
     *
     * @param  array  $params Fitlering parameters
     * @return array
     */
    public function getLocations ($params = array())
    {
        try {
            $results = $this->getSoapClient('site')->GetLocations($this->prepareParams($params));
        } catch (SoapFault $fault) {
            print_r(array('fault' => $fault->faultstring)); die;
        }

        return $results;

    } // END function getLocations

    /**
     * getUpdateClientDefaults()
     *
     * Gets the default values for the updateClients method
     *
     * @return array
     */
    public function getUpdateClientDefaults ( )
    {
        return array(
            'Username'                      => '',
            'Password'                      => '',
            'ClientCreditCard'              => null,
            'AppointmentGenderPreference'   => '',
            'Gender'                        => '',
            'IsCompany'                     => false,
            'ClientRelationships'           => null,
            'Reps'                          => null,
            'LiabilityRelease'              => true,
            'EmergencyContactInfoName'      => '',
            'EmergencyContactInfoRelationship' => '',
            'EmergencyContactInfoPhone'     => '',
            'EmergencyContactInfoEmail'     => '',
            'Action'                        => 'Updated',
            'FirstName'                     => '',
            'MiddleName'                    => '',
            'LastName'                      => '',
            'Email'                         => '',
            'EmailOptIn'                    => false,
            'AddressLine1'                  => '',
            'AddressLine2'                  => '',
            'City'                          => '',
            'State'                         => '',
            'PostalCode'                    => '',
            'Country'                       => '',
            'MobilePhone'                   => '',
            'HomePhone'                     => '',
            'WorkPhone'                     => '',
            'WorkExtension'                 => '',
            'BirthDate'                     => null,
            'FirstAppointmentDate'          => null,
            'ReferredBy'                    => '',
            'HomeLocation'                  => null,
            'YellowAlert'                   => '',
            'PhotoURL'                      => null,
            'IsProspect'                    => true,
        );

    } // END funciton getUpdateClientDefaults

    /**
     * mapParamsToUpdateClientDefaults()
     *
     * Maps application properties to what is recognized by the mind-body api
     *
     * @param array $params
     * @return array
     */
    public function mapParamsToUpdateClientDefaults ($params = array())
    {
        $map = array(
            'Username'                      => 'username',
            'Password'                      => 'passwd',
            'Gender'                        => 'gender',
            'FirstName'                     => 'first_name',
            'LastName'                      => 'last_name',
            'Email'                         => 'email',
            'AddressLine1'                  => 'address1',
            'AddressLine2'                  => 'address2',
            'City'                          => 'city',
            'State'                         => 'state',
            'PostalCode'                    => 'postal',
            'Country'                       => 'country',
            'BirthDate'                     => 'birthday',
            'HomeLocation'                  => 'gym',
            'ClientCreditCard'              => 'credit_card_number',
        );

        $results = $this->getUpdateClientDefaults();

        foreach ($map as $apiValue => $localValue) {
            if (! isset($params[$localValue])) {
                continue;
            }
            $results[$apiValue] = $params[$localValue];
        }

        return $results;

    } // END function mapParamsToUpdateClientDefaults

}
