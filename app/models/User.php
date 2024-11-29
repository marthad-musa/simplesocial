<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

namespace Model;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * Main USER CLASS
 ***
 * EXTENDS MODEL
 * *
 * All Methods within Must Be PUBLIC
 * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Model}
 */

class User {

  # EXTENDING MODEL TRAIT  --------
  use Model;
  # ------  ./EXTENDING MODEL TRAIT

  # Properties  --------
  protected $table             = 'users';
  protected $primaryKey        = 'id';
  protected $loginUniqueColumn = 'email';

  protected $allowedColumns = [
    'img',
    'image',
    'username',
    'email',
    'password',
    'date',
  ];

  /**********************************
   * VALIDATION RULES includes:
      required
      alpha
      alpha_space
      alpha_numeric
      alpha_numeric_symbol
      alpha_symbol
      email
      numeric
      unique
      symbol
      not_less_than_8_chars
   * Other VALIDATION RULES may be added
   *********************************/
  protected $onInsertValidationRules = [
    'username' => [
      'alpha',
      'required',
    ],
    'email' => [
      'email',
      'unique',
      'required',
    ],
    'password' => [
      'not_less_than_8_chars',
      'required',
    ],
    'terms' => [
      'accept',
      'required',
    ],
  ];

  protected $onUpdateValidationRules = [
    'username' => [
      'alpha',
      'required',
    ],
    'email' => [
      'email',
      'unique',
      'required',
    ],
    'password' => [
      'not_less_than_8_chars',
      'required',
    ],
  ];
  # ------  ./Properties


  # SignUp()  --------
	public function signup($data) {
		if ($this->validate($data)) {
			/** ---- Add extra USER columns here ---- **/
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			$data['date'] = date("Y-m-d H:i:s");
			$data['date_created'] = date("Y-m-d H:i:s");

			$this->insert($data);
			redirect('login');
		}
    # ----  ./IF
	}
  # ------  ./SignUp()


  # Login()  --------
	public function login($data) {
		# Properties  --------
    $row = $this->first([$this->loginUniqueColumn=>$data[$this->loginUniqueColumn]]);
    # ------  ./Properties

		if ($row) {
			/** ---- Confirm PASSWORD ---- **/
			if (password_verify($data['password'], $row->password)) {
				$ses = new \Core\Session;
				$ses->auth($row);
				redirect('home');
			} else {
				$this->errors[$this->loginUniqueColumn] = "Wrong $this->loginUniqueColumn or password";
			}
      # ----  ./IF/ELSE
		}else{
			$this->errors[$this->loginUniqueColumn] = "Wrong $this->loginUniqueColumn or password";
		}
    # ----  ./IF/ELSE
	}
  # ------  ./Login()

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
# ----------  ./User
