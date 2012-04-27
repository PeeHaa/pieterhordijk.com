<?php
/**
 * Set the absolute base path of the project
 */
define ('MFW_SITE_PATH', realpath(dirname(__FILE__)));

/**
 * Set the absolute public path of the project
 */
define('MFW_PUBLIC_PATH', MFW_SITE_PATH.'/public');

/**
 * Setup the settings of the project
 */
require_once(MFW_SITE_PATH.'/init-deployment.php');

/**
 * Get the request
 */
$request = new MFW_Http_Request($_SERVER['SCRIPT_URI']);

/**
 * Get the rewrite-engine
 */
 $router = new MFW_Router_Rewrite($routes, $request);

/**
 * Get the view
 */
$view = new MFW_View($router, MFW_SITE_PATH.'/code/views');

/**
 * Create an instance of the front controller
 */
$frontController = new MFW_Controller_Dispatcher($router, $view, $request);

/**
 * Set the controller path
 */
$frontController->setControllerPath(MFW_SITE_PATH.'/code/controllers');

/**
 * Dispatch the controller
 */
$frontController->dispatch();