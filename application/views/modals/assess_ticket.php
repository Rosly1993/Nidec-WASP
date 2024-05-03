
<?php
 $user = $this->session->userdata('user_wasp');
 extract($user);
?>
 
<!-- Edit Line Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_label">Ticket Assessment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                <input type="hidden" class="form-control input-lg" id="userdata1" name="userdata1" value="<?php echo $fullname; ?>">
                <input type="hidden" id="edit_id" name="id">
                <input type="hidden" id="edit_area_id" name="area_id">
                <input type="hidden" id="edit_date_add" name="date_add">
                <input type="hidden" id="edit_level2_pic" name="level2_pic">
                <div class="form-row">
          <div class="form-group col-4 col-md-4 col-sm-4">
         
            <label for="type" class="control-label">Type</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" style="height:63px" id="edit_type" name="type" placeholder="Enter Location Here"  readonly autocomplete="off">
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="activity" class="control-label">Activity</label><span style="color:red">*</span>
            <textarea type="text" class="form-control input-lg" id="edit_activity" name="activity" placeholder="Enter Activity Here" readonly  required autocomplete="off"></textarea>
              
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="details" class="control-label">Details</label><span style="color:red">*</span>
            <textarea type="text" class="form-control input-lg" id="edit_details" name="details" placeholder="Enter Details Here" readonly required autocomplete="off"></textarea> 
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="impact_type" class="control-label">Impact Type</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" style="height:63px" id="edit_impact_type" name="impact_type" readonly placeholder="Enter Location Here"  required autocomplete="off">
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="before" class="control-label">Before</label><span style="color:red">*</span>
            <input type="number" class="form-control input-lg" style="height:63px" id="edit_before" name="before" placeholder="Enter Before Here" readonly required autocomplete="off">
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="after" class="control-label">After</label><span style="color:red">*</span>
            <input type="number" class="form-control input-lg" style="height:63px" id="edit_after" name="after" placeholder="Enter After Here" readonly required autocomplete="off">
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="target_date" class="control-label">Target Date</label><span style="color:red">*</span>
            <input type="date" class="form-control input-lg" style="height:63px" id="edit_target_date" name="target_date" placeholder="Enter After Here" readonly  required autocomplete="off">
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="uom" class="control-label">Unit of Measurement</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" style="height:63px" id="edit_uom" name="uom" placeholder="Enter Location Here"  readonly required autocomplete="off">
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="level2_pic" class="control-label">Asign To</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" style="height:63px" id="level2_pic" name="level2_pic" placeholder="Enter description Name Here"  required autocomplete="off">
           
           <option value="">Select Role</option>
            <!-- Loop through areas and populate options -->
            <?php foreach ($userroles as $role): ?>
            <option value="<?php echo $role['fullname']; ?>"><?php echo $role['fullname']; ?></option>
            <?php endforeach; ?>

            </select>
          </div>
         
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateChangesBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>
</div>
