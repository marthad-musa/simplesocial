<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

namespace Model;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * Main Model TARIT
 ***
 * This TRAIT is Sepoused to EXTENDS DATABASE
 * *
 * To EXTENDS TRAITES:
 * use TRAIT_NAME;
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Model}
 */
Trait Model {

  # EXTENDING DATABASE TRAIT  --------
  use Database;
  # ------  ./EXTENDING DATABASE TRAIT


  # Properties  --------
  public $limit        = 10;
  public $offset       = 0;
  public $order_type   = "DESC";
  public $order_column = "id";
  public $errors       = [];
  # ------  ./Properties


  /**
   * BASIC C.R.U.D. SYSTEM
   ***
   * To READ: use QUERY() located in DATABASE TRAIT
   * We can move it here.
   * However, it's best to leave it there !
   */
  # findAll()  --------
  public function findAll() {
    # Properties  --------
    $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
    # ------  ./Properties

    return $this->query($query);
  }
  # ------  ./findAll()


  # WHERE()  --------
  public function where($data, $data_not = []) {
    # Properties  --------
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);
    $query = "SELECT * FROM $this->table WHERE ";
    # ------  ./Properties

    foreach ($keys as $key) {
      $query .= $key . " = :" . $key . " && ";
    }
    # ------  ./FOREACH

    foreach ($keys_not as $key) {
      $query .= $key . " != :" . $key . " && ";
    }
    # ------  ./FOREACH

    $query = trim($query, " && ");

    $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
    $data = array_merge($data, $data_not);

    return $this->query($query, $data);
  }
  # ------  ./WHERE()


  # FIRST()  --------
  public function first($data, $data_not = []) {
    # Properties  --------
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);
    $query = "SELECT * FROM $this->table WHERE ";
    # ------  ./Properties

    foreach ($keys as $key) {
      $query .= $key . " = :" . $key . " && ";
    }
    # ------  ./FOREACH

    foreach ($keys_not as $key) {
      $query .= $key . " != :" . $key . " && ";
    }
    # ------  ./FOREACH

    $query = trim($query, " && ");

    $query .= " LIMIT $this->limit OFFSET $this->offset";
    $data = array_merge($data, $data_not);

    $result = $this->query($query, $data);
    if ($result)
      return $result[0];
    # ------  ./IF
  
    return false;
  }
  # ------  ./FIRST()


  # INSERT()  --------
  public function insert($data) {
    /**
     * REMOVING UNWANTED COLUMNS FROM $DATA
     */
    if (!empty($this->allowedColumns)) {
      foreach ($data as $key => $value) {
        if (!in_array($key, $this->allowedColumns)) {
          unset($data[$key]);
        }
        # ------  ./IF
      }
      # ------  ./FOREACH
    }
    # ------  ./IF

    # Properties  --------
    $keys = array_keys($data);
    # ------  ./Properties

    $query = "INSERT INTO $this->table (".implode(",", $keys).") VALUES (:".implode(",:", $keys).") ";
    $this->query($query, $data);

    return false;
  }
  # ------  ./INSERT()


  # UPDATE()  --------
  public function update($id, $data, $id_column = 'id') {
    /**
     * REMOVING UNWANTED COLUMNS FROM $DATA
     * *
     * SHOULD BE ADDED TO FUNCTIONS
     */
    if (!empty($this->allowedColumns)) {
      foreach ($data as $key => $value) {
        if (!in_array($key, $this->allowedColumns)) {
          unset($data[$key]);
        }
        # ------  ./IF
      }
      # ------  ./FOREACH
    }
    # ------  ./IF
    
    # Properties  --------
    $keys = array_keys($data);
    $query = "UPDATE $this->table SET ";
    # ------  ./Properties

    foreach ($keys as $key) {
      $query .= $key . " = :" . $key . ", ";
    }
    # ------  ./FOREACH

    $query = trim($query, ", ");

    $query .= " WHERE $id_column = :$id_column ";

    $data[$id_column] = $id;
    
    $this->query($query, $data);
    return false;
  }
  # ------  ./UPDATE()


  # DELETE()  --------
  public function delete($id, $id_column = 'id') {
    # Properties  --------
    $data[$id_column] = $id;
    $query = "DELETE FROM $this->table WHERE $id_column = :$id_column ";
    # ------  ./Properties

    $this->query($query, $data);

    return false;
  }
  # ------  ./DELETE()


  # getError()  --------
  public function getError($key) {
    if (!empty($this->errors[$key]))
      return $this->errors[$key];
    # ----  ./IF

    return "";
  }
  # ------  ./getError()


  # getPrimaryKey()  --------
  protected function getPrimaryKey() {
    return $this->primaryKey ?? 'id';
  }
  # ------  ./getPrimaryKey()


  # VALIDATE()  --------
  public function validate($data) {
		$this->errors = [];

		if(empty($data['username'])) {
			$this->errors['username'] = "Username is required";
		} else if (!preg_match("/^[a-zA-Z]+$/", $data['username'])) {
      $this->errors['username'] = "Username can only contain letters without spacings";
    }
		
    if(empty($data['email'])) {
			$this->errors['email'] = "Email is required";
		}else
		if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
			$this->errors['email'] = "Email is not valid";
		}
		
		if(empty($data['password'])) {
			$this->errors['password'] = "Password is required";
		}
		
    if(empty($data['terms'])) {
			$this->errors['terms'] = "Please accept the Terms &amp; Conditions";
		}

    // if (empty($post_data['post']) && empty($files_data['name'])) {
    //   $this->errors['post'] = "Please, write something to post";
    // }
    # ----  ./IF

		if(empty($this->errors)) {
			return true;
		}

		return false;
	}


  // public function validate($data) {
  //   $this->errors = [];
  
  //   if (!empty($this->primaryKey) && !empty($data[$this->primaryKey])) {
  //     # -- TRUE | UPDATE Block --
  //     $validationRules = $this->onUpdateValidationRules;
  //   } else {
  //     # -- FALSE | INSERT Block --
  //     $validationRules = $this->onInsertValidationRules;
  //   }
  //   # ----  ./IF/ELSE

  //   if (!empty($validationRules)) {
  //     foreach ($validationRules as $column => $rules) {
  //       if (!isset($data[$column]))
  //         continue;
  //       # ----  ./IF

  //       foreach ($rules as $rule) {
  //         switch ($rule) {
  //           /** ---- REQUIRED ---- **/
  //           case 'required':
  //             if(empty($data[$column]))
  //               $this->errors[$column] = ucfirst($column) . " is REQUIRED";
  //             break;

  //           /** ---- EMAIL ---- **/
  //           case 'email':
  //             if(!filter_var(trim($data[$column]),FILTER_VALIDATE_EMAIL))
  //               $this->errors[$column] = "Invalid E-mail address";
  //             break;

  //           /** ---- TERMS & CONDITIONS ---- **/
  //           case 'accept':
  //             // if(!empty($data[$column]) || $data[$column] !== "accept")
  //             if(!empty($data['terms']) && $data['terms'] !== "accept")
  //               $this->errors['terms'] = "Please, Accept the " . ucfirst($column) . " &amp; Conditions";
  //             break;

  //           /** ---- ALPHA ---- **/
  //           case 'alpha':
  //             if(!preg_match("/^[a-zA-Z]+$/", trim($data[$column])))
  //               $this->errors[$column] = ucfirst($column) . " should only have Alphabetical letters without spaces";
  //             break;

  //           /** ---- ALPHA SPACE ---- **/
  //           case 'alpha_space':
  //             if(!preg_match("/^[a-zA-Z ]+$/", trim($data[$column])))
  //               $this->errors[$column] = ucfirst($column) . " should have Alphabetical letters and spaces";
  //             break;

  //           /** ---- ALPHA NUMERIC ---- **/
  //           case 'alpha_numeric':
  //             if(!preg_match("/^[a-zA-Z0-9]+$/", trim($data[$column])))
  //               $this->errors[$column] = ucfirst($column) . " should have Alphabetical letters and numbers";
  //             break;

  //           /** ---- ALPHA NUMERIC SYMBOL ---- **/
  //           case 'alpha_numeric_symbol':
  //             if(!preg_match("/^[a-zA-Z0-9\-\_\$\%\*\[\]\(\)\& ]+$/", trim($data[$column])))
  //               $this->errors[$column] = ucfirst($column) . " should have Alphabetical letters and spaces";
  //             break;

  //           /** ---- ALPHA SYMBOL ---- **/
  //           case 'alpha_symbol':
  //             if(!preg_match("/^[a-zA-Z\-\_\$\%\*\[\]\(\)\& ]+$/", trim($data[$column])))
  //               $this->errors[$column] = ucfirst($column) . " should have Alphabetical letters and spaces";
  //             break;

  //           /** ---- NOT LESS THAN 8 CHARACTORS ---- **/
  //           case 'not_less_than_8_chars':
  //             if(strlen(trim($data[$column])) < 8)
  //               $this->errors[$column] = ucfirst($column) . " should not be less than 8 characters";
  //             break;

  //           /** ---- UNIQUE ---- **/
  //           case 'unique':
  //             $key = $this->getPrimaryKey();
              
  //             if(!empty($data[$key])) {
  //               /** ---- Edit Mode ---- **/
  //               if($this->first([$column=>$data[$column]],[$key=>$data[$key]])){
  //                 $this->errors[$column] = ucfirst($column) . " should be unique";
  //               }
  //               # ----  ./IF
  //             } else {
  //               /** ---- Insert Mode ---- **/
  //               if($this->first([$column=>$data[$column]])){
  //                 $this->errors[$column] = ucfirst($column) . " should be unique";
  //               }
  //               # ----  ./IF
  //             }
  //             # ----  ./IF/ELSE
  //             break;

  //           /** ---- DEFAULT ---- **/
  //           default:
  //             $this->errors['rules'] = "The rule&colon; " . ucfirst($rule) . " was not found!";
  //             break;
  //         }
  //         # ----  ./SWITCH  
  //       }
  //       # ----  ./FOREACH
  //     }
  //     # ----  ./FOREACH
  //   }
  //   # ----  ./IF

  //   if (empty($this->errors)) {
  //     return true;
  //   }
  //   # ----  ./IF

  //   return false;
  // }
  # ------  ./VALIDATE()


  # CREATING TABLES  --------
  public function create_table() {
    $query = "
      CREATE TABLE IF NOT EXISTS `simplesocial_db`.`users`(
        `id` int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        `img` BLOB NULL,
        `image` VARCHAR(1024) NULL,
        `username` VARCHAR(50) NOT NULL,
        `email` VARCHAR(30) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `date` DATETIME NULL,

        KEY `username` (`username`),
        KEY `email` (`email`)
      );
    ";
    $this->query($query);
  }
  # ------  ./CREATING TABLES
}
# ----------  ./Model
