<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

namespace Core;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * Request CLASS
 * *
 * SET & GET DATA in the POST & GET variables
 * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Core}
 */
class Request {

  /** ---- PROPERTIES ---- **/
  # ---------------  ./PROPERTIES


  /** ---- CHECK which POST METHOD was used ---- **/
  public function method():string {
    return $_SERVER['REQUEST_METHOD'];
  }
  # ---------------  ./METHOD()


  /** ---- CHECK if() somthing was POSTED ---- **/
  public function posted():bool {
    if ($_SERVER['REQUEST_METHOD'] == "POST" && count($_POST) > 0) {
        return true;
    }
    # ----  ./IF

    return false;
  }
  # ---------------  ./POSTED()


  /** ---- GET a VALUE from the POST variable ---- **/
  public function post(string $key = '', mixed $default = ''):mixed {
    if (empty($key)) {
        return $_POST;
    } else if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    # ----  ./IF/ELSE/IF

    return $default;
  }
  # ---------------  ./POST()


  /** ---- GET a VALUE from the FILES variable ---- **/
  public function files(string $key = '', mixed $default = ''):mixed {
    if (empty($key)) {
        return $_FILES;
    } else if (isset($_FILES[$key])) {
        return $_FILES[$key];
    }
    # ----  ./IF/ELSE/IF

    return $default;
  }
  # ---------------  ./FILES()


  /** ---- GET a VALUE from the GET variable ---- **/
  public function get(string $key = '', mixed $default = ''):mixed {
    if (empty($key)) {
      return $_GET;
    } else if (isset($_GET[$key])) {
      return $_GET[$key];
    }
    # ----  ./IF/ELSE/IF

    return $default;
  }
  # ---------------  ./GET()


  /** ---- GET a VALUE from the REQUEST INPUT variable ---- **/
  public function input(string $key, mixed $default = ''):mixed {
    if (isset($_REQUEST[$key])) {
      return $_REQUEST[$key];
    }
    # ----  ./IF

    return $default;
  }
  # ---------------  ./INPUT()


  /** ---- GET ALL VALUES from the REQUEST variable ---- **/
  public function all():mixed {
    return $_REQUEST;
  }
  # ---------------  ./ALL()
}
# -----------------  ./REQUEST