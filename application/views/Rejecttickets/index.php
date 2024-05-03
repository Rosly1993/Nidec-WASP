<?php $this->load->view('components/header'); ?>
<?php $this->load->view('components/sidebar'); ?>


    <div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h3 text-white d-inline-block mb-0">Rejected Tickets Tables</h3>
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
            <div style="margin-left: 15px"><button class="btn btn-secondary"  style="float:right;margin-left: 10px"><a href="<?=site_url().'/createtickets/'?>" style="color:white;text-decoration: none"> Created Tickets</a> </button>&nbsp;
            <button  style="float:right" class="btn btn-danger"><a href="<?=site_url().'/rejecttickets/'?>" style="color:white;text-decoration: none"> Rejected Tickets</a></button></div>
          
              
              
                <!-- Light table -->
                <div style="padding: 15px">
                
                    <table id='items_table' class="table table-bordered table-striped" style="width: 100%" >
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
                                <th scope="col">PIC</th>
                                <th scope="col">Rejected By</th>
                                <th scope="col">Remarks</th>
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




                        
    
                <?php $this->load->view("modals/reject_ticket") ?>
                <?php $this->load->view('components/footer.php'); ?>
                <script src='<?=base_url()?>assets/js/rejecttickets.js'></script>
                



