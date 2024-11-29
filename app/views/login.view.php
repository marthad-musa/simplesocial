<?=$this->view('includes/header')?>
<!-- ---------------- Main Content ---------------- -->
<div class="container my-4">
  <main class="form-signin w-100 m-auto text-center">
    <form method="POST">
      <img class="mb-4" src="<?=ROOT?>/assets/img/logo.png" alt="Logo" width="72" height="72">
      <h1 class="h3 mb-3 fw-normal"><?=APP_NAME?></h1>
      <h3 class="h3 mb-3 fw-normal"><?=ucfirst(URL('page'))?> &nbsp; <i class="h3 bi bi-person-check-fill"></i></h3>

      <!-- ---- Error Check ---- -->
      <?php if(!empty($data['user']->errors)):?>
      <?php #if(!empty($errors)):?>
        <div class="alert alert-danger text-center fontJordan">
          <?=implode("<br>", $data['user']->errors)?>
        </div>
      <?php endif?>
      <!-- --| ./Error Check |-- -->

      <!-- ---- EMAIL ---- -->
      <div class="form-floating fontCasper">
        <input type="email" name="email" value="<?=old_value('email')?>" class="form-control fontAlido" id="floatingInput" placeholder="name@example.com" autofocus autocomplete="off">
        <label class="fontDigital" for="floatingInput">Email address</label>
      </div>  
      <!-- -| ./EMAIL\. |- -->
      <!-- ---- PASSWORD ---- -->
      <div class="form-floating fontCasper">
        <input type="password" name="password" value="<?=old_value('password')?>" class="form-control fontAlido" id="floatingPassword" placeholder="Password">
        <label class="fontDigital" for="floatingPassword">Password</label>
      </div>  
      <!-- -| ./PASSWORD\. |- -->
      <!-- ---- REMEMBER ME ---- -->
      <div class="form-check text-start my-3 fontClarity">
        <input class="form-check-input" type="checkbox" name="remember-me" value="1" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Remember me
        </label>
      </div>
      <!-- -| ./REMEMBER ME\. |- -->

      <!-- ---- SUBMIT ---- -->
      <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
      <!-- -| ./SUBMIT\. |- -->

      <div class="form-check text-start my-3">
        <p class="fontClarity">Don't have an account, <a href="<?=ROOT?>/signup">Signup</a> here!</p>
      </div>

    </form>
  </main>
</div>
<!-- -------------| ./Main Content\. |------------- -->
<?=$this->view('includes/footer')?>