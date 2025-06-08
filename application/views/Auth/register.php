<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>PHILHEALTH INTRANET</title>
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/all.css">
    	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/toast/toast.min.css">
    	<script src="<?php echo base_url(); ?>/assets/toast/jqm.js"></script>
    	<script src="<?php echo base_url(); ?>/assets/toast/toast.js"></script>
 </head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-4">
						<img src="<?php echo base_url(); ?>/assets/logo.png" alt="logo" width="150">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
                					<?php echo form_open('home/register'); ?>
							<div class="form-floating mb-3 mt-3">
								<input id="user_name" name='user_name' type="text" class="form-control" value="<?php echo set_value('user_name'); ?>" placeholder="Full Name" required autofocus> </input>
								<label class="mb-2 text-muted" for="user_name">Full Name</label>
								<?php echo form_error('user_name', '<p class="text-danger">', '</p>'); ?>
							</div>
							
							<div class="form-floating mb-3 mt-3">
								<select class="form-select form-select-sm inputbx" aria-label="Office" name="user_office" id="user_office" placeholder="Office" required>
									<option selected value='' disabled>Select Office</option>
									<option value="Office of the President and Chief Executive Officer">OP-CEO - Office of the President and Chief Executive Officer</option>
									<option value="Office of the Chief Information Officer - Information Management Sector">OCIO/IMS - Office of the Chief Information Officer - Information Management Sector</option>
									<option value="Office of the Chief Operating Officer">OCOO - Office of the Chief Operating Officer</option>
									<option value="Task Force Informatics">TFI - Task Force Informatics</option>
									<option value="IPPSD">IPPSD</option>
									<option value="ITMD">ITMD</option>
									<option value="PMO">PMO</option>
									<option value="Human Resource Department">HRD - Human Resource Department</option>
									<option value="Physical Resource and Infrastructure Department">PRID - Physical Resource and Infrastructure Department</option>
									<option value="Protest and Appeals Review Department">PARD - Protest and Appeals Review Department</option>
									<option value="Fund Management Sector">FMS - Fund Management Sector</option>
									<option value="Treasury Department">Treasury Department</option>
									<option value="International and Local Engagement Department">ILED - International and Local Engagement Department</option>
									<option value="CorComm">CorComm</option>
									<option value="Corporate Planning Department">CorPlan - Corporate Planning Department</option>
									<option value="Corporate Marketing Department">CorMar - Corporate Marketing Department</option>
									<option value="Management Services Sector">MMS - Management Services Sector</option>
									<option value="Corporate Affairs Group">CAG - Corporate Affairs Group</option>
									<option value="Health Finance Policy Sector">HFPS - Health Finance Policy Sector</option>
								</select>
								<label class="mb-2 text-muted" for="user_office">Office</label>
								<?php echo form_error('user_office', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-floating mb-3 mt-3">
								<input id="user_email" name='user_email' type="email" class="form-control" value="<?php echo set_value('user_email'); ?>" placeholder="Email Address" required> </input>
								<label class="mb-2 text-muted" for="user_email">Email Address</label>
								<?php echo form_error('user_email', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-floating mb-3 mt-3">	
								<input id="user_password" name='user_password' type="password" class="form-control" placeholder="Password" required>
								<label class="mb-2 text-muted" for="user_password">Password</label>
								<?php echo form_error('user_password', '<p class="text-danger">', '</p>'); ?>
							</div>

                                			<div class="form-floating mb-3 mt-3">
								<input id="con_password" name='con_password' type="password" class="form-control" placeholder="Confirm Password"  required>
								<label class="mb-2 text-muted" for="con_password">Confirm Password</label>
								<?php echo form_error('user_password', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="mb-3">
								<input id="user_status" name='user_status' type="hidden" class="form-control" value="Pending" readonly></input>
							</div>

							<div class="mb-3">
								<input id="user_type" name='user_type' type="hidden" class="form-control" value="Regular" readonly></input>
							</div>

							<div class="d-flex align-items-center">
								<button type="submit" class="btn btn-primary ms-auto">Register</button>
							</div>
							<?php echo form_close(); ?>
						</div>

						<div class="card-footer py-3 border-0">
							<div class="text-center">Have an account? 
								<a href="<?php echo base_url('home/login'); ?>" class="text-dark"> Login</a>
							</div>
						</div>
					</div>
					
					<div class="text-center mt-5 text-muted">
					© Copyright &copy; 2023 &mdash; <a href="https://www.philhealth.gov.ph/">philhealth.gov.ph</a> 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript"> 
    <?php if($this->session->flashdata('suc')){ ?>
        toastr.success("<?php echo $this->session->flashdata('suc'); ?>");
    <?php }else if($this->session->flashdata('wrong')){?>
        toastr.error("<?php echo $this->session->flashdata('wrong'); ?>");
    <?php }else if($this->session->flashdata('warning')){?>
        toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
    <?php }else if($this->session->flashdata('wrong')){?>
        toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php }?>
    <?php 
        $this->session->unset_userdata ('suc'); ?>

        <?php $this->session->unset_userdata ('wrong');?>
    </script>
</body>
</html>

    

