<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();

// Get the search term from $_POST
$searchTerm = isset($_POST['global-search']) ? $_POST['global-search'] : '';
// Filter the data based on the search term
$filteredData = array_filter($tableData, function ($row) use ($searchTerm) {
	return strpos(strtolower(implode(' ', $row)), strtolower($searchTerm)) !== false;
});

$filteredData = array_filter($tableData, function ($row) use ($searchTerm) {
	return strpos(strtolower(implode(' ', $row)), strtolower($searchTerm)) !== false && 
	(empty($row['isExclusive']) || strtolower($row['isExclusive']) !== 'yes');
});
    

?>

<!DOCTYPE html>
<html>
<head>
<script>
        $(document).ready(function(){
		function searchTable() {
			var value = $("#myInput").val().toLowerCase();
			if (value === "") {
				clearSearch();
			} 
			else {
				applyFilter(value);
			}

			// Send the search term to the PHP backend using AJAX
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('home/do_search'); ?>", // Replace with the actual path to your PHP file
				data: { "global-search": value },
				success: function(response) {
					// Update the table with the filtered data
					$("#myTable").html(response);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});
		}

		$("#myInput").on("input", searchTable);

		$("#myInput").on("search", function() {
			var value = $(this).val().toLowerCase();
			if (value === "") {
				clearSearch();
				// Trigger the searchTable function when the x button is clicked
				searchTable();
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
 	text-align: center;
	vertical-align: middle;
	width: 15%;

}
.b {
	width:150px;
	text-align: center;
	vertical-align: middle;
	line-height: 25px;
}
.c {
	width:150px;
	text-align: center;
	vertical-align: middle;
	line-height: 25px;
}
.d {
	white-space:nowrap;
	overflow:hidden;
	vertical-align:middle;
	line-height: 25px;
	text-overflow: ellipsis;
}
.d:hover{
	overflow: visible; 
	white-space: normal; 
	width: auto;
	position: absolute;
	background-color:#FFFFFF;
}
.d:hover+td{
	margin-top:50px;
	margin-left: 150px;
}
td{
	line-height: 50px;
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
.center{
	display: block;
	margin-left: auto;
	margin-right: auto;
	width: 20%;
}
.icon{
	width: 30px;
	height: 30px;
}
thead th{
	padding: 10px !important;
  	height: 5px;
}

</style>



<table class="table table-bordered table-striped table-hover table-sm" style="table-layout:fixed;">
	<thead class="bg-light top-0">
			<tr>
				<th class="b">Category</th>
				<th class="b">File</th>
				<th class="b">Details</th>
				<th class="b">Originating Office</th>
			</tr>
	</thead>
	<tbody id="myTable">
		<?php
			foreach($filteredData as $rows => $cols)
			{
				echo '
				<tr class="clickable" data-bs-toggle="modal" data-id='.$cols['file_ID'].' data-bs-target="#modal-fs" data-modal-title="File Info">
					<td class="b">
						<a>'.$cols['file_category'].'
					</td>

					<td class="d">	
						<a href="'.base_url().'assets/files/'.$cols['file_name'].'" target=_blank>
						'.$cols['file_name'].'
					</td>

					<td class="d">
						<a>'.$cols['file_details'].'
					</td>

					<td class="b">
						<a>'.$cols['file_originating_office'].'
					</td>
				</tr>
				';
			}
			
		?>
	</tbody>
</table>  


<script>

	$(document).ready(function(){
		$("th").click(function(){
		toastr.success('Nice!')
		});

		function openModalWithDynamicTitle2(title) {
			$('#staticBackdropLabel2').text(title);
			$('#modal-fs').modal('show');
		}

		$(".clickable").on("click", function(){
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
	});
</script>