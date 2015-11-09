<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('ROOT_DIR', __DIR__ . '/app/');
define('ASSETS_DIR', __DIR__ . '/assets/');
//define('HELPERS_DIR', __DIR__ . '/app/helpers/');

/**
 * Load all library files
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Load helper functions
 */
//require HELPERS_DIR . 'application_helper.php';

/**
 * Separate all request to another file [http-request]
 *
 * @See http-request for all the request of this application
 */
//$app = new Module\App();

//require ROOT_DIR . 'request_handler.php';

