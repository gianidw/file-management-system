<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
?>

<form action="<?php echo site_url('home/register')?>" method="post">
        <div class="form-floating mb-3 mt-3">
                <input id="user_name" name='user_name' type="text" class="form-control" placeholder="Full Name" required autofocus>
                <label class="mb-2 text-muted" for="user_name">Full Name</label>
        </div>

        <div class="form-floating mb-3 mt-3">
                <select class="form-select form-select-sm inputbx" aria-label="Office" name="user_office" id="user_office" placeholder="Office" required>
                        <option selected value='' disabled></option>
                        <option value="Office of the President and Chief Executive Officer">Office of the President and Chief Executive Officer</option>
                        <option value="Office of the Chief Information Officer - Information Management Sector">Office of the Chief Information Officer - Information Management Sector</option>
                        <option value="Office of the Chief Operating Officer">Office of the Chief Operating Officer</option>
                        <option value="Task Force Informatics">Task Force Informatics</option>
                        <option value="IPPSD">IPPSD</option>
                        <option value="ITMD">ITMD</option>
                        <option value="PMO">PMO</option>
                        <option value="Human Resource Department">Human Resource Department</option>
                        <option value="Physical Resource and Infrastructure Department">Physical Resource and Infrastructure Department</option>
                        <option value="Protest and Appeals Review Department">Protest and Appeals Review Department</option>
                        <option value="Fund Management Sector">Fund Management Sector</option>
                        <option value="Treasury Department">Treasury Department</option>
                        <option value="International and Local Engagement Department">International and Local Engagement Department</option>
                        <option value="CorComm">CorComm</option>
                        <option value="Corporate Planning Department">Corporate Planning Department</option>
                        <option value="Corporate Marketing Department">Corporate Marketing Department</option>
                        <option value="Management Services Sector">Management Services Sector</option>
                        <option value="Corporate Affairs Group">Corporate Affairs Group</option>
                        <option value="Health Finance Policy Sector">Health Finance Policy Sector</option>
                </select>
                <label class="mb-2 text-muted" for="user_office">Office</label>
                <?php echo form_error('user_office', '<p class="text-danger">', '</p>'); ?>
        </div>

        <div class="form-floating mb-3 mt-3">
                <input id="user_email" name='user_email' type="email" class="form-control" placeholder="Email Address" required>
                <label class="mb-2 text-muted" for="user_email">Email Address</label>
        </div>

        <div class="form-floating mb-3 mt-3">
                <input id="user_password" name='user_password' type="password" class="form-control" placeholder="Password" required>
                <label class="mb-2 text-muted" for="user_password">Password</label>
        </div>

        <div class="form-floating mb-3 mt-3">
                <input id="con_password" name='con_password' type="password" class="form-control" placeholder="Confirm Password" required>
                <label class="mb-2 text-muted" for="con_password">Confirm Password</label>
        </div>

        <div class="mb-3">
                <input id="user_status" name='user_status' type="hidden" class="form-control" value="Pending" readonly></input>
        </div>

        <div class="form-floating mb-3 mt-3">
		
		<select class="form-select form-select-sm inputbx" aria-label="User Type" name="user_type" id="user_type" placeholder="User Type">
			<option value="Regular" default>Regular</option>
			<option value="Admin">Admin</option>
		</select>
                <label class="mb-2 text-muted" for="position">User Type:</label>
	</div>

        <div class="container text-center" >
                <button type="submit" class="btn btn-primary" >Register</button>
        </div>
</form>