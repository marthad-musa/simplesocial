<?php

/**
 * User: TECH-Tag
 * Date: MM/DD/2024
 * Time: 00:00 AM
 */

namespace Controller;

defined('ROOTPATH') OR exit('Access DENIED!');

use \Core\Session;
use \Model\User;
use \Core\Request;

/**
 * Emp Class
 * *
 * This CLASS is for the main URL sub-Directory
 * Differentiating between:
 * - MAIN Pages
 * - Methods
 * AND the rest of the URL
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Controller}
 */
class Emp {
  use MainController;

  # INDEX()  ------------
  public function index() {
    /** ------ LOGIN CHECK ------ **/
    $ses = new Session;
    if (!$ses->is_logged_in()) {
      redirect('login');
    } # ----  ./IF
    # ----------------  ./LOGIN CHECK

    $this->view('emp');
  }
  # ----------  ./INDEX()
}
# --------------  ./Emp

