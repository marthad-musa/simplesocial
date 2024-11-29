<?php

/**
 * User: TECH-Tag
 * Date: MM/DD/2024
 * Time: 00:00 AM
 */

namespace Controller;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * Signup Class
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Controller}
 */
class Signup {
  # EXTENDING CONTROLLER TRAIT  ------------
  use MainController;
  # ----------  ./EXTENDING CONTROLLER TRAIT

  # INDEX()  ------------
  public function index() {
    # Properties  --------
    $data['user']         = new \Model\User;
    $data['user']->errors = [];
    $req                  = new \Core\Request;
    # ------  ./Properties
    
    /** ------ SignUp|Register ------ **/
    if ($req->posted()) {
      $data['user']->signup($req->post());
    } # ----  ./IF
    # ----------------  ./SignUp|Register

    $this->view('signup', $data);
  }
  # ----------  ./INDEX()
}
# ----------  ./Signup


#   ------------
# ----------  ./
