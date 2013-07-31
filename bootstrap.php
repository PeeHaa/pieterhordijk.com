<?php
/**
 * This bootstraps the application
 *
 * PHP version 5.4
 *
 * @category   PieterHordijk
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PieterHordijk;

use PieterHordijk\Core\Autoloader,
    PieterHordijk\Http\Session,
    PieterHordijk\Http\Request,
    PieterHordijk\Storage\Session as SessionStorage;

/**
 * Bootstrap the PitchBlade library
 */
require_once __DIR__ . '/src/PieterHordijk/bootstrap.php';

/**
 * Setup session
 */
/*
$session = new Session($dbConnection);
session_set_save_handler($session, true);
session_start();
*/

/**
 * Setup the request object
 */
$request = new Request($_SERVER, $_GET, $_POST, $_COOKIE);

/**
 * Setup the session object
 */
//$session = new SessionStorage();

/**
 * Get the template
 */
if ($request->getMethod() == 'GET' && $request->getPath() == '/about') {
    $template = __DIR__ . '/templates/about.phtml';
} else {
    $template = __DIR__ . '/templates/home.phtml';
}

/**
 * Render the page
 */
ob_start();
require $template;
$content = ob_get_contents();
ob_end_clean();

require __DIR__ . '/templates/page.phtml';
