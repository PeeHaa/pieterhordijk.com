<?php

/**
 * Setup error reporting
 */
ini_set('display_errors',1);
error_reporting(E_ALL | E_STRICT);

/**
 * Set the absolute base path of the library
 */
define('MFW_LIB_PATH', '/path/to/lib/MicroFW');

/**
 * Initialize the library
 */
require_once(MFW_LIB_PATH.'/init.php');

/**
 * Set the domain name(s)
 */
define('MFW_BASE_DOMAIN', 'pieterhordijk.localhost');
define('MFW_BASE_URL', 'http://'.MFW_BASE_DOMAIN);
define('MFW_BASE_SSL_URL', 'https://'.MFW_BASE_DOMAIN);

/**
 * Set the environment (MFW_ENV_DEBUG, MFW_ENV_PRODUCTION)
 */
define('MFW_ENV_MODE', MFW_ENV_DEBUG);

/**
 * Setup mail
 */
define('MFW_MAIL_USE', False);
define('MFW_DEBUG_ADDRESS', 'email@example.com');

/**
 * Set the OS
 */
define('MFW_OS', MFW_OS_WINDOWS);

/**
 * Set the absolute base path of the certificate bundle (for SSL cURL connections)
 */
define('MFW_CERT_BUNDLE', MFW_LIB_PATH.'/cacert.pem');

/**
 * Setup the proxy settings
 */
define('MFW_PROXY_USE', False);
define('MFW_PROXY_HOST', '');
define('MFW_PROXY_PORT', '');

/**
 * Set the databases settings
 */
define('MFW_DB_ENGINE', 'pgsql');
define('MFW_DB_NAME', 'db');
define('MFW_DB_HOST', 'localhost');
define('MFW_DB_PORT', null);
define('MFW_DB_USERNAME', 'dbusername');
define('MFW_DB_PASSWORD', 'dbpassword');

/**
 * Set the Google Analytics code (or false if disabled)
 */
define('MFW_GA_CODE', False);

/**
 * Set the base name of the project
 */
define('MFW_SITE_NAME', 'Pieter Hordijk');

/**
 * Setup sessions
 */
session_set_cookie_params(1209600, '/', '.'.MFW_BASE_DOMAIN, False, True);

/**
 * Set the base name of the cookies
 */
define('MFW_SITE_COOKIE_NAME', 'PieterHordijk');

/**
 * Set the timezone
 */
date_default_timezone_set('Europe/Amsterdam');