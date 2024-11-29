<div class="row post p-1 mx-2">
  <!-- ---- USER Info ---- -->
  <div class="col-3 bg-light text-center rounded">
    <a href="<?=ROOT?>/profile/<?=$post->user->id?>">
      <img class="profile-image rounded-circle m-2" src="<?=get_image($post->user->image ?? '')?>" alt="<?=ucfirst(user('username'))?>" width="80" height="80" style="object-fit: cover;">
      <p class="h5 post-title fontBank"><?=ucfirst(esc($post->user->username ?? 'Not Allocated'))?></p>
    </a>
  </div>
  <!-- -| ./USER Info\. |- -->
  <!-- ---- USER POST ---- -->
  <div class="col-9 text-start border rounded py-2">
    <div class="h6 text-end muted fontAgency"><?=get_date($post->date)?></div>
    <p class="post-body fontHenzo h6"><?=ucfirst($post->post)?></p>
    <div class="text-center">
      <?php if (!empty($post->image)):?>
        <a href="<?=ROOT?>/post/<?=$post->id?>">
          <img class="rounded my-2" src="<?=get_image($post->image)?>" alt="" width="100%" height="200px" style="object-fit: cover;">
        </a>
      <?php endif?>
    </div>
    <!-- ---- Social Buttons ---- -->
    <div class="py-2">
      <?php if (URL('page') != 'home' && user('id') == $post->user_id): ?>
        <a href="<?=ROOT?>/post/edit/<?=$post->id?>">
          <button class="btn btn-sm btn-success rounded float-end m-1">
            <i class="fa fa-edit"></i>
          </button>
        </a>
        <a href="<?=ROOT?>/post/delete/<?=$post->id?>">
            <button class="btn btn-sm btn-danger rounded float-end m-1">
            <!--  data-bs-toggle="modal" data-bs-target="#deleteModal" -->
            <i class="fa fa-trash"></i>
          </button>
        </a>
      <?php endif?>
      <!-- -| ./Social Buttons\. |- -->
      <!-- ---- Comments ---- -->
      <a href="<?=ROOT?>/post/<?=$post->id?>">
        <button class="btn btn-sm btn-primary rounded float-start m-1">
          <i class="fa fa-message"></i> Comment
        </button>
      </a>
      <!-- -| ./Comments\. |- -->
    </div>
  </div>
  <!-- -| ./USER POST\. |- -->
</div>
<!-- -| ./ROW\. |- -->
<hr>
