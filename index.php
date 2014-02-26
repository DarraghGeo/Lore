<?php


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
$R = register::getInstance();

$R->load = $loader;

// Include configuration files
require(SYS_PATH . "config.php");
$R->config = $config;


if ($R->config["cache"])
{
    $loader->library('cache.php');
    $cache = new Cache($R->config["cache_expiry"]);

    $R->cache = $cache;
}



/******************************************/


// Begin...
session_start();


if ($config["protected"] !== TRUE || isset($_SESSION["timestamp"]))
{
    $R->load->controller("page.php");

    $page = new Page($_SERVER["REQUEST_URI"], $R);
}

if ($config["protected"] === TRUE && !isset($_SESSION["timestamp"]))
{
    $R->load->controller("login.php");

    $page = new login($config, $loader);
}
