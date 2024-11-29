<?php

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * Check which PHP Extensions are required
 * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${NAMESPACE}
 */
check_extensions();

function check_extensions() {
  /** ---- PROPERTIES ---- **/
  $required_extensions = [
    'gd',
    'mysqli',
    'pdo_mysql',
    'pdo_sqlite',
    'curl',
    'fileinfo',
    'intl',
    'exif',
    'mbstring',
  ];
  $not_loaded = [];
  # ---------------  ./PROPERTIES

  foreach ($required_extensions as $ext) {
    if (!extension_loaded($ext)) {
      $not_loaded[] = $ext;
    }
    # ----  ./IF
  }
  # ----  ./FOREACH

  if (!empty($not_loaded)) {
    show("Please, load the following extensions in your php.ini file: <br>".implode("<br>", $not_loaded));
    die;
  }
  # ----  ./IF
}
# -------------  ./CHECK_EXTENSIONS()


/**
 * GENERAL GLOBAL FUNCTIONS
 * *
 */
# SHOW()  ---------------
function show($stuff) {
  echo "<pre>";
  print_r($stuff);
  echo "</pre>";
}
# -------------  ./SHOW()


# ESCAPE()  ---------------
function esc($str) {
  return htmlspecialchars($str);
}
# -------------  ./ESCAPE()


#   ---------------
/**
 * REMOVING UNWANTED COLUMNS FROM $DATA
 * *
 */
// function allowed_columns() {}
# -------------  ./


# ReDirect()  ---------------
function redirect($path) {
  header("Location: ".ROOT."/".$path);
  die;
}
# -------------  ./ReDirect()


#   ---------------
/**
 * USER Function
 * *
 * Retrieving ALL the current USER information
 */
function user(string $key = '') {
  $ses = new \Core\Session;
  $row = $ses->user();
  if (!empty($row->$key))
    return $row->$key;
  # ----  ./IF

  return '';
}
# -------------  ./User()


/**
 * Getting IMAGES
 * *
 * Load IMAGE,
 * IF() IMAGE do NOT exist: Load Placeholder
 * *
 */
function get_image(mixed $file = '',string $type = 'post'):string {
  $file = $file ?? '';
  if (file_exists($file)) {
    return ROOT . "/" . $file;
  }
  # ----  ./IF

  if ($type == 'user') {
    return ROOT . "/assets/img/user.jpg";
  } else {
    return ROOT . "/assets/img/no_image.jpg";
  }
  # ----  ./IF/ELSE
}
# ------  ./GET_IMAGE()


/**
 * Pagination
 * *
 * returning Pagination Links
 * *
 */
function get_pagination_vars():array {
  $vars              = [];
  $vars['page']      = $_GET['page'] ?? 1;
  $vars['page']      = (int)$vars['page'];
  $vars['prev_page'] = $vars['page'] <= 1 ? 1 : $vars['page'] - 1;
  $vars['next_page'] = $vars['page'] + 1;

  return $vars;
}
# -------------  ./Get_Pagination_vars()


/**
 * Messaging
 * *
 * Saving OR Displaying a saved MESSAGE to the USER
 * *
 */
function message(string $msg = null, bool $clear = false) {
  $ses = new Core\Session();

  if (!empty($msg)) {
    $ses->set('message',$msg);
  } else if(!empty($ses->get('message'))) {
    $msg = $ses->get('message');

    if ($clear) {
      $ses->pop('message');
    }
    # ----  ./IF

    return $msg;
  }
  # ----  ./IF/ELSE

  return false;
}
# -------------  ./Messeging()


/**
 * Check Which PHP Extensions are required
 * *
 * Returns URL Variables
 * *
 */
function URL($key):mixed {
  $URL = $_GET['url'] ?? 'home';
  $URL = explode("/", trim($URL, "/"));

  switch ($key) {
    case 'page':
    case 0:
      return $URL[0] ?? null;
      break;
    case 'section':
    case 'slug':
    case 1:
      return $URL[1] ?? null;
      break;
    case 'action':
    case 2:
      return $URL[2] ?? null;
      break;
    case 'id':
    case 3:
      return $URL[3] ?? null;
      break;
    default:
      return null;
      break;
  }
  # ----  ./SWITCH
}
# -------------  ./URL()


/**
 * Saving Checked CHECKED INPUTS
 * *
 * Whenever an INPUT is INVALID and the page refreshes:
 * the preveious inputs and Checked selections remain the same
 * *
 */
function old_checked(string $key, string $value, string $default = ""):string {
  if (isset($_POST[$key])) {
    if ($_POST[$key] == $value) {
      return ' checked ';
    }
    # ----  ./IF
  } else {
    if ($_SERVER['REQUEST_METHOD'] == "GET" && $default == $value) {
      return ' checked ';
    }
    # ----  ./IF
  }
  # ----  ./IF/ELSE

  return ''  ;
}
# -------------  ./Old_Checked()


/**
 * Saving Checked TEXT INPUTS
 * *
 * Whenever an INPUT is INVALID and the page refreshes:
 * the preveious text inputs remain the same
 * *
 */
function old_value(string $key, mixed $default = "", string $mode = 'post'):mixed {
  $POST = ($mode == 'post') ? $_POST : $_GET;
  if (isset($POST[$key])) {
    return $POST[$key];
  }
  # ----  ./IF

  return $default;
}
# -------------  ./Old_Value()


/**
 * Saving Checked SELECTION INPUTS
 * *
 * Whenever an INPUT is INVALID and the page refreshes:
 * the preveious inputs and selections remain the same
 * *
 */
