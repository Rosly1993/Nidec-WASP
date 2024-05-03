<?php $this->load->view('components/header'); ?>
<?php $this->load->view('components/sidebar'); ?>
<?php
$user = $this->session->userdata('user_wasp');
extract($user);
?> 

    <div class="header topnavcolor pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h3 text-white d-inline-block mb-0">Profile tables</h3>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?=site_url().'/home'?>"><i class="fas fa-home"></i></a></li>
                           
                        </ol>
                    </nav>
                </div>
               
            </div>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
 
              
                <!-- Light table -->
                <div style="padding: 15px">
                <div class="modal-body">
                <form id="addItemForm" action="" method="post">
        
         <div class="form-row">
        <input type="hidden" class="form-control input-lg" id="userid" name="userid" value="<?php echo $id; ?>"  readonly>
          <div class="form-group col-6 col-md-6 col-sm-6">
            <label for="fullname" class="control-label">Fullname</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" id="fullname" name="fullname" value="<?php echo $fullname; ?>"  readonly>
              
          </div>
          <div class="form-group col-6 col-md-6 col-sm-6">
            <label for="email" class="control-label">Email Address</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" id="email" name="email" value="<?php echo $email; ?>" readonly >
              
          </div>
          <div class="form-group col-6 col-md-6 col-sm-6">
            <label for="username" class="control-label">Username</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" id="username" name="username" value="<?php echo $username; ?>"  readonly>
              
          </div>
          <div class="form-group col-6 col-md-6 col-sm-6">
            <label for="password" class="control-label">Password</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" id="password" name="password" placeholder="Please Enter New Password"  autocomplete="off">
              
          </div>
         
       
         
        </div>
        <div class="modal-footer">
        
          <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
        </div>

                   
     </div>
    </div>
    </div>

    </form>


 
 <?php $this->load->view('components/footer.php'); ?>
<script src='<?=base_url()?>assets/js/profile.js'></script>
                



