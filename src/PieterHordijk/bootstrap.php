<?php
/**
 * This bootstraps the library
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

use PieterHordijk\Core\Autoloader;

require_once __DIR__ . '/Core/Autoloader.php';

$autoloader = new Autoloader(__NAMESPACE__, dirname(__DIR__));
$autoloader->register();

require_once __DIR__ . '/../../vendor/password_compat/lib/password.php';

require_once __DIR__ . '/../../vendor/Artax/autoload.php';

require_once __DIR__ . '/../../vendor/MarkdownRewritten/Markdown.php';
