<!-- Edit Line Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_label">Edit Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_division">Division</label>
                        <select type="text" class="form-control" id="edit_division" name="editDivision" placeholder="Enter Line Number">
                        <option value="">Select Division</option>
                        <option value="PARTS">PARTS</option>
                        <option value="BCO">BCO</option>
                        <option value="BCPA">BCPA</option>
                        <option value="SPM">SPM</option>
                        <option value="SPS2">SPS2</option>
                        <option value="ADMIN">ADMIN</option>
                        </select>
               
                   
                    </div>
                    <div class="form-group">
                        <label for="edit_area">Department</label>
                        <select type="text" class="form-control" id="edit_area" name="editArea" placeholder="Enter Line Number">
                        <option value="">Select Department</option>
                        <option value="QA">QA</option>
                        <option value="ENGINEERING">ENGINEERING</option>
                        <option value="PRODUCTION">PRODUCTION</option>
                        <option value="ADMIN">ADMIN</option>
                        </select>
                   
                    </div>
                    <div class="form-group">
                        <label for="edit_location">Section</label>
                        <select class="form-control" id="edit_location" name="editLocation">
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

                            <!-- Options will be dynamically populated using JavaScript or fetched from the server -->
                       
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
