<!-- ------------- NAVBAR ------------- -->
<!-- ---- MODAL ---- -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fontClarity" id="logoutModalLabel">Logout</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body fontVanilla text-center">Sure you want to <span class="">logout</span>?</div>
      <div class="modal-footer fontClarity">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?=ROOT?>/logout" id="navLogout">Logout</a>
      </div>
    </div>
  </div>
</div>
<!-- -| ./MODAL\. |- -->

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow" aria-label="Offcanvas navbar large">
    <div class="container">
      <a class="navbar-brand fontLucindaH" href="./">
        <img class="mb-1" style="width:30px;" src="./assets/img/logo.png" alt="logo"> <?=APP_NAME?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title fontLucindaH" id="offcanvasNavbar2Label"><?=APP_NAME?></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?=ROOT?>">
                <i class="fa fa-house"></i> Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=ROOT?>/post">
                <i class="fa fa-paper-plane"></i> Post
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=ROOT?>/pjtc">
                <i class="fa fa-user-plus"></i> PJTC
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=ROOT?>/emp">
                <i class="fa fa-user-tie"></i> Employee
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=ROOT?>/search">
                <i class="fa fa-search"></i> Search
              </a>
            </li>
            <!-- ---- DROP DOWN ---- -->
            <li class="nav-item dropdown">
              <a href="#" class="text-decoration-none nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- ---- AVATAR ---- -->
                <img src="<?=user('image')?>" alt="<?=ucfirst(user('username'))?>" width="32" height="32" class="rounded-circle me-2"> <?=ucfirst(user('username'))?>
                <!-- -| ./AVATAR\. |- -->
              </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li>
                  <a class="dropdown-item" href="<?=ROOT?>/profile">
                    <i class="fa fa-user"></i> Profile
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="<?=ROOT?>/settings">
                    <i class="fa fa-user-cog"></i> Settings
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider border-light">
                </li>
                <li>
                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="fa fa-sign-out"></i> Logout
                  </a>
                </li>
              </ul>
            </li>
            <!-- -| ./DROP DOWN\. |- -->
          </ul>
          <form method="GET" action="<?=ROOT?>/search" class="d-flex mt-3 mt-lg-0" role="search">
            <input type="text" name="find" class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" value="<?=old_value('find', '', 'GET')?>">
          </form>
        </div>
      </div>
    </div>
  </nav>
  <!-- ----------| ./NAVBAR\. |---------- -->
</header>
