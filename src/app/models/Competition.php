<?php
/**
 * Competitions Model
 *
 * This model represents individual Competitions of the application
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
 * Competitions Model
 *
 * This model represents individual Competitions of the application
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 1.0.0
 * @since       Class available since release 1.0.0
 */

class App_Model_Competition
    extends Rx_Model_Abstract
{
    /**
     * create()
     *
     * Creates a single instance of a competition in the database.
     * This method was overridden so some default values could be set before
     * calling it's parent method
     *
     * @param array $values
     * @return App_Model_Competition $this for a fluent interface
     */
    public function create ($values)
    {
        $created = new Zend_Date;

        $values['created'] = $created;
        $values['updated'] = $created;

        return parent::create($values);

    } // END function create


    /**
     * edit()
     *
     * Edits a single instance of a competition in the database.
     * This method was overridden so some default values could be set before
     * calling it's parent method
     *
     * @param array $values
     * @return App_Model_Competition $this for a fluent interface
     */
    public function edit ($values)
    {
        $updated = new Zend_Date;

        $values['updated'] = $updated;

        return parent::edit($values);

    } // END function edit

}// END class App_Model_Competitions
