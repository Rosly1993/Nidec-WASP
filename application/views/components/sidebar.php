<?php
				$user = $this->session->userdata('user_wasp');
				extract($user);
			?>
<body>

<style>
  .nav-item.active {
    background-color: #940B92;
    color: white !important; 
    border-radius: 7px;/* Replace "your-color" with the desired color */
}
.logout-button:hover {
    cursor: pointer;
    background-color: #FF407D;
}
.topnavcolor{

  background-color: #940B92;
}
</style>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
        <img src="<?php echo base_url('assets/img/brand/wasp.png" style="width: 110px; height: 110px;"  alt="..." ')?>">
        </a>
      </div>
      <div class="navbar-inner"><br><br>
     
        <!-- Collapse -->
     <div class="collapse navbar-collapse" id="sidenav-collapse-main">
    <!-- Nav items -->
    <ul class="navbar-nav">
        <li class="nav-item <?=uri_string() == 'home' ? 'active' : '' ?>">
            <a class="nav-link" href="<?=site_url().'/home'?>">
                <i class="ni ni-chart-bar-32 text-white"></i>
                <span class="nav-link-text">Dashboard</span>
            </a>
        </li>
       

       
        <?php if($role_id=='1' || $role_id=='2' ){ ?>
        <li class="nav-item <?=uri_string() == 'apply' ? 'active' : '' ?>">
            <a class="nav-link" href="<?=site_url().'/apply/'?>">
                <i class="ni ni-settings text-white"></i>
                <span class="nav-link-text">Apply OT</span>
            </a>
        </li>

        <li class="nav-item <?=uri_string() == 'reviewlevel1' ? 'active' : '' ?>">
            <a class="nav-link" href="<?=site_url().'/reviewlevel1/'?>">
                <i class="ni ni-settings text-white"></i>
                <span class="nav-link-text">For Review Level1</span>
            </a>
        </li>
        <li class="nav-item <?=uri_string() == 'reviewlevel2' ? 'active' : '' ?>">
            <a class="nav-link" href="<?=site_url().'/reviewlevel2/'?>">
                <i class="ni ni-settings text-white"></i>
                <span class="nav-link-text">For Review Level2</span>
            </a>
        </li>
        <li class="nav-item <?=uri_string() == 'reviewlevel3' ? 'active' : '' ?>">
            <a class="nav-link" href="<?=site_url().'/reviewlevel3/'?>">
                <i class="ni ni-settings text-white"></i>
                <span class="nav-link-text">For Review Level3</span>
            </a>
        </li>
        <li class="nav-item <?=uri_string() == 'reviewlevel4' ? 'active' : '' ?>">
            <a class="nav-link" href="<?=site_url().'/reviewlevel4/'?>">
                <i class="ni ni-settings text-white"></i>
                <span class="nav-link-text">For Review Level4</span>
            </a>
        </li>
        <li class="nav-item <?=uri_string() == 'summary' ? 'active' : '' ?>">
            <a class="nav-link" href="<?=site_url().'/summary/'?>">
                <i class="ni ni-settings text-white"></i>
                <span class="nav-link-text">Summary Approved OT</span>
            </a>
        </li>
        <li class="nav-item <?=uri_string() == 'rejected' ? 'active' : '' ?>">
            <a class="nav-link" href="<?=site_url().'/rejected/'?>">
                <i class="ni ni-settings text-white"></i>
                <span class="nav-link-text">Summary Rejected OT</span>
            </a>
        </li>
       
        <?php }else{ }?>
      
        <?php if($role_id=='1' ){ ?>
        <li class="nav-item <?=uri_string() == 'areas' ? 'active' : '' ?>">
            <a class="nav-link" href="<?=site_url().'/areas/'?>">
                <i class="ni ni-settings text-white"></i>
                <span class="nav-link-text">Areas</span>
            </a>
        </li>
      
     


        <li class="nav-item <?=uri_string() == 'userroles' ? 'active' : '' ?>">
            <a class="nav-link" href="<?=site_url().'/userroles/'?>">
                <i class="ni ni-circle-08 text-white"></i>
                <span class="nav-link-text">User' Table</span>
            </a>
        </li>
        <?php }else{ }?>
    </ul>
</div>

           
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
         <!-- <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Admin Maintenance</span>
          </h6>  -->
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
           
            <li class="nav-item ">
              <!-- <a style="background-color: #C5FFF8;" class="nav-link active active-pro" href="<?php echo base_url(); ?>index.php/user/logout"> -->
              <!-- <a style="background-color: #C5FFF8;" class="nav-link active active-pro" href="<?=site_url().'/Auth/logout'?>"> -->
                <!-- <i style="font-size: 25px" class="ni ni-atom text-dark"></i> -->
                <!-- <span class="nav-link-text"><b>Logout</b></span> -->
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark topnavcolor  border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <!-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form> -->
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
          <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
           
              
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                  <?php 
                  // Assuming $fullname is "Rosly Rapada"
                  $names = explode(' ', $fullname); // Split full name into an array of names
                  $initials = '';
                  foreach ($names as $name) {
                      $initials .= strtoupper(substr($name, 0, 1)); // Extract the first letter of each name and convert to uppercase
                  }
                  echo $initials; // Output: "RR"
                  ?>
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">

                    <span class="mb-0 text-sm  font-weight-bold" style='color:white'><?php echo $fullname; ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-divider"></div>
                <?php if($fullname=='Guest Account' ){ ?>

                <?php }else{ ?>

                  <a class="dropdown-item logout-button"   href="<?=site_url().'/profile/'?>">
                  <i class="ni ni-circle-08"></i>
                  <span>Profile</span>
                </a>

                <?php }?>
                

                <a class="dropdown-item logout-button" data-toggle="modal"   data-target="#logoutModal">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              
              </div>
              
              
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->

    

      <!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to logout?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/user/logout">Logout</a>
            </div>
        </div>
    </div>
</div>

  