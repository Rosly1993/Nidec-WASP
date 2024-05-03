<?php $this->load->view('components/header'); ?>
<?php $this->load->view('components/sidebar'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


    <div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h3 text-white d-inline-block mb-0">Dashboard</h3>
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
               <!-- <div><canvas id="pieChart" width="400" height="400"></canvas></div> -->
             
 


<!-- <div><canvas id="ireporterDonutChart" width="250" height="250"></canvas></div> -->

    
 
<div class="table-container" style="width: 100%; margin-left: 15px">
    <table style="width: 100%;">
        <tr>
            <td >
            <center>  <button class="btn btn-success"><a href="<?=site_url().'/ireporter/'?>" style="color:white;text-decoration: none; font-size: 20px"> <b>Ireporter </b>(<span id="accept_percentage1"></span>)</a></button></center>
<div style="width: 98%; margin-left: 15px"><canvas id="barChartCanvasId" width="400" height="400"></canvas></div>
                <br>
                <br>
                <table id="data-table" style="width: 98%;text-align: center; font-size: 15px" class="table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Count</th>
                            <th>Contribution</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Plan</td>
                            <td id="plan_count"></td>
                            <td id="plan_percentage"></td>
                        </tr>
                        <tr>
                            <td>Ongoing</td>
                            <td id="ongoing_count"></td>
                            <td id="ongoing_percentage"></td>
                        </tr>
                        <tr>
                            <td>Accept</td>
                            <td id="accept_count"></td>
                            <td id="accept_percentage"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
           
        </tr>
    </table>
</div>

             
      

<!-- Light table -->
                <div style="padding: 15px"><BR>
                
               
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
                                <th scope="col">Attachment</th>
                                <th scope="col">Status</th>
                                <!-- <th scope="col">Status</th> -->
                         
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body content goes here -->
                        </tbody>
                    </table>
                </div>
                </div>




                        
   
            
                <?php $this->load->view('components/footer.php'); ?>
                <script src='<?=base_url()?>assets/js/ireporter.js'></script>
                



