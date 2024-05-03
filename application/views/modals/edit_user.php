<!-- Edit Line Modal -->
<?php
				$user = $this->session->userdata('user_wasp');
				extract($user);
?> 
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_label">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                <input type="hidden" id="edit_id" name="id">
                <input type="hidden" class="form-control input-lg" id="userdata" name="userdata" value="<?php echo $id; ?>">
                <div class="form-row">
                <div class="form-group col-md-6">
                        <label for="edit_fullname">Full Name</label>
                        <input type="text" class="form-control" id="edit_fullname" name="editFullname" placeholder="Enter Full Name" required>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="email" class="control-label">Email Account </label><span style="color:red">*</span>
                    <input type="email" class="form-control input-lg" id="edit_email" name="editEmail" placeholder="Enter Email Here"  required autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edit_username">User Name</label>
                        <input type="text" class="form-control" id="edit_username" name="editUsername" placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edit_password">Password</label>
                        <input type="Password" class="form-control" id="edit_password" name="editPassword" placeholder="Enter Password" readonly >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edit_role_id">Role</label>
                        <select class="form-control" id="edit_role_id" name="editRoleid" required>
                        <option value="" disabled>Select Area</option>
                        <!-- Loop through areas and populate options -->
                        <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role['id']; ?>"><?php echo $role['role_name']; ?></option>
                        <?php endforeach; ?>
                        </select>

                            <!-- Options will be dynamically populated using JavaScript or fetched from the server -->
                       
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edit_area_id">Area</label>
                        <select class="form-control" id="edit_area_id" name="editAreaid" required>
                        <option value="" disabled>Select Area</option>
                        <!-- Loop through areas and populate options -->
                        <?php foreach ($areas as $area): ?>
                        <option value="<?php echo $area['id']; ?>"><?php echo $area['area']; ?> - <?php echo $area['location']; ?></option>
                        <?php endforeach; ?>
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
