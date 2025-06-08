<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
	@media print {
		.tedt{
			display: none;
		}
		.modal {
			overflow: hidden !important;
			overflow-y: hidden !important;
		}
		body{
			overflow: hidden !important;
			overflow-y: hidden !important;

		}
	}
	.a {
		text-align: center;
		vertical-align: middle;
		width: 5%;

	}

	.b {
		width:150px;
		text-align: center;
		vertical-align: middle;
		line-height: 25px;

	}
	.c {
		width:70px;
		border:none;
		cursor: pointer;
		display: inline-block;
	}
	.d {
		white-space:nowrap;
		overflow:hidden;
		vertical-align:middle;
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
	.f {
		width:70px;
		text-align: center;
		vertical-align: middle;
		line-height: 25px;

	}
	.regbutton{
		margin-top:5px;
		margin-bottom:5px;
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
</style>

<!-- <div class="container tedt" style="position: absolute; top: 10; right: 0; width: 270px; border:5px;">
        <input id="myInput1" type="search" placeholder="Search..">
</div> -->

<div>
	<button type="submit" id="print" class="btn btn-primary tedt" onclick="printPage()" style="width: 200px; margin-bottom:10px"><i class="fa-solid fa-print"></i>
		Print All
	</button>

	<button type="button" class="btn btn-primary tedt" id="print-selected" style="width: 200px; margin-bottom:10px">
		Print Selected
	</button>

	<button class="btn btn-primary tedt" type="button" style="width: 200px; margin-bottom:10px" onclick="javascript:window.location.href='<?php echo htmlspecialchars(base_url('home/DirectoryList	'));?>'"><i class="fa-solid fa-download"></i>
		Download All
	</button>
</div>

<div class="container "></div>

<div class="tab tedt">
	<button class="tablinks" onclick="openTab(event, 'tab-ALL')" id="defaultOpen">All</button>
	<button class="tablinks" onclick="openTab(event, 'tab-OP-CEO')">OP-CEO</button>
	<button class="tablinks" onclick="openTab(event, 'tab-OCOO')">OCOO</button>
	<button class="tablinks" onclick="openTab(event, 'tab-OCIO-IMS')">OCIO-IMS</button>
	<button class="tablinks" onclick="openTab(event, 'tab-Legal')">Legal</button>
	<button class="tablinks" onclick="openTab(event, 'tab-FMS')">FMS</button>
	<button class="tablinks" onclick="openTab(event, 'tab-MSS')">MSS</button>
	<button class="tablinks" onclick="openTab(event, 'tab-HFPS')">HFPS</button>
	<button class="tablinks" onclick="openTab(event, 'tab-ASRMS')">ASRMS</button>
	<button class="tablinks" onclick="openTab(event, 'tab-PRO')">PRO</button>
</div>

<div id="tab-container">

	<?php
	$tabFilters = array(
		'ALL' => 'All Offices',
		'OP-CEO' => 'Office of the President and Chief Executive Officer',
		'OCOO' => 'Chief Operating Officer',
		'OCIO-IMS' => 'Chief Information Officer, Information Management Sector',
		'Legal' => 'Legal Sector',
		'FMS' => 'Fund Management Sector',
		'MSS' => 'Management Services Sector',
		'HFPS' => 'Health Finance Policy Sector',
		'ASRMS' => 'Actuarial Services & Risk Management Sector',
		'PRO' => 'PhilHealth Regional Office'
	);

	foreach ($tabFilters as $tabId => $tabLabel) {
		echo '
		<div id="tab-' . $tabId . '" class="tabcontent">
			<table id="'.$tabId.'" class="table table-bordered table-striped table-hover table-sm table-responsive caption-top" style="border:thin; table-layout:fixed;">
				<caption class="tedt">'.$tabLabel.'</caption>
				<thead class="bg-light top-0">
					<tr>
						<th class="a tedt">
							<input type="checkbox" id="select-all-'.$tabId.'">
						</th>
						<th class="b">Office</th>
						<th class="b">Division</th>
						<th class="b">Contact No.</th>
						<th class="b">Local No.</th>
						<th class="f tedt"></th>
					</tr>
				</thead>

				<tbody id="myTable-'.$tabId.'">';
		
				foreach ($tableData as $rows => $cols) {
					if ($tabId === 'ALL' || $cols['dir_sector'] === $tabLabel) {
						echo '
						<tr>
							<td class="b tedt">
								<input type="checkbox" class="entry-checkbox tedt" name="counter[]" value="' . $cols["dir_id"] . '"></input>
							</td>
							<td class="b">
								<a>'.$cols['dir_office'].'</a>
							</td>
							<td class="b">
								<a>'.$cols['dir_team'].'</a>
							</td>
							<td class="b">
								<a>'.$cols['dir_contact'].'</a>
							</td>
							<td class="b">
								<a>'.$cols['dir_local'].'</a>
							</td>
							<td class="f tedt">
								<button class="btn btn-info regbutton viewPerson" type="button" title="View Entry" data-bs-toggle="modal" data-bs-target="#detailsModal" data-id="' . $cols['dir_id'] . '" data-modal-title="File Info">
									<i class="fa-solid fa-search"></i> View
								</button><br>';

							if (@$_SESSION['user_type'] == "Admin") {
							echo '
								<button class="btn btn-info" type="button" title="Edit Entry" onclick="javascript:window.location.href=\'' . base_url('home/editdir_form/') . $cols['dir_id'] . '\'"><i class="fa-solid fa-pen-to-square"></i></button>
								<button class="btn btn-danger" type="button" title="Delete Entry" onclick="javascript:window.location.href=\'' . base_url('home/deletedir_form/') . $cols['dir_id'] . '\'"><i class="fa-solid fa-trash"></i></button>
							';}
							else {
							echo '
								</td>';
							}
						echo '
							</td>
						</tr>';
					}
				}

				echo '</tbody>
			</table>
		</div>';
	}
	?>

	<div id="tab-ALL" class="tabcontent ">
		<table id="all" class="table table-bordered table-striped table-hover table-sm table-responsive caption-top" style="border:thin; table-layout:fixed;">
			<caption class="tedt">All Offices</caption>
			<thead class="bg-light top-0 ">
				<tr>
					<th class="a tedt">
						<input type="checkbox" id="select-all-<?php echo $tabId; ?>">
					</th>
					<th class="b">Office</th>
					<th class="b">Division</th>
					<th class="b">Contact No.</th>
					<th class="b">Local No.</th>
					<th class="f tedt"></th>
				</tr>	
		</thead>
		<tbody id="myTable1">
			<?php
				foreach($tableData as $rows => $cols)
				{
					echo '
					<tr>
						<td class="b tedt">
							<input type="checkbox" class="entry-checkbox tedt" name="counter[]" value="'.$cols["dir_id"].'"></input>
						</td>
						<td class="b">
							<a>'.$cols['dir_office'].'
						</td>
						<td class="b">
							<a>'.$cols['dir_team'].'
						</td>
						
						<td class="b">
							<a>'.$cols['dir_contact'].'
						</td>

						<td class="b">
							<a>'.$cols['dir_local'].'
						</td>
						<td class="f tedt">
							<button class="btn btn-info regbutton viewPerson" type="button" title="View Entry" data-bs-toggle="modal" data-bs-target="#detailsModal" data-id="'.$cols['dir_id'].'" data-modal-title="File Info">
								<i class="fa-solid fa-search"></i> View
							</button><br>
						';
						if($_SESSION['user_type'] == "Admin"){
							echo '
							<button class="btn btn-info" type="button" title="Edit Entry" onclick="javascript:window.location.href=\''.base_url('home/editdir_form/').$cols['dir_id'].'\'"><i class="fa-solid fa-pen-to-square"></i></button>
							<button class="btn btn-danger" type="button" title="Delete Entry" onclick="javascript:window.location.href=\''.base_url('home/deletedir_form/').$cols['dir_id'].'\'"><i class="fa-solid fa-trash"></i></button>
							';
						}
						else {
							echo '</td>';
						}'
						</td>
					</tr>
					';
					
				}
			?>
			</tbody>
		</table>
	</div>
</div>
		
<script type="text/javascript">
	function printPage() {
		window.print();
	}   

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

	function openModalWithDynamicTitle(title) {
            $('#staticBackdropLabel').text(title);
            $('#modal-default').modal('show');
        }
	
	$(".viewPerson").on("click", function(){
		openModalWithDynamicTitle($(this).data('modal-title'));
		dir_ID = $(this).attr("data-id");
		var dataID = $(this).attr("data-id");
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('task/person_details'); ?>',
			data: { dataID: dataID },
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

	document.getElementById("defaultOpen").click();
	
	$(document).ready(function() {
		// Initialize an object to store checkbox state for each tab
		var checkboxState = {};
		var selectAllState = {};

		// Function to handle tab switching
		function switchTab(tabId) {
			// Uncheck checkboxes in the previous tab
			var prevTabId = $('.tabcontent:visible').attr('id');
			checkboxState[prevTabId] = $('#' + prevTabId + ' .entry-checkbox:checked').map(function() {
				return $(this).val();
			}).get();
			selectAllState[prevTabId] = $('#select-all').prop('checked');

			$('#' + prevTabId + ' .entry-checkbox').prop('checked', false);
			$('#select-all').prop('checked', false);

			// Check checkboxes based on the stored state for the current tab
			if (checkboxState[tabId]) {
				$('#' + tabId + ' .entry-checkbox').each(function() {
					if (checkboxState[tabId].includes($(this).val())) {
						$(this).prop('checked', true);
					}
				});
				if (selectAllState[tabId]) {
					$('#select-all').prop('checked', true);
				}
			}
		}

		// Handle tab clicks
		$('.tablinks').click(function() {
			var tabId = $(this).attr('data-tab');
			switchTab(tabId);
		});

		// Updated select all checkboxes using event delegation
		$(document).on('change', '[id^="select-all-"]', function() {
			var tabId = $(this).attr('id').replace('select-all-', ''); // Extract the tab ID
			var selectedEntries = $('#' + tabId + ' .entry-checkbox:checked').map(function() {
				return $(this).val();
			}).get();

			// Update the checkbox state for the current tab
			checkboxState[tabId] = selectedEntries;
			selectAllState[tabId] = $(this).prop('checked');

			// Check/uncheck individual checkboxes
			$('#' + tabId + ' .entry-checkbox').prop('checked', $(this).prop('checked'));
		});

		// Print selected entries
		$('#print-selected').click(function() {
			var tabId = $('.tabcontent:visible').attr('id');
			var selectedEntries = $('#' + tabId + ' .entry-checkbox:checked').map(function() {
				return $(this).val();
			}).get();

			if (selectedEntries.length > 0) {
				// Send the selected entry IDs to the server using AJAX
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url('home/print_selected_entries'); ?>',
					data: { entries: selectedEntries },
					success: function(response) {						
						// Open a new window or iframe for printing
						var printWindow = window.open('', '', 'width=600,height=600,left=' + (screen.width / 2 - 300) + ',top=' + (screen.height / 2 - 300));
						printWindow.document.open();
						printWindow.document.write('<html><head><title>Selected Entries</title></head><body>');
						printWindow.document.write(response);
						printWindow.document.write('</body></html>');
						printWindow.document.close();

						// Trigger printing in the new window or iframe
						printWindow.print();
						printWindow.close();
					},
					error: function(xhr, status, error) {
						console.error(error);
					}
				});
			} 
			else {
				// No entries selected, show a message or handle accordingly
				alert('No entries selected for printing.');
			}
		});
	});
</script>