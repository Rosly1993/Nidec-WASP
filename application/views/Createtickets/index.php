<?php $this->load->view('components/header'); ?>
<?php $this->load->view('components/sidebar'); ?>


    <div class="header topnavcolor pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h3 text-white d-inline-block mb-0">Create Tickets Tables</h3>
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
              
             <br>
            <div ><a href="<?=site_url().'/createtickets/'?>" style="color:white;text-decoration: none"><button style="float:right;margin-left: 10px" class="btn btn-secondary" > Created Tickets </button></a> 
            <a href="<?=site_url().'/rejecttickets/'?>" style="color:white;text-decoration: none"> <button  style="float:right;margin-left: 10px"class="btn btn-danger"> Rejected Tickets</button></a></div>
          
              
              
                <!-- Light table -->
                <div style="padding: 15px">
                
                    <table id='items_table' class="table table-bordered table-striped " style="width: 100%" >
                        <thead style="height: 50px">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">BU</th>
                                <th scope="col">Department</th>
                                <th scope="col">Type</th>
                                <th scope="col">Activity</th>
                                <th scope="col">Details</th>
                                <th scope="col">Impact</th>
                                <th scope="col">Before</th>
                                <th scope="col">After</th>
                                <th scope="col">Savings</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Created By</th>
                                <th scope="col">PDF</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body content goes here -->
                        </tbody>
                    </table>
                </div>
                </div>




                        
                <?php $this->load->view("modals/add_ticket") ?>
                <?php $this->load->view("modals/edit_ticket") ?>
                <?php $this->load->view('components/footer.php'); ?>
                <script src='<?=base_url()?>assets/js/createtickets.js'></script>
                



