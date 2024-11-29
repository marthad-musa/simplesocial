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
use \Model\Post;
use \Core\Request;
use \Model\Image;

/**
 * Ajax Class
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
class Ajax {
  # IMPORTING/EXTENDING CONTROLLER TRAIT  ------------
  use MainController;
  # ----------  ./IMPORTING/EXTENDING CONTROLLER TRAIT

  # INDEX()  ------------
  public function index() {
    /** ------ LOGIN CHECK ------ **/
    $ses             = new Session;
    if (!$ses->is_logged_in()) {
      die;
    } # ----  ./IF
    # ----------------  ./LOGIN CHECK

    # Properties  --------
    $req             = new Request;
    $user            = new User;
    $info['success'] = false;
    $info['message'] = "";
    # ------  ./Properties
    
    if ($req->posted()) {
      $data_type = $req->input('data_type');
      $info['data_type'] = $data_type;

      if ($data_type == "profile-image") {
        /** ------ Profile Image ------ **/
        $image_row = $req->files('image');
        
        /* -- Create Uploads Folder -- */
        if ($image_row['error'] == 0) {
          $folder = "uploads/";
          if (!file_exists($folder)) {
            mkdir($folder, 0777,true);
          }
          # ----  ./IF
          
          $destination = $folder . time() . $image_row['name'];
          move_uploaded_file($image_row['tmp_name'], $destination);
          
          $image_class = new Image;
          $image_class->resize($destination,1000);
          
          # Grap User ROW  --------
          $id = user('id');
          $row = $user->first(['id'=>$id]);
          # ------  ./Grap User ROW
          
          # Deleting Old Images  --------
          if (file_exists($row->image))
          unlink($row->image);
          # ----  ./IF
          # ------  ./Deleting Old Images
          
          $user->update($id, ['image'=>$destination]);
          $info['message'] = "Profile image changed successfully!";
          $info['success'] = true;
        } # ----  ./IF
        # ----------------  ./Uploads Folder
      } else if ($data_type == "create-post") {
        /** ------ CREATE Post ------ **/
        $id               = user('id');
        $post             = new Post;

        if ($post->validate($req->post(), $req->files())) {
          $image_row = $req->files('image');

          /** ------ Create Uploads Folder ------ **/
          if (!empty($image_row['name']) && $image_row['error'] == 0) {
            $folder = "uploads/";
            if (!file_exists($folder)) {
              mkdir($folder, 0777,true);
            } # ----  ./IF

            $destination = $folder . time() . $image_row['name'];
            move_uploaded_file($image_row['tmp_name'], $destination);

            $image_class = new Image;
            $image_class->resize($destination,1000);
          }
          # ----  ./IF
          
          $arr              = [];
          $arr['post']      = $req->input('post');
          $arr['image']     = $destination ?? '';
          $arr['user_id']   = $id;
          $arr['date']      = date("Y/m/d H:i:s");
          
          $post->insert($arr);
          $info['message']  = "Post created successfully!";
          $info['success']  = true;
        } else {
          $info['message']  = "Plese, post something!";
          $info['success']  = false;
        }
        # ----  ./IF/ELSE
      // } else if ($data_type == "edit-post") {
      //   /** ------ EDIT Post ------ **/
      //   $user_id          = user('id');
      //   $post_id          = $req->input('post_id');
        
      //   $image_row = $req->files('image');
        
      //   /* -- Create Uploads Folder -- */
      //   if (!empty($image_row['name']) && $image_row['error'] == 0) {
      //     $folder = "uploads/";
      //     if (!file_exists($folder)) {
      //       mkdir($folder, 0777,true);
      //     } # ----  ./IF
          
      //     $destination = $folder . time() . $image_row['name'];
      //     move_uploaded_file($image_row['tmp_name'], $destination);
          
      //     $image_class = new Image;
      //     $image_class->resize($destination,1000);
      //   }
      //   # ----  ./IF
        
      //   $post             = new Post;
        
      //   $arr              = [];
      //   $arr['post']      = $req->input('post');
      //   if (!empty($destination))
      //     $arr['image']     = $destination;
      //   # ----  ./IF

      //   $arr['user_id']   = $user_id;
        
      //   $post->update($post_id, $arr);

      //   $info['message']  = "Post edited successfully!";
      //   $info['success']  = true;
        
      } else if ($data_type == "delete-post") {
        /** ------ DELETE Post ------ **/
        $user_id          = user('id');
        $post_id          = $req->input('post_id');
        
        $post             = new Post;
        $row              = $post->first(['id'=>$post_id]);

        if ($row) {
          if ($row->user_id == $user_id) {
            $post->delete($post_id);

            $info['message']  = "Post deleted successfully!";
            $info['success']  = true;
          }
          # ----  ./IF
        }
        # ----  ./IF
      }
      # ----  ./IF/ELSE

      echo json_encode($info);
    }
    # ----  ./IF
  }
  # ----------  ./INDEX()
}
# --------------  ./Ajax

