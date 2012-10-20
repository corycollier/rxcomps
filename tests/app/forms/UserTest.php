<?php
/**
 * User Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the User class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * User Unit Tests
 *
 * This unit test suite should test all of the custom funtionality provided
 * by the User class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_Form
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class Tests_App_Form_User
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_init()
     *
     * Tests the init of the App_Form_User
     *
     * @covers          App_Form_User::init
     * @dataProvider    provide_init
     */
    public function test_init ( )
    {
        $form = new App_Form_User;

        $email = $form->getElement('email');
        $passwd = $form->getElement('passwd');
        $login = $form->getElement('login');

        $this->assertInstanceOf('Zend_Form_Element_Text', $email);
        $this->assertInstanceOf('Zend_Form_Element_Password', $passwd);
        $this->assertInstanceOf('Zend_Form_Element_Submit', $login);

        $this->assertEquals('Email', $email->getLabel());
        $this->assertEquals('Password', $passwd->getLabel());
        $this->assertEquals('Login', $login->getLabel());

    } // END function test_init

    /**
     * provide_init()
     *
     * Provides data for the init method of the
     * App_Form_User class
     */
    public function provide_init ( )
    {
        return array(
            array(),
        );

    } // END function provide_init

} // END class Tests_1.0.0_User