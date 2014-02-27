<?php if ( ! defined("BASE_PATH")) die("No direct access.");

/**
 * config.php
 *
 * Configuration file to make customise application
 *
 * @package     Lore Web Publishing Software
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 */

// Password protect the website
$config["protected"] = TRUE;

// Array containing MD5 hashes of passwords
$config["password"] = "5f4dcc3b5aa765d61d8327deb882cf99";

// The length of time before a user can be inactive
$config["session_length"] = 60;

// Use caching
$config["cache"] = TRUE;

// How long to keep cached files (minutes)
$config["cache_expiry"] = 10;


// Number of posts to show per page
$config["per_page"] = 5;

// Extension of the content files
$config["extension"] = "md";
