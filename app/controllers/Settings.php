<?php

/**
 * User: TECH-Tag
 * Date: MM/DD/2024
 * Time: 00:00 AM
 */

namespace Controller;

defined('ROOTPATH') OR exit('Access DENIED!');

use \Core\Session;

/**
 * USER SETTINGS Class
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Controller}
 */
class Settings {
  # IMPORTING/EXTENDING CONTROLLER TRAIT  ------------
  use MainController;
  # ----------  ./IMPORTING/EXTENDING CONTROLLER TRAIT

  # INDEX()  ------------
  public function index() {
    /** ------ LOGIN CHECK ------ **/
    $ses = new Session;
    if (!$ses->is_logged_in()) {
      redirect('login');
    } # ----  ./IF
    # ----------------  ./LOGIN CHECK

    $this->view('settings');
  }
  # ----------  ./INDEX()
}
# --------------  ./Settings

