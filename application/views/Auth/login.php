<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
?>
<script src="<?php echo $CI->config->base_url();?>/assets/js/jquery-3.7.0.min.js">
	$(function(){
          toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
        });
</script>
<?php
$regcheck = $this->session->flashdata('regcheck');
	if($regcheck == 1){
		?>
		<script>
			$(document).ready(function(){
				toastr.info('Registered Successfully!')
			})
		</script>
		<?php
	}
?>

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
						<h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
						<?php echo form_open('home/login_check'); ?>
					
							<div class="form-floating mb-3 mt-3">
								<input id="user_email" type="user_email" class="form-control" name="user_email" placeholder="Email Address" required autofocus>
								<label class="mb-2 text-muted" for="user_email">Email Address</label>
							</div>

							<div class="form-floating mb-3 mt-3">
								<input id="user_password" type="password" class="form-control" name="user_password" placeholder="Password" required>								
								<label class="mb-2 text-muted" for="user_password">Password</label>
							</div>

							<div class="d-flex align-items-center">
								<button type="submit" class="btn btn-primary ms-auto">Login</button>
							</div>
						<?php echo form_close(); ?>
					</div>
					<div class="card-footer py-3 border-0">
						<div class="text-center">
							Don't have an account? <a href="<?php echo base_url('home/register'); ?>" class="text-dark">Create One</a>
						</div>
					</div>
				</div>
				<div class="text-center mt-5 text-muted">
					Copyright &copy; 2023 &mdash; <a href="https://www.philhealth.gov.ph/" target=_blank>philhealth.gov.ph</a>
				</div>
			</div>
		</div>
	</div>
</section>

	<script type="text/javascript"> 
	<?php 
	if($this->session->flashdata('success')){ ?>
		toastr.success("<?php echo $this->session->flashdata('suc'); ?>");
	<?php 
	}
	else if($this->session->flashdata('error')){?>
		toastr.error("<?php echo $this->session->flashdata('error'); ?>");
	<?php 
	}
	else if($this->session->flashdata('warning')){?>
		toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
	<?php 
	}
	else if($this->session->flashdata('info')){?>
		toastr.info("<?php echo $this->session->flashdata('info'); ?>");
	<?php 
	}
		$this->session->unset_userdata ('error');
		$this->session->unset_userdata ('wrong');
		$this->session->unset_userdata ('warning');
		$this->session->unset_userdata ('info');
	?>
    </script>

</body>
</html>