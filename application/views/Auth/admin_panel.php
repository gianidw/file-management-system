<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$regcheck = $this->session->flashdata('regcheck');
$uploadcheck = $this->session->flashdata('uploadcheck');
$bulkuploadcheck = $this->session->flashdata('bulkuploadcheck');
$emailcheck = $this->session->flashdata('emailcheck');

	if($regcheck == 1){
		?>
		<script>
			$(document).ready(function(){
				toastr.info('Registered Successfully!')
			})
		</script>
		<?php
	}

	if($uploadcheck == 1){
		?>
		<script>
			$(document).ready(function(){
				toastr.success('Upload Successful!')
			})
		</script>
		<?php
	}

	if($emailcheck == 1){
		?>
		<script>
			$(document).ready(function(){
				setTimeout(function () {
					toastr.success('Email sent successfully!')
				}, 1500);
			})
		</script>
		<?php
	}
	elseif($emailcheck == 2){
		?>
		<script>
			$(document).ready(function(){
				setTimeout(function () {
					toastr.error('Failed to send email.')
				}, 1500);
			})
		</script>
		<?php
	}

	if($bulkuploadcheck == 1){
		?>
		<script>
			$(document).ready(function(){
				toastr.success('Files uploaded successfully!')
			})
		</script>
		<?php
	}
	elseif($bulkuploadcheck == 2){
		?>
		<script>
			$(document).ready(function(){
				toastr.error('Failed to upload files!')
			})
		</script>
		<?php
	}
	elseif($bulkuploadcheck == 3){
		?>
		<script>
			$(document).ready(function(){
				toastr.error('No files to upload!')
			})
		</script>
		<?php
	}
?>

<script>
	
	$(document).ready(function(){
		function applyFilter(value) {
			$("#myTable tr").each(function() {
				var rowText = $(this).text().toLowerCase();
				var showRow = rowText.indexOf(value) > -1;
				$(this).toggle(showRow);
			});
		}

		function clearSearch() {
			// Clear the search input, show all rows, and remove highlights
			$("#myInput").val("");
			applyFilter("");
		}

		$("#myInput").on("input", function() {
			var value = $(this).val().toLowerCase();
			if (value === "") {
				clearSearch();
			} 
			else {
				applyFilter(value);
			}
		});

		$("#myInput").on("search", function() {
			// Handle the x button click
			var value = $(this).val().toLowerCase();
			if (value === "") {
				clearSearch();
			}
		});
        });
</script>
<style>
	.b {
		width:150px;
		text-align: center;
		vertical-align: middle;
		line-height: 1.5;
	}
	.d {
		white-space:nowrap;
		overflow:hidden;
		vertical-align:middle;
		line-height: 1.5;
		text-overflow: ellipsis;
	}
	thead th{
		padding: 10px !important;
		height: 5px;
	}
	.tab {
		overflow: hidden;
		border: 1px solid #ccc;
		background-color: #f1f1f1;
	}

	/* Style the buttons that are used to open the tab content */
	.tab button {
		background-color: inherit;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 14px 16px;
		transition: 0.3s;
	}

	/* Change background color of buttons on hover */
	.tab button:hover {
		background-color: #ddd;
	}

	/* Create an active/current tablink class */
	.tab button.active {
		background-color: #ccc;
	}

	/* Style the tab content */
	.tabcontent {
		display: none;
		padding: 6px 12px;
		border: 1px solid #ccc;
		border-top: none;
	}
	.tabcontent {
		animation: fadeEffect 0.5s; /* Fading effect takes 1 second */
	}

	/* Go from zero to full opacity */
	@keyframes fadeEffect {
		from {opacity: 0;}
		to {opacity: 1;}
	}

	.button-container {
		display: flex;
	}
	.btn {
		margin-right: 10px;
	}

	/* Adjust the width of the search input if needed */
	#myInput {
		width: 200px;
	}
	.container-fluid {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
	}

	.switch input { 
		opacity: 0;
		width: 0;
		height: 0;
	}

	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 26px;
		width: 26px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}


	input:checked + .slider {
		background-color: #2196F3;
	}

	input:focus + .slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
	}

	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}

