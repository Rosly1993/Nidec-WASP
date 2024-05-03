<!-- Add the form element with an ID -->
<?php
				$user = $this->session->userdata('user_wasp');
				extract($user);
?> 
<div class="modal fade" id="add_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form id="addItemForm" action="<?php echo base_url('areas/add_area'); ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Area</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group col-12 col-md-12 col-sm-12">
          <input type="hidden" class="form-control input-lg" id="userdata" name="userdata" value="<?php echo $fullname; ?>">
            <label for="division" class="control-label">Division</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" id="division" name="division"  required autocomplete="off">
              <option value="">Select Division</option>
              <option value="PARTS">PARTS</option>
              <option value="BCO">BCO</option>
              <option value="BCPA">BCPA</option>
              <option value="SPM">SPM</option>
              <option value="SPS2">SPS2</option>
              <option value="ADMIN">ADMIN</option>
            </select>
          </div>
          
          <div class="form-group col-12 col-md-12 col-sm-12">
            <label for="area" class="control-label">Department</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" id="area" name="area" placeholder="Enter Location Here"  required autocomplete="off">
              <option value="">Select Department</option>
              <option value="QA">QA</option>
              <option value="ENGINEERING">ENGINEERING</option>
              <option value="PRODUCTION">PRODUCTION</option>
              <option value="ADMIN">ADMIN</option>
              
            </select>
          </div>
          <div class="form-group col-12 col-md-12 col-sm-12">
            <label for="location" class="control-label">Section</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" id="location" name="location" placeholder="Enter Location Here"  required autocomplete="off">
              <option value="">Select Section</option>
              <option value="FURNACE">FURNACE</option>
              <option value="CASTING">CASTING</option>
              <option value="ANNEALING">ANNEALING</option>
              <option value="DEBURRING">DEBURRING</option>
              <option value="SHOTBLAST">SHOTBLAST</option>
              <option value="PTC">PTC</option>
              <option value="EDCOAT">EDCOAT</option>
              <option value="EFI">EFI</option>
              <option value="MACHINING">MACHINING</option>
              <option value="MFI">MFI</option>
              <option value="ADMIN">ADMIN</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
