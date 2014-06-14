<?php

/**
 * index.php
 *
 * To run an application,
 * make an instance of Flooer_Application class then call a run() method.
 *
 * To check the current setting of an application,
 * You can call a info() method that show an application information page.
 */

require_once '../../library/Flooer/Application.php';
$application = new Flooer_Application();

// Path to an application directory
$application->setConfig('baseDir', '../application');

// Application environment
// Available value: production (default), staging, testing, development or debug.
$application->setConfig('environment', 'debug');

// Run or show info
$application->run();
//$application->info();

// Next, please see application/Bootstrap.php file.
