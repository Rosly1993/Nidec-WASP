<?php $this->load->view('components/header'); ?>
<?php $this->load->view('components/sidebar'); ?>


    <div class="header topnavcolor pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h3 text-white d-inline-block mb-0">Summary Approved OT Tables</h3>
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
            <form method="POST" action="">
            <div class="form-row" style="padding: 15px">
                
            <div class="form-group col-md-4">
            <select type="select" class="form-control input-lg"  style='height: 50px'  id="division" name="division"  required autocomplete="off">
              <option value="">Select Division</option>
              <option value="PARTS">PARTS</option>
              <option value="BCO">BCO</option>
              <option value="BCPA">BCPA</option>
              <option value="SPM">SPM</option>
              <option value="SPS2">SPS2</option>
            </select>
                
            </div>
            <div class="form-group col-md-4">
            <input type="date" class="form-control input-lg" id="date_ot" name="date_ot" placeholder="Enter Mold No Here" required autocomplete="off">  
            </div>
           <div class="form-group col-md-4" ><button  type="submit" style='height: 50px' class="btn btn-success" id="filterBtn">Filter Data</button></div>

            </div>
            </form>
              
                <!-- Light table -->
                <div style="padding: 15px">
                
                    <table id='items_table' class="table table-bordered table-striped" style="width:100%" >
                        <thead style="height: 50px">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Date File</th>
                                <th scope="col">Division</th>
                                <th scope="col">Department</th>
                                <th scope="col">Section</th>
                                <th scope="col">Category</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Employee ID</th>
                                <th scope="col">Fullname</th>
                                <th scope="col">Date Covered</th>
                                <th scope="col">Time From</th>
                                <th scope="col">Time To</th>
                                <th scope="col">Number of OT Hours</th>
                                <th scope="col">Generated PDF</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body content goes here -->
                        </tbody>
                    </table>
                </div>
                </div>




                        
   

                <?php $this->load->view('components/footer.php'); ?>
                <script src='<?=base_url()?>assets/js/summary.js'></script>
                



