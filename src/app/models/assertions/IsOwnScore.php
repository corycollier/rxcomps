<?php
/**
 * IsOwnScore Assertion
 *
 * This class asserts if a user has access to a given score, because it's their
 * own score
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
 * IsOwnScore Assertion
 *
 * This class asserts if a user has access to a given score, because it's their
 * own score
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

class App_Model_Assertion_IsOwnScore
    implements Zend_Acl_Assert_Interface
{
    /**
     * Message to indicate that there are no rights defined for this role
     */
    const EXCEPTION_NO_RIGHTS_FOR_ROLE = 'There are no rights defined for this role [%s]';

    /**
     * assert()
     *
     * Is the score being checked, the user's score
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

    }

} // END function App_Model_Assertion_IsOwnScore