</style>
<div class="container-fluid">
	<div class="button-container">
		<button type="button" class="btn btn-primary uploadFile" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-default" data-modal-title="Upload File">
			<i class="fa-solid fa-plus"></i> Upload File
		</button>

		<button type="button" class="btn btn-primary uploadBulk" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-default" data-modal-title="Upload Multiple Files">
			<i class="fa-solid fa-plus"></i> Bulk Upload
		</button>

		<button type="button" class="btn btn-primary uploadForm" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-default" data-modal-title="Upload Form">
			<i class="fa-solid fa-plus"></i> Upload PHIC Form
		</button>

		<button type="button" class="btn btn-primary addUser" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-default" data-modal-title="Register New User">
			<i class="fa-solid fa-user-plus"></i> Add New User
		</button>
		
		<!-- <button type="button" class="btn btn-primary addPersonnel" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-default" data-modal-title="Add Personnel">
			<i class="fa-solid fa-user-plus fa-beat-fade"></i> Add to Directory
		</button> -->

		<a type="button" class="btn btn-primary" style="width: 200px;" href="<?php echo base_url('home/addpersonnel');?>">
			<i class="fa-solid fa-user-plus"></i> Add to Directory
		</a>
	</div>
	<input id="myInput" type="search" placeholder="Search Users"></input>
</div>
<br>
<div class="tab">
	<button class="tablinks" onclick="openTab(event, 'active_users')" id="defaultOpen">Active Users</button>
	<button class="tablinks" onclick="openTab(event, 'pending_users')">Pending Users</button>
	<button class="tablinks" onclick="openTab(event, 'files_list')">Files List</button>
</div>


<div id="active_users" class="tabcontent">
	<table id="user_list" class="table table-bordered table-striped table-hover table-sm table-responsive caption-top" style="border:thin; table-layout:fixed;">
		<thead class="bg-light top-0">
			<tr>
				<th class="b">ID #</th>
				<th class="b">Name</th>
				<th class="b">Office</th>
				<th class="b">Email</th>
				<th class="b">User Type</th>
				<th class="b">User Status</th>
				<th class="b">Actions</th>
			</tr>
		</thead>
		<tbody id="myTable">
			<?php
			{
				foreach($tableData1 as $rows => $cols)
				if($cols['user_status'] != 'Pending'){

					// Determine the initial toggle state
					$isAdmin = $cols['user_type'] == 'Admin' ? 'checked' : '';
					$isChecked = $cols['user_status'] == 'Active' ? 'checked' : '';
					
					echo '
					<tr>
						<td class="b user-id"><a>'.$cols['user_id'].'</a></td>
						<td class="b"><a>'.$cols['user_name'].'</a></td>
						
						<td class="b">
							<select class="form-select form-select-sm office-dropdown" data-user-id="'.$cols['user_id'].'">
								<option value="'.$cols['user_office'].'" disabled selected>'.$cols['user_office'].'</option>
								<option value="Office of the President and Chief Executive Officer" data-subtext="OP-CEO">OP-CEO - Office of the President and Chief Executive Officer</option>
								<option value="Office of the Chief Information Officer - Information Management Sector">OCIO-IMS - Office of the Chief Information Officer - Information Management Sector</option>
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
						</td>
						
						<td class="b"><a>'.$cols['user_email'].'</a></td>

						<td class="b">
							<select class="form-select form-select-sm type-dropdown" data-user-id="'.$cols['user_id'].'">
								<option value="'.$cols['user_type'].'" disabled selected>'.$cols['user_type'].'</option>
								<option value="Regular">Regular</option>
								<option value="Office Admin">Office Admin</option>
								<option value="Admin">Admin</option>
							</select>
						</td>

						<td class="b">
							<span class="b text-muted">Inactive</span>
							<label class="switch">
								<input type="checkbox" class="status-slider" ' . $isChecked . '>
								<span class="slider round"></span>
							</label>
							<span class="b">Active</span>
						</td>

						<td class ="b"><button class="btn btn-danger" type="button" style="width: 80px;" onclick="javascript:window.location.href=\''.site_url('home/denyform/').$cols['user_id'].'\'">Delete</button>
						</td>
					</tr>';

				}
			}
			?>
		</tbody>
	</table>
</div>

