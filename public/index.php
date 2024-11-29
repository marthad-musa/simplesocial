<?php

session_start();

/**
 * Valid PHP Version?
 * *
 * v.8.2.12
 */
$minPHPVersion = '8.0';
if (phpversion() < $minPHPVersion) {
  die("Your PHP version must be {$minPHPVersion} or higher to run this app. Your current version is: " . phpversion());
} # ----  ./IF

# Add Namespaces  ------
# --------  ./Namespaces

/**
 * Path to this file
 * *
 * __DIR__ will always echo the PATH to the file the CODE is written in
 * DIRECTORY_SEPARATOR is a CONSTANT that represent either a '/' OR a '\' DEPENDING on the OS
 */
define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);

require "../app/core/init.php";

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);
# ------  ./IF/ELSE

$app = new App;
$app->loadController();


/**
 * 
 * 5:30:00
 * 5:43:00
 * 
 */