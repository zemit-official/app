<?php
/*
 +------------------------------------------------------------------------+
 | Zemit                                                                  |
 +------------------------------------------------------------------------+
 | Copyright (c) 2017-present Zemit Team and contributors                 |
 +------------------------------------------------------------------------+
 | This source file is subject to the New BSD License that is bundled     |
 | with this package in the file LICENSE.txt.                             |
 |                                                                        |
 | If you did not receive a copy of the license and are unable to         |
 | obtain it through the world-wide-web, please send an email             |
 | to contact@zemit.com so we can send you a copy immediately.            |
 +------------------------------------------------------------------------+
*/

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

use App\Bootstrap;

/*
 * REQUIRED BOOSTRAP CONSTANTS
 * Or you can set those environment variables in your .htaccess
 *     SetEnv VENDOR_PATH vendor
 *     SetEnv APP_NAMESPACE Zemit
 *     SetEnv APP_PATH /var/www/html/zemit/app/
 * Or with nginx:
 *     fastcgi_param VENDOR_PATH vendor;
 *     fastcgi_param APP_NAMESPACE Zemit;
 *     fastcgi_param APP_PATH /var/www/html/zemit/app/;
 * Or uncomment this part below if you want to force those path manually
 */
//define('APP_NAMESPACE', 'App');
//define('APP_PATH', ROOT_PATH . '/app');
//define('VENDOR_PATH', 'vendor');

// (DO NOT TOUCH THIS PART)
// Get the fallback root, vendor, app path and default app namespace
defined('VENDOR_PATH') || define('VENDOR_PATH', (getenv('VENDOR_PATH') ? getenv('VENDOR_PATH') : dirname(__DIR__) . '/vendor'));
defined('APP_NAMESPACE') || define('APP_NAMESPACE', (getenv('APP_NAMESPACE') ? getenv('APP_NAMESPACE') : 'App'));
defined('APP_PATH') || define('APP_PATH', (getenv('APP_PATH') ? getenv('APP_PATH') : dirname(__DIR__) . '/app'));

// Register Composer Autoloader
$composer = require_once VENDOR_PATH . '/autoload.php';
$composer->addPsr4(APP_NAMESPACE . '\\',  APP_PATH);

// Run Zemit CMS
$bootstrap = new Bootstrap();
echo $bootstrap->run();
