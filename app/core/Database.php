<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

namespace Model;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * DATABASE TRAIT
 ***
 * This TRAIT is to CONNECT with the DATABASE
 * *
 ***
 * The PDO() Class Syntax is as follow:
 * *
 *  $Connection_Name = new PDO( 'Database:hostname;dbname', 'DB_USERNAME', 'DB_PASSWORD');
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Model}
 */
Trait Database {
  # Connect() --------
  private function connect() {
    $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
    $con = new \PDO($string,DBUSER,DBPASS);
		return $con;
  }
  # -----  ./Connect()

  # QUERY() --------
  public function query($query, $data = []) {
    $con = $this->connect();
		$stm = $con->prepare($query);

		$check = $stm->execute($data);
    if($check)
		{
			$result = $stm->fetchAll(\PDO::FETCH_OBJ);
			if(is_array($result) && count($result)) {
				return $result;
			}
      # --- ./IF
    }
    # --- ./IF

		return false;
	}
  # -----  ./QUERY()

  # GET_ROW() --------
  public function get_row($query, $data = []) {
    $con = $this->connect();
    $stm = $con->prepare($query);

    $check = $stm->execute($data);
    if ($check) {
      $result = $stm->fetchAll(\PDO::FETCH_OBJ);
      if (is_array($result) && count($result)) {
        return $result[0];
      }
      # --- ./IF
    }
    # --- ./IF

    return false;
  }
  # -----  ./GET_ROW()

}
# ----------  ./Database
