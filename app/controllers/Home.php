<?php

/**
 * User: TECH-Tag
 * Date: MM/DD/2024
 * Time: 00:00 AM
 */

namespace Controller;

defined('ROOTPATH') OR exit('Access DENIED!');

use \Model\User;
use \Model\Post;
use \Core\Session;
use \Core\Pager;

/**
 * HOME Class
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
class Home {
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
    $id            = user('id');
    /* Pagination Vars */
    $limit = 10;
    $data['pager'] = new Pager($limit);
    $offset = $data['pager']->offset;
    # ------  ./Properties

    # GET USER ROW  ------------------
    $user           = new User;
    $data['row']    = $row = $user->first(['id'=>$id]);
    # ----------------  ./GET USER ROW
    
    if ($data['row']) {
      $post         = new Post;
      $post->limit  = $limit;
      $post->offset = $offset;

      // $post->create_post_table();
      $data['posts'] = $post->findAll();
      if ($data['posts']) {
        $data['posts'] = $post->add_user_data($data['posts']);
      }

      # ----  ./IF
    }
    # ----  ./IF

    /** ------ Check CURRENT USER ------ **/
    # ----------------  ./Check CURRENT USER

    $this->view('home', $data);
  }
  # ----------  ./INDEX()

  /** ------  ------ **/
  # ----------------  ./

}
# --------------  ./Home

