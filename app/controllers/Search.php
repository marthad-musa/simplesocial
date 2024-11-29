<?php

/**
 * User: TECH-Tag
 * Date: MM/DD/2024
 * Time: 00:00 AM
 */

namespace Controller;

defined('ROOTPATH') OR exit('Access DENIED!');

use \Model\User;
use \Core\Session;
use \Core\Pager;

/**
 * SEARCH Class
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Controller}
 */
class Search {
  # IMPORTING/EXTENDING CONTROLLER TRAIT  ------------
  use MainController;
  # ----------  ./IMPORTING/EXTENDING CONTROLLER TRAIT

  # INDEX()  ------------
  public function index() {
    /** ------ LOGIN CHECK ------ **/
    $ses            = new Session;
    if (!$ses->is_logged_in()) {
      redirect('login');
    } # ----  ./IF
    # ----------------  ./LOGIN CHECK

    # Properties  --------
    $user           = new User;
    $data           = [];
    $arr            = [];
    /* Pagination Vars */
    $limit = 10;
    $data['pager'] = new Pager($limit);
    $offset = $data['pager']->offset;
    # ------  ./Properties

    $arr['find']    = $_GET['find'] ?? NULL;

    if ($arr['find']) {
      # ---- Wild Cards ----
      $arr['find']  = "%".$arr['find']."%";
      # ------  ./Wild Cards

      $data['rows'] = $user->query("SELECT * FROM `users` WHERE `id` LIKE :find || `username` LIKE :find || `email` LIKE :find LIMIT $limit OFFSET $offset;", $arr);
    } else {
      $arr['find'] = "No resault found. Please, try searching something else!";
      return $arr['find'];
    }
    # ----  ./IF

    # ---- SysLog ----
    # ------  ./SysLog

    $this->view('search', $data);
  }
  # ----------  ./INDEX()
}
# --------------  ./Search

