<?php

use Olympus\Error\FileLogger;
use Olympus\Error\ErrorDebugger;

/**
 * Catches all errors.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/crewstyle/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/crewstyle/Olympus
 * @since    0.0.6
 */

function _error($title, $message, $type = 'Error 500') {
    global $olympus_configs;

    // If debug is enabled, just display error message
    if (isset($olympus_configs['debug']) && true === $olympus_configs['debug']) {
        ErrorDebugger::error500($title, $message, $type);
    }
}

// Check if debug is enabled or not and Push all in handler
if (isset($olympus_configs['debug']) && true === $olympus_configs['debug']) {
    // Use the ErrorDebugger to display errors
    // with the gorgeous Whoops vendor in
    // development environment only
    new ErrorDebugger($olympus_configs);
}

// Check if logger is enabled or not and Log all in file
if (isset($olympus_configs['log']) && true === $olympus_configs['log']) {
    // Use the FileLogger to store errors
    // in a specific log file
    new FileLogger(APPPATH.'logs'.S.'errors.log');
}
