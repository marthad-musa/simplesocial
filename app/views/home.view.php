<?=$this->view('includes/header')?>
<!-- ---------------- Main Content ---------------- -->
<main class="">
  <div class="row p-2 col-md-9 shadow mx-auto border rounded fontAlbert">
    <!-- ---- Profile & Posts Images ---- -->
    <div class="col-md-3 text-center mb-4">
      <a href="<?=ROOT?>/profile/<?=$row->id?>">
        <span>
          <img class="profile-image rounded-circle mt-4 mb-2" src="<?=get_image($row->image)?>" alt="<?=ucfirst(user('username'))?>" width="130" height="130" style="object-fit: cover;">
        </span>
        <h5 class="h5"><?=ucfirst(esc($row->username))?></h5>
      </a>
    </div>
    <!-- -| ./Profile & Posts Images\. |- -->

    <!-- ---- POST Stack ---- -->
    <div class="col-md-9 my-3">
      <?php if (!empty($posts)):?>
        <?php foreach ($posts as $post):?>
          <?=$this->view('includes/post-small',['post'=>$post])?>
        <?php endforeach;?>
      <?php endif;?>
      <?php $pager->display();?>
    </div>
    <!-- -| ./POST Stack\. |- -->
  </div>
</main>
<!-- -------------| ./Main Content\. |------------- -->
<?=$this->view('includes/footer')?>