<?php
/**
 * User View Helper
 *
 * This view helper should provide a number of method to view information related
 * to a user
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
 * User View Helper
 *
 * This view helper should provide a number of method to view information related
 * to a user
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2013 RxCompetition.com, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

class App_View_Helper_User
    extends Rx_View_Helper_Model
{
    /**
     * Property to define the model type associated with this helper
     *
     * @var string
     */
    protected $_modelName = 'App_Model_User';

    /**
     * user()
     *
     * Main method of the view helper
     *
     * @param array $score
     * @return string
     */
    public function user ($model)
    {
        $this->model($model, $this->_modelName);

        return $this;

    } // END function scoreItem

    /**
     * _getTitle()
     *
     * Gets the title value for an user
     *
     * @param App_Model_User
     * @return string
     */
    protected function _getTitle ($model)
    {
        $view = $this->view;
        $title = sprintf('<h3>%s</h3>', $view->htmlAnchor($model->row->name, array(
            'controller'=> 'users',
            'action'    => 'view',
            'id'        => $model->row->id,
        )));

        return $title;
    } // END function _getTitle

    /**
     * profile()
     *
     * Method to return the user profile for a given user
     *
     * @param App_Model_User|Zend_Db_Table_Row $user
     * @return string
     */
    public function profile ($user, $params = array())
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

        return strtr($template, array(
            '!email'        => $this->_model->row->email,
            '!gender'       => $this->_model->row->gender,
            '!first_name'   => $this->_model->row->first_name,
            '!last_name'    => $this->_model->row->last_name,
            '!address1'     => $this->_model->row->address1,
            '!address2'     => $this->_model->row->address2,
            '!city'         => $this->_model->row->city,
            '!state'        => $this->_model->row->state,
            '!postal'       => $this->_model->row->postal,
            '!country'      => $this->_model->row->country,
            '!birthday'     => $this->_model->row->birthday,
            '!debug'        => print_r($this->_model->row, true),
        ));

    } // END function userProfile

} // END class App_View_Helper_User