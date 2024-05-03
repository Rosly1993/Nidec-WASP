<!-- Edit Line Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_label">Edit Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm" enctype="multipart/form-data">
                <input type="hidden" id="edit_id" name="id">
                <div class="form-row">
          <div class="form-group col-4 col-md-4 col-sm-4">
         
            <label for="type" class="control-label">Type</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" style="height:63px" id="edit_type" name="type" placeholder="Enter Location Here"  required autocomplete="off">
              <option value="">Select Area</option>
              <option value="RPA">RPA</option>
              <option value="SYSTEM">SYSTEM</option>
              <option value="IREPORTER">IREPORTER</option>
              <option value="EXCEL">EXCEL</option>
            </select>
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="activity" class="control-label">Activity</label><span style="color:red">*</span>
            <textarea type="text" class="form-control input-lg" id="edit_activity" name="activity" placeholder="Enter Activity Here"  required autocomplete="off"></textarea>
              
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="details" class="control-label">Details</label><span style="color:red">*</span>
            <textarea type="text" class="form-control input-lg" id="edit_details" name="details" placeholder="Enter Details Here"  required autocomplete="off"></textarea> 
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="impact_type" class="control-label">Impact Type</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" style="height:63px" id="edit_impact_type" name="impact_type" placeholder="Enter Location Here"  required autocomplete="off">
              <option value="">Select Impact Type</option>
              <option value="WHRS">Working Hours</option>
              <option value="QUALITY">Quality</option>
              <option value="IDM">Indirect Materials</option>
              
            </select>
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="before" class="control-label">Before</label><span style="color:red">*</span>
            <input type="number" class="form-control input-lg" style="height:63px" id="edit_before" name="before" placeholder="Enter Before Here"  required autocomplete="off">
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="after" class="control-label">After</label><span style="color:red">*</span>
            <input type="number" class="form-control input-lg" style="height:63px" id="edit_after" name="after" placeholder="Enter After Here"  required autocomplete="off">
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="target_date" class="control-label">Target Date</label><span style="color:red">*</span>
            <input type="date" class="form-control input-lg" style="height:63px" id="edit_target_date" name="target_date" placeholder="Enter After Here"  required autocomplete="off">
             
          </div>
        
          <div  class="form-group col-4 col-md-4 col-sm-4">
            <label for="level2_status" class="control-label">Status</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" style="height:63px" id="edit_level2_status" name="level2_status" placeholder="Enter Location Here"  required autocomplete="off">
              <option value="">Select Status</option>
              <option value="Plan">Plan</option>
              <option value="Done">Done</option>
              <option value="Ongoing">Ongoing</option>
              
            </select>
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="attachment" class="control-label">Attachment</label><span style="color:red">*</span>
            <input type="file" class="form-control input-lg" style="height:63px" id="edit_attachment" name="attachment" placeholder="Enter After Here"  required autocomplete="off" >
             
          </div>
       
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
