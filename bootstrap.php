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
    PieterHordijk\Storage\Session as SessionStorage,
    PieterHordijk\Security\Storage;

/**
 * Start the session
 */
session_start();

/**
 * Bootstrap the PitchBlade library
 */
require_once __DIR__ . '/src/PieterHordijk/bootstrap.php';

/**
 * Setup the environment specific settings
 */
require_once __DIR__ . '/init.deployment.php';

/**
 * Setup the request object
 */
$request = new Request($_SERVER, $_GET, $_POST, $_COOKIE);

/**
 * Setup the GitHub API storage
 */
$apiStorage = new Storage();
$apiStorage->set('id', $github['clientId']);
$apiStorage->set('secret', $github['clientSecret']);

/**
 * Setup the session object
 */
//$session = new SessionStorage();

/**
 * Get the template
 */
if ($request->getMethod() == 'GET' && $request->getPath() == '/open-source') {
    $template = __DIR__ . '/templates/open-source.phtml';
} elseif ($request->getMethod() == 'GET' && strpos($request->getPath(), '/open-source') === 0) {
    $template = __DIR__ . '/templates/open-source-project.phtml';
} elseif ($request->getMethod() == 'GET' && $request->getPath() == '/demos') {
    $template = __DIR__ . '/templates/demos.phtml';
} elseif ($request->getMethod() == 'GET' && $request->getPath() == '/contact') {
    $template = __DIR__ . '/templates/contact.phtml';
} elseif ($request->getMethod() == 'POST' && $request->getPath() == '/contact') {
    $template = __DIR__ . '/templates/contact.phtml';
} elseif ($request->getMethod() == 'GET' && $request->getPath() == '/contact-success') {
    $template = __DIR__ . '/templates/contact-success.phtml';
} elseif ($request->getMethod() == 'GET' && $request->getPath() == '/about') {
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
