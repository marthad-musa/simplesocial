<?=$this->view('includes/header')?>
  <!-- ---------------- Main Content ---------------- -->
  <main class="">
    <!-- ---- ROW-COLUMN ---- -->
    <div class="col-md-8 mx-auto border rounded shadow">
      <!-- ---- Alert ---- -->
      <div class="m-3 alert alert-danger text-center fontClarity">
        Sure you want to <span class="">delete</span> this post?
      </div>
      <!-- -| ./Alert\. |- -->
      <!-- ---- POST Form ---- -->
      <form method="POST" onsubmit="submit_post(event)">
        <!-- ---- POST ---- -->
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
                <button class="btn btn-sm btn-danger rounded float-end m-1">
                <!-- data-bs-toggle="modal" data-bs-target="#deleteModal" -->
                  <i class="fa fa-trash"></i> Delete
                </button>
              <?php endif?>
              <input type="hidden" id="post_id" value="<?=$post->id?>">
            </div>
            <!-- -| ./Social Buttons\. |- -->
          </div>
          <!-- -| ./USER POST\. |- -->
        </div>
        <!-- -| ./POST\. |- -->
      </form>
      <!-- -| ./POST Form\. |- -->
      <!-- ---- Post Progress Bar ---- -->
      <div class="post-prog progress mb-3 d-none" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar bg-success" style="width: 25%">25%</div>
      </div>
      <!-- -| ./Post Progress Bar\. |- -->
    </div>
    <!-- -| ./ROW-COLUMN\. |- -->
  </main>
  <!-- ---- POST Form by using AJAX ---- -->
  <script>
    function submit_post(e) {
      e.preventDefault();

      var obj         = {};
      obj.post_id     = e.currentTarget.querySelector("#post_id").value;
      obj.data_type   = "delete-post";
      obj.id          = "<?=user('id')?>";  
      obj.progressbar = 'post-prog';

      send_data(obj);
    }
    // ----  ./Submit_Post()

    function send_data(obj) {
      /* -- Mimicking a FORM -- */
      var myform      = new FormData();
      var progressbar = null;
      
      if(typeof obj.progressbar != 'undefined')
        progressbar = document.querySelector("."+obj.progressbar);

      /* -- Adding Data to the Form -- */
      for (key in obj) {
        /* -- x.append('Key','Value') -- */
        myform.append(key,obj[key]);
      }
      // ----  ./FOR
      
      var ajax = new XMLHttpRequest();

      /*-- x.addEventListener( Event, Corresponding Function(Event){} ) --*/
      ajax.addEventListener('readystatechange', function(e) {
        if (ajax.readyState == 4 && ajax.status == 200) {
          handle_result(ajax.responseText);
        }
        // ----  ./IF
      });
      // ----  ./EventListener()

      if(progressbar) {
        progressbar.classList.remove("d-none");
        progressbar.children[0].style.width = "0%";
        progressbar.children[0].innerHTML = "0%";
        
        ajax.upload.addEventListener('progress', function(e) {
          let percent = Math.round((e.loaded / e.total) * 100);
          progressbar.children[0].style.width = percent + "%";
          progressbar.children[0].innerHTML = percent + "%";
        });
        // ----  ./EventListener()
      }
      // ----  ./IF

      /* -- To Use AJAX, define the Protocol, the Path to the script file (optional) & True/False -- */
      /* -- ajax.open( 'POST Protocol', 'mywebsite.com/ajax', True/False ) -- */
      ajax.open('post','<?=ROOT?>/ajax',true);
      ajax.send(myform);
    }
    // ----  ./Send_Data()

    function handle_result(result) {
      let obj = JSON.parse(result);

      // alert(obj.status);
      /* --- IF(Success): Redirect(Profile PAGE) --- */
      if (obj.success) {
        alert(obj.message);
        window.location.href = '<?=ROOT?>/profile';
      }
      // ----  ./IF/ELSE
    }
    // ----  ./Handle_Result()
  </script>
  <!-- -| ./POST Form by using AJAX\. |- -->
  <!-- -------------| ./Main Content\. |------------- -->
<?=$this->view('includes/footer')?>