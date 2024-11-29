<?=$this->view('includes/header')?>
<!-- ---------------- Main Content ---------------- -->
  <div class="container my-4">
    <main class="form-signin w-100 m-auto text-center">
      <form method="POST" enctype="multipart/form-data">
        <img class="mb-1" src="<?=ROOT?>/assets/img/logo.png" alt="Logo" width="50" height="50">
        <h1 class="h3 mb-1 fw-normal"><?=APP_NAME?></h1>
        <h3 class="h3 mb-2 fw-normal"><?=ucfirst(URL('page'))?> &nbsp; <i class="h3 bi bi-person-plus-fill"></i></h3>

        <!-- ---- Error Check ---- -->
        <?php if(!empty($data['user']->errors)):?>
          <div class="alert alert-danger text-center fontJordan">
            Please, check your inputs &amp; fix the error.</div>
        <?php endif?>
        <!-- -| ./Error Check\. |- -->

        <!-- ---- USERNAME ---- -->
        <div class="form-floating">
          <input type="text" name="username" value="<?=old_value('username')?>" class="form-control fontAlido" id="floatingInput" placeholder="Username" autofocus>
          <label class="fontDigital" for="floatingInput">User name</label>
          <!-- Errors -->
          <?php if(!empty($data['user']->errors['username'])):?>
            <div class="text-danger text-center my-1 fontJordan">
              <?=$data['user']->errors['username']?>
            </div>
          <?php endif?>
          <!-- ./Errors -->
        </div>
        <!-- -| ./USERNAME\. |- -->
        <!-- ---- IMAGE ---- -->
        <div class="form-floating">
        </div>
        <!-- -| ./IMAGE\. |- -->
        <!-- ---- EMAIL ---- -->
        <div class="form-floating">
          <input type="email" name="email" value="<?=old_value('email')?>" class="form-control fontAlido" id="floatingInput" placeholder="name@example.com">
          <label class="fontDigital" for="floatingInput">Email address</label>
          <!-- ---- Errors ---- -->
          <!-- -| ./Errors\. |- -->
          <?php if(!empty($data['user']->errors['email'])):?>
            <div class="text-danger text-center my-1 fontJordan">
              <?=$data['user']->errors['email']?>
            </div>
          <?php endif?>
        </div>
        <!-- -| ./EMAIL\. |- -->
        <!-- ---- PASSWORD ---- -->
        <div class="form-floating">
          <input type="password" name="password" value="<?=old_value('password')?>" class="form-control fontAlido" id="floatingPassword" placeholder="Password">
          <label class="fontDigital" for="floatingPassword">Password</label>
          <!-- ---- Errors ---- -->
          <?php if(!empty($data['user']->errors['password'])):?>
            <div class="text-danger text-center fontJordan">
              <?=$data['user']->errors['password']?>
            </div>
          <?php endif?>
          <!-- -| ./Errors\. |- -->
        </div>
        <!-- -| ./PASSWORD\. |- -->
        <!-- ---- TERMS ---- -->
        <div class="form-check text-start my-2 fontClarity">
          <input <?=old_checked('terms',1)?> class="form-check-input" type="checkbox" name="terms" value="1" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            I Accept the <a href="#">terms &amp; conditions</a>
          </label>  
          <!-- ---- Errors ---- -->
          <?php if(!empty($data['user']->errors['terms'])):?>
            <div class="text-danger text-center fontJordan">
              <?=$data['user']->errors['terms']?>
            </div>
          <?php endif?>
          <!-- -| ./Errors\. |- -->
        </div>  
        <!-- -| ./TERMS\. |- -->

        <!-- ---- SUBMIT ---- -->
        <button class="btn btn-primary w-100 py-2" type="submit">Create account</button>
        <!-- -| ./SUBMIT\. |- -->

        <div class="form-check text-start my-3">
          <p class="fontClarity">Already have an account&comma; <a href="<?=ROOT?>/login">Login</a> here!</p>
        </div>

      </form>
    </main>
  </div>
<!-- -------------| ./Main Content\. |------------- -->
<?=$this->view('includes/footer')?>