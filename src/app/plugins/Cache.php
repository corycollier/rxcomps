<?php
/**
 * Cache Plugin
 *
 * This plugin contains code to utilize a page cache
 *
 * @category    RxCompetition
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
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
 * @category    RxCompetition
 * @package     App
 * @subpackage  Plugin
 * @copyright   Copyright (c) 2013 RxCompetition, Inc (http://www.rxcompetition.com)
 * @license     All Rights Reserved
 * @version     Release: 2.1.0
 * @since       Class available since release 2.1.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

class App_Plugin_Cache
    extends Zend_Controller_Plugin_Abstract
{
/**
     *  @var bool Whether or not to disable caching
     */
    public $doNotCache = true;

    /**
     * @var Zend_Cache_Frontend
     */
    public $cache;

    /**
     * @var string Cache key
     */
    public $key;

    /**
     * Start caching
     *
     * Determine if we have a cache hit. If so, return the response; else,
     * start caching.
     *
     * @param  Zend_Controller_Request_Abstract $request
     * @return void
     */
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $path = $request->getPathInfo();

        $cache = $this->getCache();

        $cacheablePaths = $cache->getOption('regexps');

        foreach ($cacheablePaths as $cacheablePath => $options) {
            $match = preg_match($cacheablePath, $path);
            if ($match) {
                if (!$options['cache']) {
                    continue;
                }
                $this->doNotCache = false;
            }
        }

        $this->key = 'page__' . md5($path);
        if (false !== ($response = $this->getCache()->load($this->key))) {
            $response->sendResponse();
            exit;
        }
    }

    /**
     * Store cache
     *
     * @return void
     */
    public function dispatchLoopShutdown()
    {
        if ($this->doNotCache
            || $this->getResponse()->isRedirect()
            || (null === $this->key)
        ) {
            return;
        }



        $this->getCache()->save($this->getResponse(), $this->key);
    }

    /**
     * getCache()
     *
     * Gets the cache object
     *
     * @return Zend_Cache_Frontend_Page
     */
    public function getCache ( )
    {
        $front = Zend_Controller_Front::getInstance();
        $cacheManager = $front->getParam('bootstrap')->getResource('cachemanager');
        $cache = $cacheManager->getCache('page');


        return $cache;

    } // END function getCache

} // END class App_Plugin_Cache