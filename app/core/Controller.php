<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

namespace Controller;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * MAIN Controller TRAIT
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Controller}
 */
Trait MainController {
  public function view($name, $data = []) {
    if (!empty($data))
        extract($data);
    # ----  ./IF

    $filename = "../app/views/".$name.".view.php";
    if (file_exists($filename)) {
      require $filename;
    } else {
      $filename = "../app/views/404.view.php";
      require $filename;
    }
    # --- ./IF/ELSE
  }
  # -----  ./View()
}
# ----------  ./Controller