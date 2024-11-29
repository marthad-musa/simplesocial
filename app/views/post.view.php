<?=$this->view('includes/header')?>
<!-- ---------------- Main Content ---------------- -->
<main class="">
  <div class="row p-2 col-md-9 shadow mx-auto border rounded fontAlbert">
    <h4><?=ucfirst(URL('page')).' Number: '.URL('slug')?></h4>
    <!-- ---- POST Stack ---- -->
    <div class="my-3">
      <?php if (!empty($post)):?>
        <?=$this->view('includes/post-full',['post'=>$post])?>
      <?php endif;?>
      <?php $pager->display();?>
    </div>
    <!-- -| ./POST Stack\. |- -->
  </div>
</main>
<!-- -------------| ./Main Content\. |------------- -->
<?=$this->view('includes/footer')?>