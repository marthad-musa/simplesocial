<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * Class APP
 ***
 * 
 * This Class contains the following fuctions:
 * *
 * splitURL():
 * To capture the url and split it into levels
 * *
 * loadController():
 * Works as a Router between MODELS, VIEWS & CONTROLLERS
 * *
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${NAMESPACE}
 */

class App {
  # Properties --------
  private $controller = 'Home';
  private $method     = 'index';
  # -----  ./Properties
  
  
  # splitURL() --------
  private function splitURL() {
    $URL = $_GET['url'] ?? 'home';
    $URL = explode("/", trim($URL, "/"));
    return $URL;
  } # -----  ./SplitURL()


  /**
   * |=========================================|
   * ------- This is the ROUTER Feature -------
   * |=========================================|
   */
  public function loadController() {
    $URL = $this->splitURL();

    /** 
     * SELECT CONTROLLER
     * *
     */
    $filename = "../app/controllers/".ucfirst($URL[0]).".php";
    if (file_exists($filename)) {
      require $filename;
      $this->controller = ucfirst($URL[0]);
      unset($URL[0]);
    } else {
      $filename = "../app/controllers/_404.php";
      require $filename;
      $this->controller = "_404";
    }
    # ------ ./IF/ELSE
  
    /** ---- INSTANTIATING CONTROLLER ---- **/
    $controller = new ('\Controller\\'.$this->controller);

    /** 
     * SELECT METHOD
     * *
     */
    if (!empty($URL[1])) {
      if (method_exists($controller, $URL[1])) {
        $this->method = $URL[1];
        unset($URL[1]);
      }
      # ------  ./IF
    }
    # ------  ./IF

    call_user_func_array([$controller,$this->method], $URL);  
  } # -----  ./loadController() 
  # ==============| ./ROUTER |==============
}
# ----------  ./App

