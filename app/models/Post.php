<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

namespace Model;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * POST CLASS
 ***
 * EXTENDS MODEL
 * *
 * All Methods within Must Be PUBLIC
 * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Model}
 */

class Post {

  # EXTENDING MODEL TRAIT  --------
  use Model;
  # ------  ./EXTENDING MODEL TRAIT

  # Properties  --------
  protected $table             = 'posts';
  protected $primaryKey        = 'id';

  protected $allowedColumns = [
    'image',
    'post',
    'user_id',
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


  # Add_User_Data()  --------
  public function add_user_data($rows) {
    foreach ($rows as $key => $row) {
      $res = $this->get_row("SELECT * FROM `users` WHERE `id` = :id ", ['id'=>$row->user_id]);
      $rows[$key]->user = $res;
    }
    # ----  ./FOREACH

    return $rows;
  }
  # ------  ./Add_User_Data()


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
  
  # Validate()  --------
  public function validate($post_data, $files_data, $id = NULL) {
    $this->errors = [];

    if (empty($post_data['post']) && empty($files_data['image']['name'])) {
      $this->errors['post'] = "Please, type something to post";
    }
    # ----  ./IF

    if (empty($this->errors)) {
      return TRUE;
    }
    # ----  ./IF

    return FALSE;
  }
  # ------  ./Validate()

  # CREATING Post TABLE  --------
  public function create_post_table() {
    $query = "
      CREATE TABLE IF NOT EXISTS `simplesocial_db`.`posts`(
        `id` int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        `user_id` int(11) UNSIGNED DEFAULT 0,
        `post` TEXT NULL,
        `image` VARCHAR(1024) NULL,
        `date` DATETIME NULL,

        KEY `user_id` (`user_id`),
        KEY `date` (`date`)
      );
    ";
    $this->query($query);
  }
  # ------  ./CREATING Post TABLE
}
# ----------  ./Post
