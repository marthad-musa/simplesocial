    <!-- ---------------| ./FOOTER\. |--------------- -->
    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">&copy; <?=date('Y')?> · <span class="fontLucindaH h6"><?=APP_NAME?></span></p>

        <a href="<?=ROOT?>" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
          <img style="width:50px;" src="<?=ROOT?>/assets/img/logo.png" alt="logo">
        </a>

        <ul class="nav col-sm-3 col-md-4 justify-content-end fontAlbert">
          <li class="nav-item"><a href="<?=ROOT?>" class="nav-link px-2 text-body-secondary">Home</a></li>
          <li class="nav-item"><a href="<?=ROOT?>" class="nav-link px-2 text-body-secondary">Features</a></li>
          <li class="nav-item"><a href="<?=ROOT?>" class="nav-link px-2 text-body-secondary">FAQs</a></li>
          <li class="nav-item"><a href="<?=ROOT?>" class="nav-link px-2 text-body-secondary">About</a></li>
          <li class="nav-item"><a href="<?=ROOT?>" class="nav-link px-2 text-body-secondary">Developers</a></li>
        </ul>
      </footer>
    </div>

    <?=$this->view('includes/scripts')?>
  </body>
</html>