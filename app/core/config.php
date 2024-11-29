<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * CONSTANTS
 ***
 * Super GLOBAL Variables
 * 
 * The General Rule is:
 * define (CONSTANT_Name, CONSTANT_Value)
 ***
 * DATABASE NAEM
 *
 * (   - my_db -   )
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${NAMESPACE}
 */

if ((empty($_SERVER['SERVERNAME']) && php_sapi_name() == 'cli') || (!empty($_SERVER['SERVER_NAME'])) && ($_SERVER['SERVER_NAME'] == 'localhost')) {

  /**
   * --- LOCAL Configurations ---
   */

  # --- DATABASE NAME
  define('DBNAME', 'simplesocial_db');
  
  # --- DATABASE HOST
  define('DBHOST', 'localhost');
  
  # --- DATABASE USERNAME
  define('DBUSER', 'root');
  
  # --- DATABASE PASSWORD
  define('DBPASS', '');

  # --- DATABASE DRIVER
  define('DBDRIVER', '');


  # Full URL for LOCAL Hosting
  define('ROOT', 'http://localhost/tech_tag/simplesocial/public');

} else {
  
  /**
   * --- ONLINE Configurations ---
   */
  
  # --- DATABASE NAME
  define('DBNAME', 'simplesocial_db');
  
  # --- DATABASE HOST
  define('DBHOST', 'localhost');
  
  # --- DATABASE USERNAME
  define('DBUSER', 'root');
  
  # --- DATABASE PASSWORD
  define('DBPASS', '');

  # --- DATABASE DRIVER
  define('DBDRIVER', '');


  # Full URL for ONLINE Hosting
  define('ROOT', 'https://www.YourWebsite.com');

}
# -------------------- ./IF/ELSE

define('APP_NAME', 'SimpleSocial');
define('APP_DESC', 'Testing PHP MVC OOP Framework');

/**
 * TRUE means SHOW ERRORS
 * *
 */
define('DEBUG', true);