<?php
/**
 * Acl View Helper
 *
 * This view helper aids in determining if a user has access to a requested resource
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.1.0
 * @since       File available since release 1.1.0
 * @filesource
 */

/**
 * Acl View Helper
 *
 * This view helper aids in determining if a user has access to a requested resource
 *
 * @category    RxComps
 * @package     Rx
 * @subpackage  View_Helper
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 1.1.0
 * @since       Class available since release 1.1.0
 */

class Rx_View_Helper_Acl
    extends Zend_View_Helper_Abstract
{
    /**
     * acl()
     *
     * Acl method - the first point of the view helper
     *
     * @param Rx_Model_Abstract The application's implementation of a user model
     * @return Rx_View_Helper_Acl $this for object chaining
     */
    public function acl ($user)
    {
        $this->_user = $user;

        return $this;

    } // END function acl

    /**
     * isAllowed()
     *
     * Method to determine if the current user has access to a given resource/privilege
     * combination
     *
     * @param string $resource
     * @param string $privilege
     */
    public function isAllowed ($resource, $privilege)
    {
        $acl    = $this->_getAcl();
        $roleId = $this->_user->getRoleId();

        if (! $acl->isAllowed($roleId, $resource, $privilege)) {
            return false;
        }

        return true;

    } // END function isAllowed

    /**
     * _getAcl()
     *
     * Method to get the acl object from the registry
     *
     * @return Zend_Acl
     */
    protected function _getAcl ( )
    {
        return $this->_getRegistry()->get('acl');

    }

    /**
     * getRegistry()
     *
     * Method to get the global registry object. This method helps in unit testing
     *
     * @return Zend_Registry
     */
    protected function _getRegistry ( )
    {
        return Zend_Registry::getInstance();

    } // END function getRegistry


} // END class Rx_View_Helper_Acl
