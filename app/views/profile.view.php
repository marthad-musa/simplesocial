<?=$this->view('includes/header')?>

<!-- ---- MODAL ---- -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fontClarity" id="deleteModalLabel">Delete Comment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body fontVanilla text-center">Are you sure you want to <span class="">remove</span> this comment?</div>
      <div class="modal-footer fontClarity">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="#" id="">Delete</a>
      </div>
    </div>
  </div>
</div>
<!-- -| ./MODAL\. |- -->

<!-- ---------------- Main Content ---------------- -->
<main class="">
  <div class="p-2 col-sm-6 col-md-6 shadow mx-auto border rounded fontAlbert">
    <!-- ---- Profile & Posts Images ---- -->
    <div class="text-center mb-4">
      <span>
        <img class="profile-image rounded-circle m-4" src="<?=get_image($row->image)?>" alt="<?=ucfirst(user('username'))?>" width="200" height="200" style="object-fit: cover;">
        <?php if (user('id') == $row->id): ?>
          <label>
            <i class="h1 text-primary bi bi-image" style="position: absolute; cursor: pointer;"></i>
            <input type="file" class="d-none" onchange="display_image(this.files[0])">
          </label>
        <?php endif; ?>
      </span>
      <!-- ---- Image Progress Bar ---- -->
      <div class="profile-image-prog progress mb-3 d-none" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar bg-success" style="width: 25%">25%</div>
      </div>
      <!-- -| ./Image Progress Bar\. |- -->
      <h3 class="h3"><?=ucfirst(esc($row->username))?></h3>
      <script>
        function display_image(file) {
          let allowed = ['jpg','jpeg','png','webp','heic'];
          let ext     = file.name.split(".").pop();
          
          if (!allowed.includes(ext.toLowerCase())) {
            alert('Only these file types are allowed: ' + allowed.toString(", "));
            return;
          }
          // ----  ./IF

          document.querySelector(".profile-image").src = URL.createObjectURL(file);
          change_image(file);
        }

        function display_post_image(file) {
          let allowed = ['jpg','jpeg','png','webp','heic'];
          let ext     = file.name.split(".").pop();

          if (!allowed.includes(ext.toLowerCase())) {
            alert('Only these file types are allowed: ' + allowed.toString(", "));
            post_image_added = false;
            return;
          }
          // ----  ./IF

          document.querySelector(".post-image").src = URL.createObjectURL(file);
          document.querySelector(".post-image").parentNode.classList.remove("d-none");

          post_image_added = true;
        }
      </script>
    </div>
    <!-- -| ./Profile & Posts Images\. |- -->

    <!-- ---- Profile Progress Bar ---- -->
    <!-- <div class="bd-example-snippet bd-code-snippet mb-4">
      <div class="bd-example m-0 border-0">
        <div class="progress-stacked">
          <div class="progress" style="width: 15%" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
          </div>
          <div class="progress" style="width: 40%" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- -| ./Profile Progress Bar\. |- -->
    

    <!-- ---- POST Form ---- -->
    <?php if (user('id') == $row->id): ?>
      <div>
        <form method="POST" onsubmit="submit_post(event)">
          <div class="bg-secondary rounded p-2">
            <textarea class="form-control shadow mb-3" id="post-input" placeholder="What's on your mind?" cols="6" rows="3"></textarea>

            <?php if(user('id') == $row->id): ?>
              <label>
                <i class="bi bi-image text-white h1 float-start" style="cursor: pointer;"></i>
                <input type="file" class="d-none" id="post-image-input" onchange="display_post_image(this.files[0])">
              </label>
              <button type="submit" class="btn btn-warning border shadow mb-2 float-end fontAlido">Post</button>
            <?php endif; ?>

            <div class="text-center d-none">
              <img class="post-image rounded m-2" src="" alt="" width="150" height="150" style="object-fit: cover;">
            </div>
            <div class="clearfix"></div>
          </div>
        </form>
        <!-- ---- Post Progress Bar ---- -->
        <div class="post-prog progress mb-3 d-none" aria-valuemin="0" aria-valuemax="100">
          <div class="progress-bar bg-success" style="width: 25%">25%</div>
        </div>
        <!-- -| ./Post Progress Bar\. |- -->
      </div>
    <?php endif;?>
    <!-- -| ./POST Form\. |- -->

    <!-- ---- POST Stack ---- -->
    <div class="my-3">
      <?php if (!empty($posts)):?>
        <?php foreach ($posts as $post):?>
          <?=$this->view('includes/post-small',['post'=>$post])?>
        <?php endforeach;?>
      <?php endif;?>
      <?php $pager->display();?>
    </div>
    <!-- -| ./POST Stack\. |- -->

    <!-- ---- POST Form by using AJAX ---- -->
    <script>
      var post_image_added = false;

      function change_image(file) {
        var obj         = {};
        obj.image       = file;
        obj.data_type   = "profile-image";
        obj.id          = "<?=user('id')?>";
        obj.progressbar = 'profile-image-prog';

        send_data(obj);
      }
      // ----  ./Change_Image()

      function submit_post(e) {
        e.preventDefault();

        var obj         = {};
        if (post_image_added) {
          obj.image       = e.currentTarget.querySelector("#post-image-input").files[0];
        }
        // ----  ./IF

        obj.post        = e.currentTarget.querySelector("#post-input").value;
        obj.data_type   = "create-post";
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

        if (obj.data_type == "profile-image") {
          alert(obj.message);
          window.location.reload();
        } else if (obj.data_type == "create-post") {
          alert(obj.message);
          window.location.reload();
        }
        // ----  ./IF/ELSE
      }
      // ----  ./Handle_Result()
    </script>
    <!-- -| ./POST Form by using AJAX\. |- -->
  </div>
</main>
<!-- -------------| ./Main Content\. |------------- -->
<?=$this->view('includes/footer')?>