<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * CLASS AUTO LOADER
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${NAMESPACE}
 */
spl_autoload_register(function($classname) {

  /** ---- To AVOIDE NAMESPACES ---- **/
  $classname = explode("\\", $classname);

  /** ---- To GRAB the last ITEM in an ARRAY() ---- **/
  $classname = end($classname);
  
  require $filename = "../app/models/".ucfirst($classname).".php";
});

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';

