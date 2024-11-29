  <!-- ---- USER Info ---- -->
  <div class="col-md-2 py-2  mb-5 mx-auto bg-light text-center border rounded shadow post">
    <a href="<?=ROOT?>/profile/<?=$row->id?>">
      <img class="profile-image rounded-circle m-1" src="<?=get_image($row->image ?? '')?>" alt="<?=ucfirst(user('username'))?>" width="80" height="80" style="object-fit: cover;">
      <p class="h5 post-title"><?=ucfirst(esc($row->username ?? 'Not Allocated'))?></p>
    </a>
  </div>
  <!-- -| ./USER Info\. |- -->