<div id="pending_users" class="tabcontent">
	<table id="pending_list" class="table table-bordered table-striped table-hover table-sm table-responsive caption-top" style="border:thin; table-layout:fixed;">
		<thead class="bg-light top-0">
			<tr>
				<th class="b">ID #</th>
				<th class="b">Name</th>
				<th class="b">Office</th>
				<th class="b">Email</th>
				<th class="b">Status</th>
				<th class="b">Actions</th>
			</tr>
		</thead>
		<tbody id="myTable">
			<?php
			{
				foreach($tableData1 as $rows => $cols)
				if($cols['user_status'] == 'Pending'){
					echo '
					<tr>
						<td class="b"><a>'.$cols['user_id'].'</td>
						<td class="b"><a>'.$cols['user_name'].'</td>
						<td class="b"><a>'.$cols['user_office'].'</td>
						<td class="b"><a>'.$cols['user_email'].'</td>
						<td class="b"><a>'.$cols['user_status'].'</td>
						<td class="b" ><button class="btn btn-secondary" type="button" title="EDIT RECORDS" style="width: 80px;" onclick="javascript:window.location.href=\''.base_url('task/user_approve/').$cols['user_id'].'\'">Approve</button>
						<button class="btn btn-danger" type="button" style="width: 80px;" onclick="javascript:window.location.href=\''.site_url('home/denyform/').$cols['user_id'].'\'">Deny</button></td>
					</tr>';
				}
			}
			?>
		</tbody>
	</table>
</div>

<div id="files_list" class="tabcontent">
	<table id="files_list" class="table table-bordered table-striped table-hover table-sm" style="table-layout:fixed;">
		<thead class="bg-light top-0">
				<tr>
					<th class="b">Category</th>
					<th class="b">File</th>
					<th class="b">Details</th>
					<th class="b">Originating Office</th>
					<th class="b">Options</th>

				</tr>
		</thead>
		<tbody id="myTable">
			<?php
				function compareDates($a, $b)
				{
					return strtotime($b['file_date_created']) - strtotime($a['file_date_created']);
				}
				// Sort the table data array by date posted
				usort($tableData2, 'compareDates');
				
				foreach($tableData2 as $rows => $cols)
				{
					$fileWhole = $cols['file_name'];
					echo '
					<tr>
						<td class="b">
							<a>'.$cols['file_category'].'
						</td>

						<td class="d">	
							<a href="'.base_url().'assets/files/'.$fileWhole.'" target=_blank>
							'.$fileWhole.'
						</td>

						<td class="d">
							<a>'.$cols['file_details'].'
						</td>

						<td class="b">
							<a>'.$cols['file_originating_office'].'
						</td>

						
							<td class="b">
							
								<button class="btn btn-secondary viewMore" type="button" title="View Details" data-bs-toggle="modal" data-id="'.$cols['file_ID'].'" data-modal-title="File Info"><i class="fa-solid fa-magnifying-glass"></i></button>
								<button class="btn btn-success" type="button" title="Download Entry" onclick="javascript:window.location.href=\''.base_url().'task/download/'.$fileWhole.'\'"><i class="fa-solid fa-download"></i></button>
								<button class="btn btn-info editFile" type="button" data-bs-toggle="modal" data-bs-target="#editModal" title="Edit Entry" data-id="'.$cols['file_ID'].'" data-modal-title="Edit File"><i class="fa-solid fa-pen-to-square"></i></button>
								<button class="btn btn-danger" type="button" title="Delete Entry" onclick="javascript:window.location.href=\''.base_url('task/delete/').$cols['file_ID'].'/'.$fileWhole.'\'"><i class="fa-solid fa-trash"></i></button>
							
							</td>
						
					</tr>
					';
				}
				
			?>
		</tbody>
	</table>
</div>





