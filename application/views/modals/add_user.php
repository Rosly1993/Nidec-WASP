<!-- Add the form element with an ID -->
<?php
				$user = $this->session->userdata('user_wasp');
				extract($user);
?> 
<div class="modal fade" id="add_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="addItemForm"> <!-- Add the form element here -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="hidden" class="form-control input-lg" id="userdata" name="userdata" value="<?php echo $id; ?>">
        <div class="form-row">
        <div class="form-group col-md-6">
            <label for="fullname" class="control-label">Full Name </label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" id="fullname" name="fullname" placeholder="Enter Full Name Here"  required autocomplete="off">
          </div>
          <div class="form-group col-md-6">
            <label for="email" class="control-label">Email Account </label><span style="color:red">*</span>
            <input type="email" class="form-control input-lg" id="email" name="email" placeholder="Enter Email Here"  required autocomplete="off">
          </div>
          <div class="form-group col-md-6">
            <label for="username" class="control-label">User Name </label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" id="username" name="username" placeholder="Enter User Name Here"  required autocomplete="off">
          </div>
          <div class="form-group col-md-6">
            <label for="password" class="control-label">Password</label><span style="color:red">*</span>
            <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Enter Password Here"  required autocomplete="off">
          </div>
          <div class="form-group col-md-6">
            <label for="role_id" class="control-label">Role</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" id="role_id" name="role_id" placeholder="Enter description Name Here"  required autocomplete="off">
           
           <option value="">Select Role</option>
            <!-- Loop through areas and populate options -->
            <?php foreach ($roles as $role): ?>
            <option value="<?php echo $role['id']; ?>"><?php echo $role['role_name']; ?></option>
            <?php endforeach; ?>

            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="area_id" class="control-label">Area</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" id="area_id" name="area_id" placeholder="Enter description Name Here"  required autocomplete="off">
           
           <option value="">Select Area</option>
            <!-- Loop through areas and populate options -->
            <?php foreach ($areas as $area): ?>
            <option value="<?php echo $area['id']; ?>"><?php echo $area['area']; ?> - <?php echo $area['location']; ?></option>
            <?php endforeach; ?>

            </select>
          </div>
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
