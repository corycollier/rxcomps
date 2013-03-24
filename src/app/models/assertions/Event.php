<?php
/**
 * Athlete Assertion
 *
 * This class asserts if a user has access to a given event
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model_Assertion
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       File available since release 2.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 * @filesource
 */

/**
 * Athlete Assertion
 *
 * This class asserts if a user has access to a given event
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model_Assertion
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class App_Model_Assertion_Event
    implements Zend_Acl_Assert_Interface
{
    /**
     * Message to indicate that there are no rights defined for this role
     */
    const EXCEPTION_NO_RIGHTS_FOR_ROLE = 'There are no rights defined for this role [%s]';

    /**
     * assert()
     *
     * This is the logic that will be called to return if the user has access to
     * the event or not
     *
     * @param Zend_Acl $acl
     * @param Zend_Acl_Role_Interface $role
     * @param Zend_Acl_Resource_Interface $resource
     * @param string $privilege
     * @return boolean
     */
    public function assert (Zend_Acl $acl,
        Zend_Acl_Role_Interface $role = null,
        Zend_Acl_Resource_Interface $resource = null,
        $privilege = null)
    {

        // override the role. It should always be the current user
        $role = $this->_getRegistry()->get('user');

        $results = array();
        if (@$role->row) {
            $results = $role->row->findDependentRowset('App_Model_DbTable_EventsUsers')->toArray();
        }

        // if the model is loaded ...
        if ($resource->row) {

            $eventId    = $resource->id;
            $resourceId = $resource->getResourceId();

            if ($resourceId != 'events') {
                $eventId = $resource->row->findParentRow('App_Model_DbTable_Event')->id;
            }

            foreach ($results as $result) {
                if ($eventId == $result['event_id']) {
                    return $this->hasAccess($result['role'], $resourceId, $privilege);
                }
            }

            return false;
        }

        // return false;
    }

    /**
     * hasAccess()
     *
     * Checks to see if the given string role has access to the requested privilege
     *
     * @param string $role
     * @param string $privilege
     * @return boolean
     */
    public function hasAccess ($role, $resource, $privilege)
    {
        $rights = array();

        $rights['user']['events']           = array('view', 'list');
        $rights['user']['registrations']    = array();
        $rights['user']['event-options']    = array();
        $rights['user']['competitions']     = array('view', 'list');
        $rights['user']['athletes']         = array('view', 'list');

        $rights['admin']['events']          = array('view', 'list', 'edit', 'delete', 'create');
        $rights['admin']['registrations']   = array('view', 'list', 'edit', 'delete', 'create');
        $rights['admin']['competitions']    = array('view', 'list', 'edit', 'delete', 'create');
        $rights['admin']['event-options']   = array('view', 'list', 'edit', 'delete', 'create');
        $rights['admin']['athletes']        = array('view', 'list', 'edit', 'delete', 'create');

        if (! isset($rights[$role])) {
            throw new Zend_Exception(sprintf(
                self::EXCEPTION_NO_RIGHTS_FOR_ROLE, $role
            ));
        }

        if (in_array($privilege, $rights[$role][$resource])) {
            return true;
        }

        return false;

    }

    /**
     * _getRegistry()
     *
     * Gets the registry
     *
     * @return Zend_Registry
     */
    protected function _getRegistry()
    {
        return Zend_Registry::getInstance();
    }


} // END class App_Model_Assertion_Event