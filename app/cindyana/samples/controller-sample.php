<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * {CLASSNAME} Class
 * *
 */
class {CLASSNAME} {
  # IMPORTING/EXTENDING CONTROLLER TRAIT  ------------
  use MainController;
  # ----------  ./IMPORTING/EXTENDING CONTROLLER TRAIT

  # INDEX()  ------------
  public function index() {
    $this->view('{classname}');
  }
  # ----------  ./INDEX()
}
# --------------  ./Home

