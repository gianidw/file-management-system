<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();

//Sets Current Date&Time
$date = new DateTime();
$day = $date->format('d');
$month = $date->format('m');
$year = $date->format('Y');
$time = $date->format('H:i:s');
$today = $year . "-" . $month . "-" . $day . " " . $time;
$today1 = @$FormData['file_date_created'];
$fileWhole = @$FormData['file_name'];
?>

<style>

	label{
		display:inline-block;
		width:130px;
	}
	.label{
		display:inline-block;
		width:130px;
	}
	.a {
		text-align: center;
		vertical-align: middle;

	}

	.b {
		width:150px;
		text-align: center;
		vertical-align: middle;

	}
	.c {
		width:70px;
		border:none;
		cursor: pointer;
		display: inline-block;"
	}
	.d {
		width:150px;
	}
	.e {
		padding: 10px 10px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
	}
	.inputbx{
		display:inline-block;
		width:250px;
	}
	.txtbx{
		display:inline-block;
		width:350px;
		height:100px;
	}
</style>

<form action="<?php echo base_url('task/upload/')?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="file_ID" value="<?php echo @$FormData['file_ID']; ?>">
	
	<div class="container">
		<label for="file">File:</label>
		<input class="inputbx" type="text" name="file" id="file" value="<?php echo $fileWhole;?>" readonly></input>
	</div>


	<br>
	<div class="container">
		<label for="title">File Title:</label>
		<input class="inputbx" type="text" name="title" id="title" value="<?php echo @$FormData['file_title']; ?>" autofocus>
<!-- 		<span style="color:red">* <?php echo @$titleError;?></span>
 -->	</div>

	<br>
	<div class="container">
		<label for="position">Position:</label>
		<select class="form-select form-select-sm inputbx" aria-label="Position" name="position" id="position">
			<option selected value='<?php echo @$FormData['file_position']; ?>'><?php echo @$FormData['file_position']; ?></option>
			<option value="ISA II">ISA II</option>
			<option value="ISA III">ISA III</option>
			<option value="ITO II">ITO II</option>
			<option value="ITO III">ITO III</option>
		</select>
<!-- 		<span style="color:red">* <?php echo @$positionError;?></span>
 -->	</div>
	
	<br>
	<div class="container">
		<label for="office">Originating Office:</label>
		<select class="form-select form-select-sm inputbx" aria-label="Office" name="office" id="office">
			<option selected value='<?php echo @$FormData['file_originating_office']; ?>'><?php echo @$FormData['file_originating_office']; ?></option>
			<option value="Office of the President and Chief Executive Officer">Office of the President and Chief Executive Officer</option>
			<option value="Office of the Chief Information Officer / Information Management Sector">Office of the Chief Information Officer / Information Management Sector</option>
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
<!-- 		<span style="color:red">* <?php echo @$officeError;?></span>
 -->	</div>

	<br>
	<div class="container">
		<label for="team">Originating Team:</label>
		<select class="form-select form-select-sm inputbx" aria-label="Team" name="team" id="team">
			<option selected value='<?php echo @$FormData['file_originating_team']; ?>'><?php echo @$FormData['file_originating_team']; ?></option>
			<option value="NHDR">NHDR</option>
			<option value="-1-">-1-</option>
			<option value="-2-">-2-</option>
			<option value="-3-">-3-</option>
		</select>
	</div>

	<br>
	<div class="container">
		<label for="category">File Category:</label>
		<select class="form-select form-select-sm inputbx" aria-label="Category" name="category" id="category">
			<option selected value='<?php echo @$FormData['file_category']; ?>'><?php echo @$FormData['file_category']; ?></option>
			<option value="Corporate Order (CO)">Corporate Order (CO)</option>
			<option value="Corporate Personnel Order (CPO)">Corporate Personnel Order (CPO)</option>
			<option value="Standard Operating Procedure (SOP)">Standard Operating Procedure (SOP)</option>
			<option value="Work Instruction (WIns)">Work Instruction (WIns)</option>
			<option value="Corporate Memorandum (CM)">Corporate Memorandum</option>
			<option value="PhilHealth Circular">PhilHealth Circular</option>
			<option value="PhilHealth Advisory">PhilHealth Advisory</option>

		</select>
<!-- 		<span style="color:red">* <?php echo @$categoryError;?></span>
 -->	</div>

	<br>
	<div class="container" style="display: flex; align-items: center;"">
		<label style="margin-right: 10px;">Is this file just for your office?</label>
		<input type="radio" id="isExclusiveYes" name="isExclusive" style="margin-right: 5px;" value="Yes" <?php echo (@$FormData['isExclusive'] === 'Yes') ? 'checked' : ''; ?>>
		<label for="isExclusiveYes">Yes</label>
		<input type="radio" id="isExclusiveNo" name="isExclusive" style="margin-right: 5px;" value="No" <?php echo (@$FormData['isExclusive'] === 'No') ? 'checked' : ''; ?>>
		<label for="isExclusiveNo">No</label>
	</div>

 	<br>
	<div class="container" style="display: flex; align-items: center;"">
		<label style="margin-right: 10px;">Is Event:</label>
		<input type="radio" id="isEventYes" name="isEvent" style="margin-right: 5px;" value="Yes" <?php echo (@$FormData['isEvent'] === 'Yes') ? 'checked' : ''; ?>>
		<label for="isEventYes">Yes</label>
		<input type="radio" id="isEventNo" name="isEvent" style="margin-right: 5px;" value="No" <?php echo (@$FormData['isEvent'] === 'No') ? 'checked' : ''; ?>>
		<label for="isEventNo">No</label>
	</div>

	<br id="br1">
	<div class="container" id="eventStart">
		<label for="event_Start">Event Start Date:</label>
		<input class="inputbx" type="date" name="event_Start" id="event_Start" value="<?php echo @$FormData['event_Start']; ?>">
	</div>
	<br id="br2">
	<div class="container" id="eventEnd">
		<label for="event_End">Event End Date:</label>
		<input class="inputbx" type="date" name="event_End" id="event_End" value="<?php echo @$FormData['event_End']; ?>">
	</div>

	<br>
	<div class="container">
		<label for="details">Details:</label>
		<textarea class="txtbx" name="details" value="<?php echo @$FormData['file_details']; ?>"><?php echo @$FormData['file_details']; ?></textarea>
	</div>

	<br>
	<div class="container">
		<input class="inputbx" type="hidden" readonly name="created" value="<?php 
		if(isset($today1)){
			echo $today1;
		}
		else{
			echo $today;
		}  
		?>">
	</div>

	<div class="container">
		<input class="inputbx" type="hidden" name="updated" readonly value="<?php echo $today;?>">
	</div>



	<div class="container">
		<input class="btn btn-primary" type="submit">
		<button class="btn btn-secondary" type="button" onclick="javascript:window.location.href='<?php echo htmlspecialchars(base_url("home/admin_panel"));?>'">Cancel</button>
	</div>
</form>

<script>
	$(document).ready(function() {
		// Initially hide the datepicker
		$("#eventStart").hide();
		$("#eventEnd").hide();
		$("#br1").hide();
		$("#br2").hide();

		// When radio button is clicked
		$("input[name='isEvent']").change(function() {
			if ($(this).val() === "Yes") {
				$("#eventStart").show();
				$("#eventEnd").show();
				$("#br1").show();
				$("#br2").show();
		
			} else {
				$("#eventStart").hide();
				$("#eventEnd").hide();
				$("#br1").hide();
				$("#br2").hide();
		}
		});
	});
</script>