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
 * 404 Class
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Controller}
 */
class _404 {
  # EXTENDING CONTROLLER TRAIT  ------------
  use MainController;
  # ----------  ./EXTENDING CONTROLLER TRAIT

  public function index() {
    /** ------ LOGIN CHECK ------ **/
    $ses = new Session;
    if (!$ses->is_logged_in()) {
      redirect('login');
    } # ----  ./IF
    # ----------------  ./LOGIN CHECK

    $this->view('404');
  }
  # ----------  ./index()
}
# --------------  ./_404

