<?php

putenv('TESTS_PATH=' . __DIR__);
putenv('LIBRARY_PATH=' . dirname(__DIR__));

$root   = dirname(dirname(dirname(__FILE__))) . '/';
$vendor = $root . 'vendor/';

if (!realpath($vendor)) {
    die('Please install via Composer before running tests.');
}

if (!defined('PHPUNIT_COMPOSER_INSTALL')) {
    define('PHPUNIT_COMPOSER_INSTALL', $vendor . 'autoload.php');
}

require_once $vendor . 'autoload.php';


defined('ABSPATH') or define('ABSPATH', "{$vendor}/johnpbloch/wordpress-core/");
require_once "{$vendor}/johnpbloch/wordpress-core/wp-includes/class-wp-error.php";

unset($vendor, $root);
