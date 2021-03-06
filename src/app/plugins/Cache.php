<?php
/**
 * Cache Plugin
 *
 * This plugin contains code to utilize a page cache
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2013 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       File available since release 1.0.0
 * @filesource
 */

/**
 * Cache Plugin
 *
 * This plugin contains code to utilize a page cache
 *
 * @category    RxComps
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2013 RxComps, Inc (http://www.RxComps.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class App_Plugin_Cache
    extends Rx_Controller_Plugin_Abstract
{
    /**
     * Start caching
     *
     * Determine if we have a cache hit. If so, return the response; else,
     * start caching.
     *
     * @param  Zend_Controller_Request_Abstract $request
     * @return void
     */
    public function dispatchLoopStartup (Zend_Controller_Request_Abstract $request)
    {
        $cache = $this->getCache();

        $result = $cache->start();

    } // END function dispatchLoopStartup

    /**
     * getCache()
     *
     * Gets the cache object
     *
     * @return Zend_Cache_Frontend_Page
     */
    public function getCache ( )
    {
        $front = $this->getFrontController();
        $cacheManager = $front->getParam('bootstrap')->getResource('cachemanager');
        $cache = $cacheManager->getCache('page');

        return $cache;

    } // END function getCache

} // END class App_Plugin_Cache