<?=$this->view('includes/header')?>
  <!-- ---------------- Main Content ---------------- -->
  <main class="">
    <!-- ---- ROW-COLUMN ---- -->
    <div class="col-md-8 mx-auto border rounded shadow">
      <div class="row post p-1 mx-2">
        <!-- ---- USER Info ---- -->
        <div class="col-3 bg-light text-center rounded">
          <a href="<?=ROOT?>/profile/<?=$post->user->id?>" style="text-decoration: none;">
            <img class="profile-image rounded-circle m-2" src="<?=get_image($post->user->image ?? '')?>" alt="<?=ucfirst(user('username'))?>" width="80" height="80" style="object-fit: cover;">
            <p class="h5 post-title fontOlcen"><?=ucfirst(esc($post->user->username ?? 'Not Allocated'))?></p>
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
                <img class="rounded my-2" src="<?=get_image($post->image)?>" alt="" width="100%">
              </a>
            <?php endif?>
          </div>
          <!-- ---- Social Buttons ---- -->
          <div class="py-2 fontDurion">
            <?php if (URL('page') != 'home' && user('id') == $post->user_id): ?>
              <a href="<?=ROOT?>/post/<?=$post->id?>">
                <button type="button" class="btn btn-sm btn-secondary rounded float-start m-1">
                  <i class="fa fa-arrow-left"></i> Back
                </button>
              </a>
              <button type="submit" class="btn btn-sm btn-success rounded float-end m-1">
              <!-- data-bs-toggle="modal" data-bs-target="#deleteModal" -->
                <i class="fa fa-edit"></i> Edit
              </button>
            <?php endif?>
          </div>
          <!-- -| ./Social Buttons\. |- -->
        </div>
        <!-- -| ./USER POST\. |- -->
      </div>
    </div>
    <!-- -| ./ROW-COLUMN\. |- -->
  </main>
  <!-- -------------| ./Main Content\. |------------- -->
<?=$this->view('includes/footer')?>
