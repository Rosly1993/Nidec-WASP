<?php $this->load->view('components/header'); ?>
<?php $this->load->view('components/sidebar'); ?>


    <div class="header topnavcolor pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h3 text-white d-inline-block mb-0">Apply OT Tables</h3>
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
            <div class="card"><br>
                <!-- Card header -->
               
   <form id="employeeForm">
    <div class="form-group col-6">

        <input type="text" name="id_number" class="form-control input-lg" placeholder="Enter ID Number Here"><br>
        <button type="submit"   class="btn btn-primary" id="saveChangesBtn">Add Employee</button>
    </div>

    <div class="form-row" style="padding: 15px">
    <div class="form-group col-2">
    <label for="type" class="control-label">Date Filed</label><span style="color:red">*</span>
        <input type="text" name="date_ot" style="height: 40px" class="form-control input-lg" value="<?php echo date('Y-m-d'); ?>" readonly>
    </div>
    <div class="form-group col-2">
    <label for="type" class="control-label">Division</label><span style="color:red">*</span>
    <select type="text" name="division" id="division" class="form-control input-lg" style="height: 40px" placeholder="Select Department">
        <option value="">Select Division</option>
        <option value="Parts">Parts</option>
        <option value="BCO">BCO</option>
        <option value="SPM">SPM</option>
        <option value="SPS2">SPS2</option>
        
    </select>
</div>
    <div class="form-group col-2">
    <label for="type" class="control-label">Select Department</label><span style="color:red">*</span>
        <select type="text" name="area" class="form-control input-lg"  placeholder="Select Department" >
        <!-- <select type="text" name="area[]" class="js-example-basic-multiple"  placeholder="Select Department" multiple="multiple"> -->

        <option value="Production">Production</option>
        <option value="MED">MED</option>
        <option value="PED">PED</option>
        <option value="QA">QA</option>
        </select>
    </div>
    <div class="form-group col-2">
    <label for="type" class="control-label">Select Section</label><span style="color:red">*</span>
        <select type="text" name="location" class="form-control input-lg"  placeholder="Select Section" >
        <!-- <select type="text" name="location[]" class="js-example-basic-multiple"  placeholder="Select Section" multiple="multiple"> -->
        <option value="Casting">Casting</option>
        <option value="Deburring">Deburring</option>
        <option value="Annealing">Annealing</option>
        <option value="ED-Coat">ED-Coat</option>
        </select>
    </div>
    <div class="form-group col-2">
    <label for="type" class="control-label">Date Covered</label><span style="color:red">*</span>
        <input type="date" style="height: 40px"  name="date_ot" class="form-control input-lg" >
    </div>
    <div class="form-group col-2">
    <label for="type" class="control-label">Category</label><span style="color:red">*</span>
        <select type="select" style="height: 40px" name="category" class="form-control input-lg" placeholder="Select Section">
        <option value="">Please Select Category</option>
        <option value="Regular Day">Regular Day</option>
        <option value="Rest Day">Rest Day</option>
        <option value="Legal/Special Holiday">Legal/Special Holiday</option>
        <option value="NP/Force Leave, NWS">NP/Force Leave, NWS</option>
        </select>
    </div>
    <div class="form-group col-12">
    <label for="type" class="control-label">Purpose</label><span style="color:red">*</span>
        <input type="text" style="height: 70px" name="purpose" class="form-control input-lg" placeholder="Please Input Purpose Here" autocomplete="off">
       
    </div>

    </div>
<!-- Light table -->
<div style="padding: 15px">
    <table id='items_table' class="table table-bordered table-striped" style="width:100%">
        <thead style="height: 50px">
            <tr>
                <th scope="col">ID Number</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Time From</th>
                <th scope="col">Time To</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table body content goes here -->
        </tbody>
    </table><br>
    <button id="save_appenddata_btn" class="btn btn-success">Save Request</button>
    </div>
  </div>
</form>

<?php $this->load->view('components/footer.php'); ?>

<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
<script src='<?=base_url()?>assets/js/apply.js'></script>   



