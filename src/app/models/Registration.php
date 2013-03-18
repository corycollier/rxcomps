<?php
/**
 * Registrations Model
 *
 * This model represents individual events of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Registrations Model
 *
 * This model represents individual events of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_Registration
    extends Rx_Model_Abstract
    implements Zend_Acl_Resource_Interface
{
    /**
     * getResourceId()
     *
     * Gets the resource id
     *
     * @return string
     */
    public function getResourceId ( )
    {
        return 'registrations';
    }

    /**
     * getAthletes()
     *
     * Gets the athletes associated with this registration
     *
     * @return ArrayObject
     */
    public function getAthletes ( )
    {
        $table = $this->getTable();
        $select = $table->select();

        $select->from(array('a' => 'athletes'))
            ->setIntegrityCheck(false)
            ->join(array('ar' => 'athletes_registrations'), 'a.id = ar.athlete_id')
            ->join(array('r' => 'registrations'), 'r.id = ar.registration_id');

        var_dump((string)$select);

        var_dump($table->fetchAll($select)); die;
        $athletesRegistrations = $this->row->findDependentRowset('App_Model_DbTable_AthletesRegistrations');

        var_dump($athletesRegistrations); die;

        return array();
    } // END function getAthletes

}// END class App_Model_Registration

