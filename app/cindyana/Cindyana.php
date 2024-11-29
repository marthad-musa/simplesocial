<?php

namespace Cindyana;

defined('CPATH') OR exit('Access DENIED!');

/**
 * CINDYANA Class
 * *
 * This CLASS is for the Commsnf Line TOOL
 * *
 */
class Cindyana {
  # Properties  ------------
  private $version = '1.0.0';
  # ----------  ./Properties


  # Database()  ------------
  public function db($argv) {
    # Properoties  ------------
    $mode   = $argv[1] ?? null;
    $param1 = $argv[2] ?? null;
    # ----------  ./Properoties
    
    /** ---- Clean NAME ----
     * *
     * Used for Cleaning the Database OR the Tables Name
     * *
     */
    // $param1 = preg_replace("/[^a-zA-Z0-9_]+/", "", $param1);
    
    switch ($mode) {
      case 'db:create':
        /** ---- CHECK IF() Param1 is Empty() ---- **/
        if (empty($param1))
          die("\n\rPlease, provide a 'database' name.\n\r");
        # ----  ./IF

        $db = new Database;
        $query = "CREATE DATABASE IF NOT EXISTS `" . $param1 . "`;";
        $db->query($query);

        die("\n\rDatabase was created successfully.\n\r");
        break;
      /** ------------ ./DB:Create ------------ **/
      
      case 'db:drop':
        /** ---- CHECK IF() Param1 is Empty() ---- **/
        if (empty($param1))
          die("\n\rPlease, provide a 'database' name.\n\r");
        # ----  ./IF

        $db = new Database;
        $query = "DROP DATABASE `" . $param1 . "`;";
        $db->query($query);

        die("\n\rDatabase was deleted successfully.\n\r");
        break;
      /** ------------ ./DB:Drop ------------ **/
        
      case 'db:seed':
        # code...
        break;
      /** ------------ ./DB:Seed ------------ **/

      case 'db:table':
        /** ---- CHECK IF() Param1 is Empty() ---- **/
        if (empty($param1))
          die("\n\rPlease, provide a 'table' name.\n\r");
        # ----  ./IF

        $db    = new Database;
        $query = "DESCRIBE `" . $param1 . "`;";
        /** ---- The QUERY Result ---- **/
        $res   = $db->query($query);

        if ($res) {
          # -- TRUE Block --
          print_r($res);
        } else {
          # -- FALSE Block --
          echo "\n\rCan not find data in $param1 table.\n\r";
        }
        # ----  ./IF/ELSE
        die();
        break;
      /** ------------ ./DB:Table ------------ **/

      case 'migrate':
        # code...
        break;
      /** ------------ ./MIGRATE ------------ **/
      
      default:
        die("\n\rUnknown command $argv[1].\n\r");
        break;
    }
    # ----  ./SWITCH
  }
  # ----------  ./Database()
  
  
  # Make()  ------------
  public function make($argv) {
    # Properoties  ------------
    $mode      = $argv[1] ?? null;
    $classname = $argv[2] ?? null;
    # ----------  ./Properoties
    
    /** ---- CHECK IF() CLASS NAME is Empty() ---- **/
    if (empty($classname))
      die("\n\rPlease, provide a 'class' name.\n\r");
    # ----  ./IF
    
    /** ---- Clean CLASS NAME ---- **/
    $classname = preg_replace("/[^a-zA-Z0-9_]+/", "", $classname);
    
    /** ---- CHECK IF() CLASS NAME is Appropriate ---- **/
    if (preg_match("/^[^a-zA-Z_]+/", $classname))
      die("\n\rClass names must not start with a number.\n\r");
    # ----  ./IF
    
    switch ($mode) {
      case 'make:controller':
        /** ---- CHECK IF() CLASS NAME EXISTS ---- **/
        $filename = 'app'.DS.'controllers'.DS.ucfirst($classname).".php";
        if (file_exists($filename))
          die("\n\rThe controller already exists.\n\r");
        # ----  ./IF
        
        $sample_file = file_get_contents('app'.DS.'cindyana'.DS.'samples'.DS.'controller-sample.php');
        $sample_file = preg_replace("/\{CLASSNAME\}/", ucfirst($classname), $sample_file);
        $sample_file = preg_replace("/\{classname\}/", strtolower($classname), $sample_file);
        
        if (file_put_contents($filename, $sample_file)) {
          # -- TRUE Block --
          die("\n\rController was created successfully.\n\r");
        } else {
          # -- FALSE Block --
          die("\n\rFailed to create controller due to an error.\n\r");
        }
        # ----  ./IF/ELSE
        break;
      /** ------------ ./MAKE:Controller ------------ **/
      
      case 'make:migration':
        # code...
        break;
      /** ------------ ./MAKE:Migration ------------ **/
      
      case 'make:model':
        /** ---- CHECK IF() CLASS NAME EXISTS ---- **/
        $filename = 'app'.DS.'models'.DS.ucfirst($classname).".php";
        if (file_exists($filename))
          die("\n\rThe model already exists.\n\r");
        # ----  ./IF
        
        $sample_file = file_get_contents('app'.DS.'cindyana'.DS.'samples'.DS.'model-sample.php');
        $sample_file = preg_replace("/\{CLASSNAME\}/", ucfirst($classname), $sample_file);
        
        /** ---- Adjusting Table Name ---- **/
        if (!preg_match("/s$/", $classname))
          $sample_file = preg_replace("/\{table\}/", strtolower($classname).'s', $sample_file);
        # ----  ./IF
        
        if (file_put_contents($filename, $sample_file)) {
          # -- TRUE Block --
          die("\n\rModel was created successfully.\n\r");
        } else {
          # -- FALSE Block --
          die("\n\rFailed to create model due to an error.\n\r");
        }
        # ----  ./IF/ELSE
        break;
      /** ------------ ./MAKE:Model ------------ **/
      
      case 'make:seeder':
        # code...
        break;
      /** ------------ ./MAKE:Seeder ------------ **/
      
      default:
        die("\n\rUnknown command $argv[1].\n\r");
        break;
    }
    # ----  ./SWITCH
  }
  # ----------  ./Make()


  # Migrate()  ------------
  public function migrate() {
    echo "\n\rThis is the Migrate function \n\r";
  }
  # ----------  ./Migrate()


  # Help()  ------------
  public function help() {
    echo "

    Cindyana v$this->version Command Line Tool

    Database
      db:create           Create a new database schema.
      db:drop             Drop/delete a Database.
      db:seed             Runs the specified seeder to populate known data into the database.
      db:table            Retrieves information on the selected table.
      migrate             Locates and runs a migration from the specified plugin folder.
      migrate:refresh     Does a rollback followed by a latest to refresh the current state of the database.
      migrate:rollback    Runs the 'down' method for a migration in the specified plugin folder.

      Generators
      make:controller     Generates a new controller file.
      make:migration      Generates a new migration file.
      make:model          Generates a new model file.
      make:seeder         Generates a new seeder file.

    ";
  }
  # ----------  ./Help()


  #   ------------
  # ----------  ./
}
# --------------  ./Cindyana