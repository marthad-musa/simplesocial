<?php 

/**
 * User: TECH-Tag
 * Date: 10/26/2024
 * Time: 12:40 PM
 */

namespace Core;

defined('ROOTPATH') OR exit('Access DENIED!');

/**
 * Pagination CLASS
 * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package ${Model}
 */
class Pager
{
  /** ---- PROPERTIES ---- **/
  public $links 			= array();
  public $offset 			= 0;
  public $page_number 		= 1;
  public $start 			= 1;
  public $end 				= 1;
  public $limit 			= 10;

  # ---- PAGINATION ----
  public $nav_class			= "";
  public $nav_styles		= "";
  public $ul_class			= "pagination justify-content-center";
  public $ul_styles			= "";
  public $li_class			= "page-item";
  public $li_styles			= "";
  public $a_class			= "page-link";
  public $a_styles			= "";

  # ---- FIRST PAGE ----
  public $first_a_class		= "page-link";
  public $first_a_styles	= "";
  public $first_li_class	= "page-item";
  public $first_li_styles	= "";

  # ---- NEXT PAGE ----
  public $next_a_class		= "page-link";
  public $next_a_styles		= "";
  public $next_li_class		= "page-item";
  public $next_li_styles	= "";
  
  # ---- ACTIVE PAGE ----
  public $active_class		= "active";
  public $active_styles		= "";
  # ---------------  ./PROPERTIES

  public function __construct($limit = 10, $extras = 1) {
    /** ---- PROPERTIES ---- **/
	$page_number 	   		= isset($_GET['page']) ? (int)$_GET['page']: 1;
	$page_number 	   		= $page_number < 1 ? 1:$page_number;
	# ---------------  ./PROPERTIES

	$this->end 		   		= $page_number + $extras;
	$this->start 	   		= $page_number - $extras;
	if($this->start < 1) {
	  $this->start 	   		= 1;
	}
	# ----  ./IF

 	$this->offset 	   		= ($page_number - 1) * $limit;
	$this->page_number 		= $page_number;
	$this->limit 	   		= $limit;

	$url = isset($_GET['url']) ? $_GET['url'] : '';

	$current_link = ROOT. "/". $url . '?' .trim(str_replace("url=", "", str_replace($url, "", $_SERVER['QUERY_STRING'])),'&');
	$current_link = !strstr($current_link, "page=") ? $current_link . "&page=1":$current_link;
 		
	if(!strstr($current_link, "?")) {
	  $current_link = str_replace("&page=", "?page=", $current_link);
	}
	# ----  ./IF

	$first_link = preg_replace('/page=[0-9]+/', "page=1", $current_link);
	$next_link = preg_replace('/page=[0-9]+/', "page=".($page_number + $extras + 1), $current_link);

	$this->links['first'] = $first_link;
	$this->links['current'] = $current_link;
	$this->links['next'] = $next_link;
  }
  # ---------------  ./__CONSTRUCT()

  public function display($record_count = null) {
	if($record_count == null)
	  $record_count = $this->limit;
	# ----  ./IF
		
	if($record_count == $this->limit || $this->page_number > 1){
	  ?>
	  <br class="clearfix">
	  <div>
	  	<nav class="<?=$this->nav_class?>" style="<?=$this->nav_styles?>">
	  	  <ul class="<?=$this->ul_class?>" style="<?=$this->ul_styles?>">
			<li class="<?=$this->first_li_class?>" style="<?=$this->first_li_styles?>"><a class="<?=$this->first_a_class?>" href="<?=$this->links['first']?>" style="<?=$this->first_a_styles?>">First</a></li>

			<?php for($x = $this->start; $x <= $this->end;$x++):?>
			  <li style="<?=$this->li_styles?>;<?=($x == $this->page_number)? $this->active_styles :'';?>" class="<?=$this->li_class?>
			  <?=($x == $this->page_number)? $this->active_class :'';?>
			  "><a style="<?=$this->a_styles?>" class="<?=$this->a_class?>" href="
				<?= preg_replace('/page=[0-9]+/', "page=".$x, $this->links['current'])?>
				"><?=$x?></a></li>
			<?php endfor;?>
			<!-- ./FOR -->

			<li class="<?=$this->next_li_class?>" style="<?=$this->next_li_styles?>"><a class="<?=$this->next_a_class?>" href="<?=$this->links['next']?>" style="<?=$this->next_a_styles?>">Next</a></li>
		  </ul>
		</nav>
	  </div>
	  <?php 
	}
	# ----  ./IF
  }
  # ---------------  ./Display()
}
# -----------------  ./PAGER