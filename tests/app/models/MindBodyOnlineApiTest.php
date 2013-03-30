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

        $subject->updateClient($params);

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
        return array(
            array(),
        );

    } // END function provide_updateClient

    /**
     * test_getClients()
     *
     * Tests the getClients method of the App_Model_MindBodyOnlineApi class
     *
     * @covers App_Model_MindBodyOnlineApi::getClients
     * @dataProvider provide_getClients
     */
    public function test_getClients ( )
    {
        $subject = new App_Model_MindBodyOnlineApi;

        $subject->getClients();

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
        return array(
            array(),
        );

    } // END function provide_getClients

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