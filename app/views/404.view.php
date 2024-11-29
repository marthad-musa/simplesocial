<?=$this->view('includes/header')?>
<!-- ---------------- Main Content ---------------- -->
<main class="row">
  <div class="col-md-6 mx-auto">
    <div class="m-1 alert alert-warning text-center">
      <h3 class="text-danger fontClarity h3"><?=ucfirst(URL('page'))?> Page Not Found</h3>
    </div>
    <div class="text-center">
      <img src="<?=ROOT?>/assets/img/404.svg" alt="not found" style="width: 45%">
    </div>
  </div>
</main>
<!-- -------------| ./Main Content\. |------------- -->
<?=$this->view('includes/footer')?>