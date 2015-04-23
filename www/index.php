<?php
/**
 * index.php
 * 
 * Entry and Bootstrapping file for the application.
 *
 * @package     Lore Web Publishing Software 
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 * @license     http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version     0.1.0
 */


// Set base path
define("BASE_PATH", "/Users/Darragh/Documents/Websites/Lore/");

// Set path to web root
define("ROOT_PATH", BASE_PATH . "www/");

// Set path to system files
define("SYS_PATH", BASE_PATH . "lore/");

// Set path to contents folder
define("CONT_PATH", BASE_PATH . "Content/");

// Set path to cache folder
define("CACHE_PATH", SYS_PATH . "Cache/");



// Begin...
require(SYS_PATH . "Library/loader.php");
$loader = \Lore\Library\Loader::getInstance();
$loader->controller("boot.php");

require(SYS_PATH . "Config/config.php");

$boot = new \Lore\Controller\Boot($_SERVER["REQUEST_URI"], $loader, $config);
