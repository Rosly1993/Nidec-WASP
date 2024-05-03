
<div class="modal fade" id="add_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form id="addItemForm" action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-4 col-md-4 col-sm-4">
         
            <label for="type" class="control-label">Type</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" style="height:63px" id="type" name="type" placeholder="Enter Location Here"  required autocomplete="off">
              <option value="">Select Type</option>
              <option value="RPA">RPA</option>
              <option value="SYSTEM">SYSTEM</option>
              <option value="IREPORTER">IREPORTER</option>
              <option value="EXCEL">EXCEL</option>
            </select>
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="activity" class="control-label">Activity</label><span style="color:red">*</span>
            <textarea type="text" class="form-control input-lg" id="activity" name="activity" placeholder="Enter Activity Here"  required autocomplete="off"></textarea>
              
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="details" class="control-label">Details</label><span style="color:red">*</span>
            <textarea type="text" class="form-control input-lg" id="details" name="details" placeholder="Enter Details Here"  required autocomplete="off"></textarea> 
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="impact_type" class="control-label">Impact Type</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" style="height:63px" id="impact_type" name="impact_type" placeholder="Enter Location Here"  required autocomplete="off">
              <option value="">Select Impact Type</option>
              <option value="WHRS">Working Hours</option>
              <option value="QUALITY">Quality</option>
              <option value="IDM">Indirect Materials</option>
              
            </select>
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="before" class="control-label">Before(Monthly)</label><span style="color:red">*</span>
            <input type="number" class="form-control input-lg" style="height:63px" id="before" name="before" placeholder="Enter Before Here"  required autocomplete="off">
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="after" class="control-label">After(Monthly)</label><span style="color:red">*</span>
            <input type="number" class="form-control input-lg" style="height:63px" id="after" name="after" placeholder="Enter After Here"  required autocomplete="off">
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="level2_status" class="control-label">Status</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" style="height:63px" id="level2_status" name="level2_status" placeholder="Enter Location Here" onchange="checkStatus()" required autocomplete="off">
              <option value="">Select Status</option>
              <option value="Plan">Plan</option>
              <option value="Done">Done</option>
              <option value="Ongoing">Ongoing</option>
              
            </select>
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="target_date" class="control-label">Target Date</label><span style="color:red">*</span>
            <input type="date" class="form-control input-lg" style="height:63px" id="target_date" name="target_date" placeholder="Enter After Here"  required autocomplete="off" disabled>
             
          </div>
          <div class="form-group col-4 col-md-4 col-sm-4">
            <label for="attachment" class="control-label">Attachment</label><span style="color:red">*</span>
            <input type="file" class="form-control input-lg" style="height:63px" id="attachment" name="attachment" placeholder="Enter After Here"  required autocomplete="off" >
             
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
</div>


<script>
    function checkStatus() {
        var status = document.getElementById("level2_status").value;
        var targetDateInput = document.getElementById("target_date");

        // Clear the value of target_date input regardless of the current status
        targetDateInput.value = "";

        if (status === "") {
            targetDateInput.disabled = true;
        } else {
            targetDateInput.disabled = false;

            if (status === "Plan") {
                var today = new Date();
                // Set min attribute of target_date to today's date
                targetDateInput.min = today.toISOString().split('T')[0];
            } else {
                // Remove the min attribute
                targetDateInput.removeAttribute('min');
            }
        }
    }
</script>