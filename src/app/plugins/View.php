<?php
/**
 * View Plugin
 *
 * This plugin initializes all of the items necessary for the view
 *
 * @category    InfidelThrowdown
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2012 Firebase Gym, Inc (http://www.infidelthrowdown.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * View Plugin
 *
 * This plugin initializes all of the items necessary for the view
 *
 * @category    InfidelThrowdown
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2012 Firebase Gym, Inc (http://www.infidelthrowdown.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Plugin_View
    extends Rx_Controller_Plugin_Abstract
{

    public $view;

    /**
     * __construct()
     *
     * Constructor
     *
     * @param Zend_View $view
     */
    public function __construct (Zend_View $view)
    {
        $this->view = $view;

    } // END function __construct
    /**
     * preDispatch()
     *
     * Local implementation of the preDispatch hook, to setup view assets
     */
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $view = $this->getView();

        $registry = $this->getRegistry();

        $options = isset($registry['options']) ?
            $registry['options']
            : array();

        foreach ($options as $option) {
            $name = $this->variablize($option->name);
            $view->$name = $option->value;
        }

        $view->user = new App_Model_User;

        $role = 'guest';
        try {
            $user = $this->getRegistry()->get('user');
            $role = $user->getRoleId();
        } catch (Zend_Exception $exception) {

        }


        $view->navigation()
            ->setAcl($this->getRegistry()->get('acl'))
            ->setRole($role);

        // add some css
        $view->headLink()->appendStylesheet("/css/gumby.css");
        $view->headScript()
            ->appendFile('/js/libs/gumby.js')
            ->appendFile('/js/libs/ui/gumby.retina.js')
            ->appendFile('/js/libs/ui/gumby.fixed.js')
            ->appendFile('/js/libs/ui/gumby.skiplink.js')
            ->appendFile('/js/libs/ui/gumby.toggleswitch.js')
            ->appendFile('/js/libs/ui/gumby.checkbox.js')
            ->appendFile('/js/libs/ui/gumby.radiobtn.js')
            ->appendFile('/js/libs/ui/gumby.tabs.js')
            ->appendFile('/js/libs/ui/gumby.navbar.js')
            ->appendFile('/js/libs/ui/gumby.fittext.js')
            ->appendFile('/js/libs/ui/jquery.validation.js')
            ->appendFile('/js/libs/gumby.init.js')
            ->appendFile('/js/plugins.js')
            ->appendFile('/js/main.js');

    } // END function preDispatch

    /**
     * variablize()
     *
     * Method to turn a volitile string into a suitable variable name
     *
     * @param string $string
     * @return string
     */
    public function variablize ($string)
    {
        $filter = new Zend_Filter;

        return $filter->filter($string);

    } // END function variablize

} // END class App_Plugin_View