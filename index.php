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
define("BASE_PATH", "/Users/Darragh/Documents/Websites/");

// Set path to web root
define("ROOT_PATH", BASE_PATH . "webroot/");

// Set path to system files
define("SYS_PATH", ROOT_PATH . "lore/");

// Set path to contents folder
define("CONT_PATH", SYS_PATH . "Content/");

// Set path to cache folder
define("CACHE_PATH", SYS_PATH . "Cache/");


/******************************************/


// Initiate Loader
require(SYS_PATH . "Library/loader.php");
$loader = loader::getInstance();


// Initiate the Register and add Loader and Config
$loader->library('register.php');
$register = register::getInstance();

$register->load = $loader;

// Include configuration files
require(SYS_PATH . "config.php");
$register->config = $config;


if ($register->config["cache"])
{
    $loader->library('cache.php');
    $cache = new Cache($register->config["cache_expiry"]);

    $register->cache = $cache;
}



/******************************************/


// Begin...
session_start();


if ($config["protected"] !== TRUE || isset($_SESSION["timestamp"]))
{
    $register->load->controller("page.php");

    $page = new Page($_SERVER["REQUEST_URI"], $register);
}

if ($config["protected"] === TRUE && !isset($_SESSION["timestamp"]))
{
    $register->load->controller("login.php");

    $page = new login($register);
}
