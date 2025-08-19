<?php

// Set the current environment to 'testing'
if (! getenv('CI_ENVIRONMENT')) {
    putenv('CI_ENVIRONMENT=testing');
}

// Define necessary framework constants that might be missing
if (! defined('CI_DEBUG')) {
    define('CI_DEBUG', true);
}

if (! defined('FCPATH')) {
    // Path to the front controller (this file)
    define('FCPATH', realpath(__DIR__ . '/../../public') . DIRECTORY_SEPARATOR);
}

if (! defined('ROOTPATH')) {
    // Path to the project root
    define('ROOTPATH', realpath(__DIR__ . '/../../') . DIRECTORY_SEPARATOR);
}

if (! defined('APPPATH')) {
    // Path to the app directory
    define('APPPATH', realpath(ROOTPATH . 'app') . DIRECTORY_SEPARATOR);
}

if (! defined('WRITEPATH')) {
    // Path to the writable directory
    define('WRITEPATH', realpath(ROOTPATH . 'writable') . DIRECTORY_SEPARATOR);
}

if (! defined('TESTPATH')) {
    // Path to the tests directory
    define('TESTPATH', realpath(ROOTPATH . 'tests') . DIRECTORY_SEPARATOR);
}

// Load the framework bootstrap file from the correct vendor location
require_once ROOTPATH . 'vendor/codeigniter4/framework/system/Test/bootstrap.php';
