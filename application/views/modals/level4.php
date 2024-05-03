
 
<!-- Edit Line Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_label">Level4 Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
              
                <input type="hidden" id="edit_control_number" name="control_number">
                <input type="hidden" id="edit_id" name="id">
               
                <div class="form-row">
                <div class="form-group col-4 col-md-4 col-sm-4">
              
                  <label for="type" class="control-label">Type</label><span style="color:red">*</span>
                  <input type="text" class="form-control input-lg" style="height:63px" id="edit_id_number" name="type" placeholder="Enter Location Here"  readonly autocomplete="off">
                  
                </div>
                <div class="form-group col-4 col-md-4 col-sm-4">
                  <label for="activity" class="control-label">Activity</label><span style="color:red">*</span>
                  <textarea type="text" class="form-control input-lg" id="edit_fullname" name="activity" placeholder="Enter Activity Here" readonly  required autocomplete="off"></textarea>
                    
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
