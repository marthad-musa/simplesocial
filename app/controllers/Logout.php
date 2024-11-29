<?php

/**
 * User: TECH-Tag
 * Date: MM/DD/2024
 * Time: 00:00 AM
 */

namespace Controller;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * Logout Class
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Controller}
 */
class Logout {
  # EXTENDING CONTROLLER TRAIT  ------------
  use MainController;
  # ----------  ./EXTENDING CONTROLLER TRAIT

  # INDEX()  ------------
  public function index() {
    # Properties  --------
    $ses = new \Core\Session;
    # ------  ./Properties

    $ses->logout();

    redirect('login');
  }
  # ----------  ./INDEX()
}
# ----------  ./Logout

