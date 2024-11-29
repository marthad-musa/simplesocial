<?=$this->view('includes/header')?>
<!-- ---------------- Main Content ---------------- -->
<main class="">
  <div class="row p-2 mx-auto justify-content-center text-center fontCasper">
    <h6 class="h1 my-2 fontClarity"><?=ucfirst(URL('page'))?> page</h6>
    <!-- ---- Search Resault ---- -->
    <?php if (!empty($rows)):?>
      <?php foreach ($rows as $row):?>
        <?=$this->view('includes/user-small',['row'=>$row])?>
      <?php endforeach;?>
    <?php endif;?>
    <?php $pager->display();?>
    <!-- -| ./Search Resault\. |- -->
  </div>
</main>
<!-- -------------| ./Main Content\. |------------- -->
<?=$this->view('includes/footer')?>