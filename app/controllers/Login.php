<?php

/**
 * User: TECH-Tag
 * Date: MM/DD/2024
 * Time: 00:00 AM
 */

namespace Controller;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * Login Class
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Controller}
 */
class Login {
  # EXTENDING CONTROLLER TRAIT  ------------
  use MainController;
  # ----------  ./EXTENDING CONTROLLER TRAIT

  # INDEX()  ------------
  public function index() {
    # Properties  --------
    $data['user'] = new \Model\User;
    $req          = new \Core\Request;
    # ------  ./Properties

    if ($req->posted()) {
      $data['user']->login($_POST);
    }
    # ----  ./IF

    $this->view('login', $data);
  }
  # ----------  ./INDEX()
}
# ----------  ./Login


#   ------------
# ----------  ./
