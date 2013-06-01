<?php

// Define path of the root of the project
defined('ROOT_PATH')
	|| define('ROOT_PATH', dirname(__DIR__));

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', ROOT_PATH . '/app');

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (
		getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production')
    );

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(ROOT_PATH . '/lib'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    ROOT_PATH . '/etc/application.ini'
);

$application->bootstrap();

if (strtolower(PHP_SAPI) != 'cli') {
    $application->run();
}