function old_select(string $key, mixed $value, mixed $default = "", string $mode = 'post'):mixed {
  $POST = ($mode == 'post') ? $_POST : $_GET;
  if (isset($POST[$key])) {
    if (isset($POST[$key]) == $value) {
      return " selected ";
    }
    # ----  ./IF
  } else {
    if ($default == $value) {
      return " selected ";
    }
    # ----  ./IF
  }
  # ----  ./IF/ELSE

  return "";
}
# -------------  ./Old_Select()


/**
 * Getting DATE
 * *
 * Returns a USER Readable DATE() format
 */
function get_date($date) {
  return date("jS M, Y — H:i:s",strtotime($date));
}
# -------------  ./Get_Date()


/**
 * Adding ROOT DIRECTORY to IMAGES
 * *
 * Converts IMAGES Paths from Relative to Absolute
 * *
 */
function add_root_to_images($contents) {
  preg_match_all('/<img[^>]+>/', $contents, $matches);
  if (is_array($matches) && count($matches) > 0) {
    foreach ($matches[0] as $match) {
      preg_match('/src="[^"]+/', $match,$matches2);
      if (!strstr($matches2[0], 'http')) {
        $contents = str_replace($matches2[0], 'src="'.ROOT.'/'.str_replace('src="',"",$matches2), $contents);
      }
      # ----  ./IF
    }
    # ----  ./FOREACH
  }
  # ----  ./IF

  return $contents;
}
# -------------  ./Add_ROOT_to_Images()


/**
 * REMOVING IMAGES from Contents
 * *
 * Converts IMAGES from TEXT EDITOR Contents to actual FILES
 * *
 */
function remove_images_from_content($content, $folder = "uploads/") {
  # ----------------  Creating a FOLDER
  if (!file_exists($folder)) {
    mkdir($folder,0777,true);
    file_put_contents($folder."indedx.php","");
  }
  # ----  ./IF

  # ----------------  Remove IMAGES from Content
  preg_match_all('/<img[^>]+>/', $content, $matches);
  $new_content = $content;

  if (is_array($matches) && count($matches) > 0) {
    $image_class = new \Model\image();
    foreach ($matches[0] as $match) {
      if (strstr($match, "http")) {
        # ----------------  IGNORE Images with Links already
        continue;
      }
      # ----  ./IF

      # ----------------  GET the SOURCE
      preg_match('/src="[^"]+/', $match,$matches2);

      # ----------------  GET the FILENAME
      preg_match('/data-filename="[^"]+/', $match,$matches3);

      if (strstr($matches2[0], 'data: ')) {
        $parts = explode(",",$matches2[0]);
        $basename = $matches3[0] ?? 'basename.jpg';
        $basename = str_replace('data-filename="', "", $basename);

        $filename = $folder . "img_". sha1(rand(0,9999999999)) . $basename;

        $new_content = str_replace($parts[0] . "," . $parts[1], 'src="'.$filename, $new_content);
        file_put_contents($filename, base64_decode($parts[1]));

        # ----------------  Resize IMAGES
        $image_class->resize($filename,1000);
      }
      # ----  ./IF
    }
    # ----  ./FOREACH
  }
  # ----  ./IF

  return $new_content;
}
# -------------  ./Remove_Images_From_Content()


/**
 * DELETING IMAGES FROM CONTENT
 * *
 * Deleting IMAGES from TEXT EDITOR Contents
 * *
 */
function delete_images_from_content(string $content, string $content_new = ''):void {
  # ----------------  Delete Images from Content
  if (empty($content_new)) {
    preg_match_all('/<img[^>]+>/', $content, $matches);

    if (is_array($matches) && count($matches) > 0) {
      foreach ($matches[0] as $match) {
        preg_match('/src="[^"]+/', $match,$matches2);
        $matches2[0] = str_replace('src="',"",$matches2[0]);
        if (file_exists($matches2[0])) {
          unlink($matches2[0]);
        }
        # ----  ./IF
      }
      # ----  ./FOREACH
    }
    # ----  ./IF
  } else {
    # ----------------  Compare OLD to NEW AND Deletefrom OLD what isn't in the NEW
    preg_match_all('/<img[^>]+>/', $content, $matches);
    preg_match_all('/<img[^>]+>/', $content_new, $matches_new);

    $old_images = [];
    $new_images = [];

    # ----------------  Collect OLD Images
    if (is_array($matches) && count($matches) > 0) {
      foreach ($matches[0] as $match) {
        preg_match('/src="[^"]+/', $match, $matches2);
        $matches2[0] = str_replace('src="',"",$matches2[0]);

        if (file_exists($matches2[0])) {
          $old_images = $matches2[0];
        }
        # ----  ./IF
      }
      # ----  ./FOREACH
    }
    # ----  ./IF

    # ----------------  Collect NEW Images
    if (is_array($matches_new) && count($matches_new) > 0) {
      foreach ($matches_new[0] as $match) {
        preg_match('/src="[^"]+/', $match, $matches2);
        $matches2[0] = str_replace('src="',"",$matches2[0]);

        if (file_exists($matches2[0])) {
          $new_images = $matches2[0];
        }
        # ----  ./IF
      }
      # ----  ./FOREACH
    }
    # ----  ./IF

    # ----------------  Compare AND Delete all that don't appear in the NEW ARRAY()
    foreach ($old_images as $img) {
      if (!in_array($img, $new_images)) {
        if (file_exists($img)) {
          unlink($img);
        }
        # ----  ./IF
      }
      # ----  ./IF
    }
    # ----  ./FOREACH
  }
  #  ----  ./IF/ELSE
}
# -------------  ./Delete_Images_From_Content()


#   ---------------
# -------------  ./

