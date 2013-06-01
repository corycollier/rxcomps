<?php
/**
 * Unit Tests for User
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_User class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.1.0
 * @since       File available since release 1.1.0
 * @filesource
 */

/**
 * Unit Tests for User
 *
 * This unit test should test all of the custom functionality provided by the
 * App_View_Helper_User class
 *
 * @category    RxCompetition
 * @package     Tests
 * @subpackage  App_View_Helper
 * @copyright   Copyright (c) 2012 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.1.0
 * @since       Class available since release 1.1.0
 */

class Tests_App_View_Helper_User
    extends PHPUnit_Framework_TestCase
{
    /**
     * test_scale()
     *
     * Tests the user of the App_View_Helper_User
     *
     * @covers          App_View_Helper_User::user
     * @dataProvider    provide_scale
     */
    public function test_scale ($model)
    {
        $subject = $this->getMockBuilder('App_View_Helper_User')
            ->setMethods(array('model'))
            ->disableOriginalConstructor()
            ->getMock();

        $subject->expects($this->once())
            ->method('model')
            ->with($this->equalTo($model))
            ->will($this->returnSelf());

        $result = $subject->user($model);

        $this->assertSame($subject, $result);

    } // END function test_scale

    /**
     * provide_scale()
     *
     * Provides data for the user method of the
     * App_View_Helper_User class
     */
    public function provide_scale ( )
    {
        return array(
            // simple test
            'simple test' => array(
                'model' => (object)array(
                    'id'    => 1,
                    'name'  => 'stuff',
                )
            ),
        );

    } // END function provide_scale

    /**
     * test__getTitle()
     *
     * Tests the _getTitle of the App_View_Helper_User
     *
     * @covers          App_View_Helper_User::_getTitle
     * @dataProvider    provide__getTitle
     */
    public function test__getTitle ($expected, $link, $scale)
    {
        $subject = new App_View_Helper_User;

        $view = $this->getMockBuilder('Zend_View')
            ->setMethods(array('htmlAnchor'))
            ->disableOriginalConstructor()
            ->getMock();

        $view->expects($this->once())
            ->method('htmlAnchor')
            ->with($this->equalTo($scale->row->name), $this->equalTo(array(
                'controller'=> 'users',
                'action'    => 'view',
                'id'        => $scale->row->id,
            )))
            ->will($this->returnValue($link));

        $subject->view = $view;

        $method = new ReflectionMethod('App_View_Helper_User', '_getTitle');
        $method->setAccessible(true);
        $result = $method->invoke($subject, $scale);

        $this->assertEquals($expected, $result);

    } // END function test__getTitle

    /**
     * provide__getTitle()
     *
     * Provides data for the _getTitle method of the
     * App_View_Helper_User class
     */
    public function provide__getTitle ( )
    {
        return array(
            array(
                'expected'  => '<h3>link value</h3>',
                'link'      => 'link value',
                'scale'     => (object)array(
                    'row' => (object)array(
                        'id'    => 1,
                        'name'  => 'name value',
                    ),
                )
            ),
        );

    } // END function provide__getTitle

    /**
     * test_profile()
     *
     * Tests the profile of the App_View_Helper_User
     *
     * @covers          App_View_Helper_User::profile
     * @dataProvider    provide_profile
     */
    public function test_profile ($expected, $user, $params = array())
    {
        $subject = new App_View_Helper_User;

        $property = new ReflectionProperty('App_View_Helper_User', '_model');
        $property->setAccessible(true);
        $property->setValue($subject, $user);

        $result = $subject->profile($user, $params);
        $this->assertEquals($expected, $result);

    } // END function test_profile

    /**
     * provide_profile()
     *
     * Provides data for the profile method of the
     * App_View_Helper_User class
     */
    public function provide_profile ( )
    {
        $template = implode(PHP_EOL, array(
            '<table>',
            '<tr>',
                '<td>email<td>',
                '<td>!email</td>',
            '</tr><tr>',
                '<td>gender<td>',
                '<td>!gender</td>',
            '</tr><tr>',
                '<td>first name<td>',
                '<td>!first_name</td>',
            '</tr><tr>',
                '<td>last name<td>',
                '<td>!last_name</td>',
            '</tr><tr>',
                '<td>address1<td>',
                '<td>!address1</td>',
            '</tr><tr>',
                '<td>address2<td>',
                '<td>!address2</td>',
            '</tr><tr>',
                '<td>city<td>',
                '<td>!city</td>',
            '</tr><tr>',
                '<td>state<td>',
                '<td>!state</td>',
            '</tr><tr>',
                '<td>postal<td>',
                '<td>!postal</td>',
            '</tr><tr>',
                '<td>country<td>',
                '<td>!country</td>',
            '</tr><tr>',
                '<td class="label">birth-date<td>',
                '<td>!birthday</td>',
            '</tr>',
            '</table>',
            '<!-- !debug -->',
        ));

        $model = (object)array(
            'row' => (object)array(
                'email'         => 'test@test.com',
                'gender'        => 'm',
                'first_name'    => 'first',
                'last_name'     => 'last',
                'address1'      => '123 main st',
                'address2'      => '',
                'city'          => 'Anywhere',
                'state'         => 'FL',
                'postal'        => '12345',
                'country'       => 'United States',
                'birthday'      => '01/01/1980',
            )
        );

        return array(
            array(
                'expected' => strtr($template, array(
                    '!email'        => $model->row->email,
                    '!gender'       => $model->row->gender,
                    '!first_name'   => $model->row->first_name,
                    '!last_name'    => $model->row->last_name,
                    '!address1'     => $model->row->address1,
                    '!address2'     => $model->row->address2,
                    '!city'         => $model->row->city,
                    '!state'        => $model->row->state,
                    '!postal'       => $model->row->postal,
                    '!country'      => $model->row->country,
                    '!birthday'     => $model->row->birthday,
                    '!debug'        => print_r($model->row, true),
                )),
                'model' => $model,
            ),
        );

    } // END function provide_profile

} // END class Tests_App_View_Helper_User