<script type="text/javascript">
	

	function openTab(evt, tabName) {
	// Declare all variables
	var i, tabcontent, tablinks;

	// Get all elements with class="tabcontent" and hide them
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
	tabcontent[i].style.display = "none";
	}

	// Get all elements with class="tablinks" and remove the class "active"
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
	tablinks[i].className = tablinks[i].className.replace(" active", "");
	}

	// Show the current tab, and add an "active" class to the button that opened the tab
	document.getElementById(tabName).style.display = "block";
	evt.currentTarget.className += " active";
	}

	document.getElementById("defaultOpen").click();

	function openModalWithDynamicTitle(title) {
            $('#staticBackdropLabel').text(title);
            $('#modal-default').modal('show');
        }

	function openModalWithDynamicTitle2(title) {
            $('#staticBackdropLabel2').text(title);
            $('#modal-fs').modal('show');
        }

	function openModalWithDynamicTitle3(title) {
            $('#editModalTitle').text(title);
            $('#editModal').modal('show');
        }

	$(".uploadFile").on("click", function(){
		openModalWithDynamicTitle($(this).data('modal-title'));
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('task/uploadfile'); ?>',
			success: function(response) {
				// Handle the AJAX response here if needed
				$('#modal-default .modal-body').html(response);
				// Show the modal
				$('#modal-default').modal('show');
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});
	});

	$(".uploadForm").on("click", function(){
		openModalWithDynamicTitle($(this).data('modal-title'));
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('task/uploadForm'); ?>',
			success: function(response) {
				// Handle the AJAX response here if needed
				$('#modal-default .modal-body').html(response);
				// Show the modal
				$('#modal-default').modal('show');
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});
	});
	
	$(".uploadBulk").on("click", function(){
		openModalWithDynamicTitle($(this).data('modal-title'));
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('task/open_bulk'); ?>',
			success: function(response) {
				// Handle the AJAX response here if needed
				$('#modal-default .modal-body').html(response);
				// Show the modal
				$('#modal-default').modal('show');
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});
	});

	$(".addUser").on("click", function(){
		openModalWithDynamicTitle($(this).data('modal-title'));
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('home/add_user'); ?>',
			success: function(response) {
				// Handle the AJAX response here if needed
				$('#modal-default .modal-body').html(response);
				// Show the modal
				$('#modal-default').modal('show');
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});
	});

	$(".viewMore").on("click", function(){
		openModalWithDynamicTitle2($(this).data('modal-title'));
		var dataID = $(this).attr("data-id");
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('task/file_details'); ?>',
			data: { dataID: dataID },
			success: function(response) {
				// Handle the AJAX response here if needed
				$('#modal-fs .modal-body').html(response);
				// Show the modal
				$('#modal-fs').modal('show');
				console.log('<?php echo base_url('task/file_details'); ?>');

			},
			error: function(xhr, status, error) {
				console.error(error);
				console.log('<?php echo base_url('task/file_details'); ?>');

			}
		});
	});

	$(".editFile").on("click", function () {
		event.preventDefault();	
		openModalWithDynamicTitle3($(this).data('modal-title'));
       		var file_ID = $(this).data("id");
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('home/do_edit'); ?>',
			data: { file_ID: file_ID },
			success: function (response) {
				// Handle the AJAX response here if needed
				$('#editModal .modal-body').html(response);
				// Show the modal
				$('#editModal').modal('show');
			},
			error: function (xhr, status, error) {
				console.error(error);
			}
		});
	});

	// User Status Slider
	$('.status-slider').change(function() {
		var userId = $(this).closest('tr').find('.user-id').text();
		var newStatus = this.checked ? 'Active' : 'Inactive';

		$.ajax({
		type: 'POST',
		url: '<?php echo site_url('task/update_status'); ?>',
		data: {
			userId: userId,
			newStatus: newStatus
		},
		success: function(response) {
			// Handle success, if needed
			console.log(response);
		},
		error: function(xhr, status, error) {
			// Handle error, if needed
			console.error(error);
		}
		});
	});

	// User Type Slider
	$('.type-dropdown').change(function() {
		var userId = $(this).data('user-id');
		var newType = $(this).val();

		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('task/update_usertype'); ?>',
			data: {
				userId: userId,
				newType: newType
			},
			success: function(response) {
				// Handle success, if needed
				console.log(response);
			},
			error: function(xhr, status, error) {
				// Handle error, if needed
				console.error(error);
			}
		});
	});

	// Attach an event listener to the dropdown menus
	$('.office-dropdown').change(function() {
		var userId = $(this).data('user-id');
		var newOffice = $(this).val();

		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('task/update_office'); ?>',
			data: {
				userId: userId,
				newOffice: newOffice
			},
			success: function(response) {
				// Handle success, if needed
				console.log(response);
			},
			error: function(xhr, status, error) {
				// Handle error, if needed
				console.error(error);
			}
		});
	});

</script>