<?php

/**
 * User: TECH-Tag
 * Date: MM/DD/2024
 * Time: 00:00 AM
 */

namespace Controller;

defined('ROOTPATH') OR exit('Access DENIED!');

use \Model\User;
use \Model\Post as myPost;
use \Core\Session;
use \Core\Pager;

/**
 * POST Class
 ***
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Controller}
 */
class Post {
  # IMPORTING/EXTENDING CONTROLLER TRAIT  ------------
  use MainController;
  # ----------  ./IMPORTING/EXTENDING CONTROLLER TRAIT

  # INDEX()  ------------
  public function index($id = NULL) {
    /** ------ LOGIN CHECK ------ **/
    $ses            = new Session;
    if (!$ses->is_logged_in()) {
      redirect('login');
    } # ----  ./IF
    # ----------------  ./LOGIN CHECK

    /* Pagination Vars */
    $limit          = 10;
    $data['pager']  = new Pager($limit);
    $offset = $data['pager']->offset;
    
    # Properties  --------
    $post           = new myPost;
    # ------  ./Properties

    $post->create_post_table();
    $data['post']   = $post->where(['id'=>$id]);
    if ($data['post']) {
      $data['post'] = $post->add_user_data($data['post']);
      $data['post'] = $data['post'][0];
    }
    # ----  ./IF

    $this->view('post', $data);
  }
  # ----------  ./INDEX()

  # EDIT()  ------------
  public function edit($id = NULL) {
    $post         = new myPost;

    $data['post'] = $post->where(['id'=>$id]);
    if ($data['post']) {
      $data['post'] = $post->add_user_data($data['post']);
      $data['post'] = $data['post'][0];
    }
    # ----  ./IF

    $this->view('includes/post-edit', $data);
  }
  # ----------  ./EDIT()

  # DELETE()  ------------
  public function delete($id = NULL) {
    $post         = new myPost;

    $data['post'] = $post->where(['id'=>$id]);
    if ($data['post']) {
      $data['post'] = $post->add_user_data($data['post']);
      $data['post'] = $data['post'][0];
    }
    # ----  ./IF

    $this->view('includes/post-delete', $data);
  }
  # ----------  ./DELETE()
}
# --------------  ./Post

