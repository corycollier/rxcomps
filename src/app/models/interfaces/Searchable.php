<?php
/**
 * Searchable Interface
 *
 * This interface defines the requirements for a model to be searchable
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       File available since release 2.0.0
 * @filesource
 */

/**
 * Searchable Interface
 *
 * This interface defines the requirements for a model to be searchable
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Model
 * @copyright   Copyright (c) 2012 RxComps.com, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.0.0
 * @since       Class available since release 2.0.0
 */

interface App_Model_Interface_Searchable
{
    /**
     * getSearchFields()
     *
     * This method should return an array of fields that
     * can be used to search by
     *
     * @return array
     */
    public function getSearchFields();

} // END class App_Model_SearchableInterface