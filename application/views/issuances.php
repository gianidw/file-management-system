<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
	var selectedID = null;
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
	table {
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even) {
		background-color: #dddddd;
	}

	.a {
		width:300px;
		text-align: center;
		vertical-align: middle;
		line-height: 25px;
	}

	.b {
		width:150px;
		text-align: center;
		vertical-align: middle;
		line-height: 25px;
	}
	/* .c {
		width:70px;
		border:none;
		cursor: pointer;
		display: inline-block;
	} */
	.d {
		white-space: normal;
		overflow:hidden;
		vertical-align:middle;
		text-overflow: ellipsis;
		line-height: 25px;
	}
	.d:hover{
		overflow: visible;
		overflow-block: clip; 
		white-space: normal; 
		width: auto;
		background-color:#FFFFFF;
	}
	.d:hover+td{
		margin-top:50px;
		margin-left: 150px;
	}
	td{
		line-height: 50px;
	}
	.regbutton{
		margin-top:5px;
		margin-bottom:5px;
	}
	thead th{
		padding: 10px !important;
		height: 5px;
	}	
</style>
<div class="container" style="position: absolute; top: 10; right: 0; width: 270px; border:5px;">
        <input id="myInput" type="search" placeholder="Search..">
<br><br>
</div>
<div class="container"><br><br></div>

<table class="table table-bordered table-striped table-hover table-sm">
	<thead class="bg-light sticky-top top-0">
		<tr>
			<th class="a" style="width:80%">Title</th>
			<th class="b">Options</th>
		</tr>
	</thead>
	<tbody id="myTable">
		<?php
			// Function to compare dates for sorting
			function compareDates($a, $b)
			{
			return strtotime($b['file_date_created']) - strtotime($a['file_date_created']);
			}

			// Sort the table data array by date posted
			usort($issuanceData, 'compareDates');

			foreach($issuanceData as $rows => $cols)
			{
				if($cols['isExclusive'] == 'No'){
					$data_ID = $cols['file_ID'];
					$formattedDate = date('F dS, Y', strtotime($cols['file_date_created']));
					echo '
					<tr>
						<td>
							<h4 style="margin-top:5px; margin-left:15px; margin-bottom:-10px;">'.$cols['file_title'].'</h4>
							<hr style="width:30%; align-left; margin-left:15px; margin-bottom:0px;">
							<small style="margin-left:15px;">'.$cols['file_originating_office'].'</small>';
							if(!empty($cols['file_originating_office'])){
								echo '<span> |</span>';
							}
							else{};
							echo '
							<small>'.$formattedDate.'</small>
						</td>
						<td class="b">
							<button class="btn btn-secondary viewMore regbutton" type="button" title="View Details" data-bs-toggle="modal" data-bs-target="#modal-fs" data-id="'.$cols['file_ID'].'" data-modal-title="File Info" onclick="viewFile(\''.$cols['file_name'].'\', event)">
								<i class="fa-solid fa-magnifying-glass"></i> View Details
							</button><br>';
							
							if(@$_SESSION['user_type'] == "Admin"){
								echo '
								<button class="btn btn-info editFile" style="width:40%" type="button" data-bs-toggle="modal" data-bs-target="#editModal" title="Edit Entry" data-id="'.$data_ID.'" data-modal-title="Edit File"><i class="fa-solid fa-pen-to-square"></i> EDIT</button>
								<button class="btn btn-danger" style="width:40%" type="button" title="Delete Entry" onclick="javascript:window.location.href=\''.base_url('task/delete/').$data_ID.'/'.$cols['file_name'].'\'"><i class="fa-solid fa-trash"></i> DELETE</button>
								';
							}
							else {
								echo '</td>';
							}'
						</td>
					</tr>
					';
				}
			}
			
		?>
	</tbody>
</table>






<script type="text/javascript">
	function openModalWithDynamicTitle3(title) {
            $('#editModalTitle').text(title);
            $('#editModal').modal('show');
        }
	function openModalWithDynamicTitle2(title) {
            $('#staticBackdropLabel2').text(title);
            $('#modal-fs').modal('show');
        }

	$(".viewMore").on("click", function(){
		openModalWithDynamicTitle2($(this).data('modal-title'));
		file_ID = $(this).attr("data-id");
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
	
</script>