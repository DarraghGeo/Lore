<?php if ( ! defined("BASE_PATH")) die("No direct access.");
/**
 * config.php
 *
 * Configuration file to make customise application
 *
 * @package     Lore Web Publishing Software
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 */

// Use caching
$config["cache"] = false;

// How long to keep cached files (minutes)
$config["cache_expiry"] = 10;

// Number of posts to show per page
$config["per_page"] = 5;

// Extension of the content files
$config["extension"] = "md";

// The view to use if page/directory specific view is unavailable
$config["default_view"] = "default.php";

// Location of "Page Not Found" view
$config["404_view"] = "_System/404.php";
