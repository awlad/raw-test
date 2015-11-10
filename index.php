<?php
/**
 * @author awlad <awladliton@gmail.com>
 */

session_start();
# set errors display settings
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# set some directory constant
define('ROOT_DIR', __DIR__ . '/app/');
define('ASSETS_DIR', __DIR__ . '/assets/');

#load everything
require __DIR__ . '/vendor/autoload.php';
