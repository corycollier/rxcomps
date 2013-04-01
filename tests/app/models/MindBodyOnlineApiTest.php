<?php
/**
 * Unit Test Suite for the MindBodyOnlineApi model
 *
 * This unit test should test all of the custom functionality provided by the
 * MindBodyOnlineApi model
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Unit Test Suite for the MindBodyOnlineApi model
 *
 * This unit test should test all of the custom functionality provided by the
 * MindBodyOnlineApi model
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Model
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class Tests_App_Model_MindBodyOnlineApiTest
    extends Rx_PHPUnit_TestCase
{

    /**
     * test___construct()
     *
     * Tests the __construct method of the App_Model_MindBodyOnlineApi class
     *
     * @covers App_Model_MindBodyOnlineApi::__construct
     */
    public function test___construct ( )
    {
        $subject = new App_Model_MindBodyOnlineApi;

    } // END function test___construct

    /**
     * test_getSoapClient()
     *
     * Tests the getSoapClient method of the App_Model_MindBodyOnlineApi class
     *
     * @covers App_Model_MindBodyOnlineApi::getSoapClient
     * @dataProvider provide_getSoapClient
     */
    public function test_getSoapClient ($service, $exception = '')
    {
        $subject = new App_Model_MindBodyOnlineApi;

        $result = $subject->getSoapClient($service);

        $this->assertInstanceOf('Zend_Soap_Client', $result);

    } // END function test_getSoapClient

    /**
     * provide_getSoapClient()
     *
     * Provides data to use for testing the getSoapClient method of
     * the App_Model_MindBodyOnlineApi class
     *
     * @return array
     */
    public function provide_getSoapClient ( )
    {
        return array(
            array('client'),
            array('class'),
            array('site'),
            array('sale'),
            array('appointment'),
        );

    } // END function provide_getSoapClient

    /**
     * test_updateClient()
     *
     * Tests the updateClient method of the App_Model_MindBodyOnlineApi class
     *
     * @covers App_Model_MindBodyOnlineApi::updateClient
     * @dataProvider provide_updateClient
     */
    public function test_updateClient ($params = array())
    {
        $subject = new App_Model_MindBodyOnlineApi;

        // $result = $subject->updateClient($params);

    } // END function test_updateClient

    /**
     * provide_updateClient()
     *
     * Provides data to use for testing the updateClient method of
     * the App_Model_MindBodyOnlineApi class
     *
     * @return array
     */
    public function provide_updateClient ( )
    {
        $uniqueId = uniqid();

        return array(
            array(array(
                'username'      => 'testuser-' . $uniqueId,
                'password'      => 'testpass123',
                'gender'        => 'male',
                'first_name'    => 'Test',
                'last_name'     => 'User',
                'email'         => 'corycollier@corycollier.com',
                'address1'      => '123 Main Street',
                'address2'      => null,
                'city'          => 'Anywhere',
                'state'         => 'FL',
                'postal'        => 12345,
                'country'       => 'United States',
                'birthday'      => '1979-05-07',
                'gym'           => 'CrossFit Test',
                'credit_card_number' => array(
                    'CardNumber'    => '1234123412341234',
                    'CardHolder'    => 'Test User',
                    'City'          => 'Anywhere',
                    'Address'       => '123 Main Street',
                    'State'         => 'FL',
                    'PostalCode'    => 12345,
                    'ExpMonth'      => 01,
                    'ExpYear'       => 2014,
                ),
            )),
        );

    } // END function provide_updateClient

    /**
     * test_purchaseEvent()
     *
     * Tests the purchaseEvent of the App_Model_MindBodyOnlineApi
     *
     * @covers          App_Model_MindBodyOnlineApi::purchaseEvent
     * @dataProvider    provide_purchaseEvent
     */
    public function test_purchaseEvent ($clientId, $classId, $serviceItemId, $price, $creditCardInfo, $test = false)
    {
        $subject = new App_Model_MindBodyOnlineApi;

        $result = $subject->purchaseEvent($clientId, $classId, $serviceItemId, $price, $creditCardInfo, $test);

        print_r($result); die;

    } // END function test_purchaseEvent

    /**
     * provide_purchaseEvent()
     *
     * Provides data for the purchaseEvent method of the
     * App_Model_MindBodyOnlineApi class
     */
    public function provide_purchaseEvent ( )
    {
        return array(
            array(100000474, 44, 3072, 1.00, array(
                    'CreditCardNumber'   => '5431111111111111',
                    'BillingName'        => 'Cory Collier',
                    'BillingCity'        => 'Maitland',
                    'BillingAddress'     => '2200 Hunterfield Rd',
                    'BillingState'       => 'FL',
                    'BillingPostalCode'  => '32751',
                    'ExpMonth'           => '07',
                    'ExpYear'            => '2015',
                    'SaveInfo'           => true,
                ),
                true
            ),
        );

    } // END function provide_purchaseEvent

    /**
     * test_getClients()
     *
     * Tests the getClients method of the App_Model_MindBodyOnlineApi class
     *
     * @covers App_Model_MindBodyOnlineApi::getClients
     * @dataProvider provide_getClients
     */
    public function test_getClients ($params)
    {
        $subject = new App_Model_MindBodyOnlineApi;

        $subject->getClients($params);

    } // END function test_getClients

    /**
     * provide_getClients()
     *
     * Provides data to use for testing the getClients method of
     * the App_Model_MindBodyOnlineApi class
     *
     * @return array
     */
    public function provide_getClients ( )
    {
        $tomorrow = date('Y-m-d\TH:i:s', strtotime("next monday"));

        return array(
            array(array(
                'HideCanceledClasses' => false,
                'StartDateTime' => $tomorrow,
            )),
        );

    } // END function provide_getClients

    /**
     * test_getClasses()
     *
     * Tests the getClasses of the App_Model_MindBodyOnlineApi
     *
     * @covers          App_Model_MindBodyOnlineApi::getClasses
     * @dataProvider    provide_getClasses
     */
    public function test_getClasses ($params = array())
    {
        $subject = new App_Model_MindBodyOnlineApi;

        $result = $subject->getClasses($params);

        // print_r($result); die;

    } // END function test_getClasses

    /**
     * provide_getClasses()
     *
     * Provides data for the getClasses method of the
     * App_Model_MindBodyOnlineApi class
     */
    public function provide_getClasses ( )
    {
        $tomorrow = date('Y-m-d\TH:i:s', strtotime("next monday"));
        return array(
            array(array(
                'HideCanceledClasses' => false,
                'StartDateTime' => '2013-06-29',
            )),
            array(array(
                'HideCanceledClasses' => false,
                'StartDateTime' => $tomorrow,
            )),
        );

    } // END function provide_getClasses

    /**
     * test_getProducts()
     *
     * Tests the getProducts of the App_Model_MindBodyOnlineApi
     *
     * @covers          App_Model_MindBodyOnlineApi::getProducts
     * @dataProvider    provide_getProducts
     */
    public function test_getProducts ($params = array())
    {
        $subject = new App_Model_MindBodyOnlineApi;

        $result = $subject->getProducts($params);

        // print_r($result); die;

    } // END function test_getProducts

    /**
     * provide_getProducts()
     *
     * Provides data for the getProducts method of the
     * App_Model_MindBodyOnlineApi class
     */
    public function provide_getProducts ( )
    {
        return array(
            array(array(
                'SearchText' => 'Bacon',
                'SellOnline' => false,
            )),
        );

    } // END function provide_getProducts

    /**
     * test_getServices()
     *
     * Tests the getServices of the App_Model_MindBodyOnlineApi
     *
     * @covers          App_Model_MindBodyOnlineApi::getServices
     * @dataProvider    provide_getServices
     */
    public function test_getServices ($params = array())
    {
        $subject = new App_Model_MindBodyOnlineApi;

        $result = $subject->getServices($params);

        print_r($result); die;

    } // END function test_getServices

    /**
     * provide_getServices()
     *
     * Provides data for the getServices method of the
     * App_Model_MindBodyOnlineApi class
     */
    public function provide_getServices ( )
    {
        return array(
            array(array(
                'LocationID' => 2,
                'HideRelatedPrograms' => true,
                // 'ClassID' => 44,
            )),
        );

    } // END function provide_getServices

    /**
     * test_getLocations()
     *
     * Tests the getLocations of the App_Model_MindBodyOnlineApi
     *
     * @covers          App_Model_MindBodyOnlineApi::getLocations
     * @dataProvider    provide_getLocations
     */
    public function test_getLocations ($params = array())
    {
        $subject = new App_Model_MindBodyOnlineApi;

        $result = $subject->getLocations($params);

        return $result;

    } // END function test_getLocations

    /**
     * provide_getLocations()
     *
     * Provides data for the getLocations method of the
     * App_Model_MindBodyOnlineApi class
     */
    public function provide_getLocations ( )
    {
        return array(
            array(),
        );

    } // END function provide_getLocations


    /**
     * test_getUpdateClientDefaults()
     *
     * Tests the getUpdateClientDefaults method of the App_Model_MindBodyOnlineApi class
     *
     * @covers App_Model_MindBodyOnlineApi::getUpdateClientDefaults
     */
    public function test_getUpdateClientDefaults ( )
    {
        $expected = array(
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

        $subject = new App_Model_MindBodyOnlineApi;

        $result = $subject->getUpdateClientDefaults();

        $this->assertEquals($expected, $result);

    } // END function test_getUpdateClientDefaults

    /**
     * test_mapParamsToUpdateClientDefaults()
     *
     * Tests the mapParamsToUpdateClientDefaults method of the App_Model_MindBodyOnlineApi class
     *
     * @covers App_Model_MindBodyOnlineApi::mapParamsToUpdateClientDefaults
     * @dataProvider provide_mapParamsToUpdateClientDefaults
     */
    public function test_mapParamsToUpdateClientDefaults ($expected, $params)
    {
        $subject = new App_Model_MindBodyOnlineApi;

        $result = $subject->mapParamsToUpdateClientDefaults($params);

        $this->assertEquals($expected, $result);

    } // END function test_mapParamsToUpdateClientDefaults

    /**
     * provide_mapParamsToUpdateClientDefaults()
     *
     * Provides data to use for testing the mapParamsToUpdateClientDefaults method of
     * the App_Model_MindBodyOnlineApi class
     *
     * @return array
     */
    public function provide_mapParamsToUpdateClientDefaults ( )
    {
        $model = new App_Model_MindBodyOnlineApi;
        $defaults = $model->getUpdateClientDefaults();

        return array(
            array(
                array_merge($defaults, array(
                    'Username' => 'test username'
                )),
                array(
                    'username' => 'test username',
                ),
            ),
        );

    } // END function provide_mapParamsToUpdateClientDefaults

} // END class Tests_App_Model_CompetitionTest