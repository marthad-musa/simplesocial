<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

/**
 * Session CLASS
 * *
 * Saves or READ Data to the current SESSION
 * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Core}
 */

namespace Core;

defined('ROOTPATH') OR exit('Access DENIED!');

class Session {

  /** ---- PROPERTIES ---- **/
  public $mainkey = 'APP';
  public $userkey = 'USER';
  # ---------------  ./PROPERTIES


  /** ---- Activate SESSION if not yet started ---- **/
  private function start_session():int {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    # ----  ./IF

    return 1;
  }
  # ---------------  ./Start_Session()


  /** ---- Put DATA into the SESSION ---- **/
  public function set(mixed $keyOrArray, mixed $value = ''):int {
    $this->start_session();

    if (is_array($keyOrArray)) {
      foreach ($keyOrArray as $key => $value) {
        $_SESSION[$this->mainkey][$key] = $value;
      }
      # ----  ./FOREACH

      return 1;
    }
    # ----  ./IF

    $_SESSION[$this->mainkey][$keyOrArray] = $value;

    return 1;
  }
  # ---------------  ./SET()


  /** 
   * Get DATA from the SESSION
   * *
   * IF DATA not found, RETURN DEFAULT
   * *
   */
  public function get(string $key, mixed $default = ''):mixed {
    $this->start_session();

    if (isset($_SESSION[$this->mainkey][$key])) {
      return $_SESSION[$this->mainkey][$key];
    }
    # ----  ./IF
  }
  # ---------------  ./GET()


  /** ---- Save the USER row DATA into the SESSION after LOGIN ---- **/
  public function auth(mixed $user_row):int {
    $this->start_session();

    $_SESSION[$this->userkey] = $user_row;

    return 0;
  }
  # ---------------  ./AUTH()


  /** ---- REMOVE USER DATA from SESSION ---- **/
  public function logout():int {
    $this->start_session();

    if (!empty($_SESSION[$this->userkey])) {
      unset($_SESSION[$this->userkey]);
    }
    # ----  ./IF

    return 0;
  }
  # ---------------  ./LOGOUT()


  /** ---- CHECK if USER is logged in ---- **/
  public function is_logged_in():bool {
    $this->start_session();

    if (!empty($_SESSION[$this->userkey])) {
      return true;
    }
    # ----  ./IF

    return false;
  }
  # ---------------  ./IS_LOGGED_IN()


  /** ---- CHECK if USER is an ADMIN ---- **/
  // public function is_admin():bool {
  //   $this->start_session();
  //   $db = new \Core\Database();

  //   if (!empty($_SESSION[$this->userkey])) {
  //     $arr = [];
  //     $arr['id'] = $_SESSION[$this->userkey]->role_id;

  //     if ($db->get_row("SELECT * FROM `auth_roles` WHERE `id` = :id && `role` = 'admin' LIMIT 1", $arr['id'])) {
  //       return true;
  //     }
  //     # ----  ./IF
  //   }
  //   # ----  ./IF

  //   return false;
  // }
  # ---------------  ./IS_ADMIN()


  /** ---- Gets DATA from a column in the SESSION USER DATA ---- **/
  public function user(string $key = '', mixed $default = ''):mixed {
    $this->start_session();

    if (empty($key) && !empty($_SESSION[$this->userkey])) {
      return $_SESSION[$this->userkey];
    } else if (!empty($_SESSION[$this->userkey]->$key)) {
      return $_SESSION[$this->userkey]->$key;
    }
    # ----  ./IF/ELSE/IF

    return $default;
  }
  # ---------------  ./USER()


  /** ---- RETURNS DATA from a KEY and DELETES it ---- **/
  public function pop(string $key, mixed $default = ''):mixed {
    $this->session_start();

    if (!empty($_SESSION[$this->mainkey][$key])) {
      $value = $_SESSION[$this->mainkey][$key];
      unset($_SESSION[$this->mainkey][$key]);
      return $value;
    }
    # ----  ./IF

    return $default;
  }
  # ---------------  ./POP()


  /** ---- RETURNS ALL DATA from the APP array() ---- **/
  public function all():mixed {
    $this->start_session();

    if (isset($_SESSION[$this->mainkey])) {
      return $_SESSION[$this->mainkey];
    }
    # ----  ./IF

    return [];
  }
  # ---------------  ./ALL()


  /** ------  ------ **/
  # ----------------  ./
}
# -----------------  ./SESSION