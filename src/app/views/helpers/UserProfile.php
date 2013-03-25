<?php
/**
 * User Profile View Helper
 *
 * This view helper displays information related to a user
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
 * User Profile View Helper
 *
 * This view helper displays information related to a user
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_View_Helper_UserProfile
    extends Zend_View_Helper_HtmlElement
{
    /**
     * userProfile()
     *
     * Method to return the user profile for a given user
     *
     * @param App_Model_User|Zend_Db_Table_Row $user
     * @return string
     */
    public function userProfile ($userProfile, $user, $params = array())
    {
        // normalize the input
        if (isset($userProfile->row)) {
            $userProfile = $userProfile->row;
        }

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
        ));

        return strtr($template, array(
            '!email'        => $userProfile->email,
            '!gender'       => $userProfile->gender,
            '!first_name'   => $userProfile->first_name,
            '!last_name'    => $userProfile->last_name,
            '!address1'     => $userProfile->address1,
            '!address2'     => $userProfile->address2,
            '!city'         => $userProfile->city,
            '!state'        => $userProfile->state,
            '!postal'       => $userProfile->postal,
            '!country'      => $userProfile->country,
            '!birthday'     => $userProfile->birthday,
        ));

    } // END function userProfile

} // END class App_View_Helper_UserProfile