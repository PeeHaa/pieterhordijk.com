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
 * Get the database connection
 */
$databaseConnection = new MFW_Db_Connection(MFW_DB_ENGINE, MFW_DB_NAME, MFW_DB_HOST, MFW_DB_PORT, MFW_DB_USERNAME, MFW_DB_PASSWORD);

/**
 * Get the model factory
 */
$modelFactory = new ModelFactory($databaseConnection);

/**
 * Get the view
 */
$view = new MFW_View($router, MFW_SITE_PATH.'/code/views', $modelFactory);

/**
 * Instantiate the user
 */
$user = new MFW_User();
$view->user = $user->getCurrentUser();

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