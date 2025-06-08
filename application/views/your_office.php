<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();

$yourOffice = $CI->get_office();

// Function to compare dates for sorting
function compareDates($a, $b)
{
        return strtotime($b['file_date_created']) - strtotime($a['file_date_created']);
}
function compareEvents($a, $b) 
{
        return strtotime($a['event_Start']) - strtotime($b['event_Start']);
};
function compareEventsEnd($a, $b) 
{
        return strtotime($b['event_End']) - strtotime($a['event_End']);
};

$currentEvents = [];
$pastEvents = [];

$currentTimestamp = time(); // Current timestamp
$currentDate = date('Y-m-d', $currentTimestamp); // Current date

foreach ($eventData as $event) {
    if($event['isExclusive'] == 'Yes'){
        $eventEndTime = strtotime($event['event_End']);
        $eventEndDate = date('Y-m-d', $eventEndTime);

        if ($eventEndTime >= $currentTimestamp || $eventEndDate == $currentDate) {
            $currentEvents[] = $event;
        } 
        else {
            $pastEvents[] = $event;
        }
    }
}
?>

<script>
	// Javascript for Quick Search Bar
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

<!doctype html>
<html lang="en" data-bs-theme="auto">
    <style>
        table{
            font-size: 13px;
            box-shadow: 5px 15px 20px rgba(0, 0, 0, 0.15);
            /* table-layout: fixed; */
        }
        
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }
        .bd-mode-toggle {
            z-index: 1500;
        }

        

        tr:nth-child(even) {
            background-color: #eee;
        }

        .a {
            text-align: center;
            vertical-align: middle;
            width: 15%;
        }
        .b {
            max-width: 100px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            vertical-align:middle;
        }
        .b:hover{
            overflow: visible; 
            white-space: normal; 
            width: auto;
            background-color:#FFFFFF;
        }
        .c {
            width:150px;
            text-align: center;
            vertical-align: middle;
            line-height: 25px;
        }
        .d {
            max-width: 200px;
            overflow:hidden;
            white-space:nowrap;
            text-overflow: ellipsis;
            vertical-align:middle;
        }
        .d:hover{
            overflow: visible; 
            white-space: normal; 
            width: auto;
            background-color:#FFFFFF;
        }
        .e {
            width: 150px;
            white-space: normal; /* Keep it as 'normal' to allow text wrapping */
            overflow: hidden; /* Hide overflowing content */
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Set the number of lines to be shown */
            -webkit-box-orient: vertical;
            vertical-align: middle;
            line-height: 25px;
        }
        .center{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 20%;
        }
        /* .icon{
            width: 30px;
            height: 30px;
        } */
        thead th{
            padding: 10px !important;
            height: 5px;
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

        .regbutton{
            margin-top:5px;
            margin-bottom:5px;
        }

    </style>

        <!-- Custom styles for this template -->
        
    </head>
    
    <body>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check2" viewBox="0 0 16 16">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
            </symbol>
            <symbol id="circle-half" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
            </symbol>
            <symbol id="moon-stars-fill" viewBox="0 0 16 16">
                <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
            </symbol>
            <symbol id="sun-fill" viewBox="0 0 16 16">
                <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
            </symbol>
        </svg>

        
        


    <main>
        <!-- CAROUSEL -->
        

        <!-- BUTTONS -->
        <div style="text-align: right;">
                <input id="myInput" type="search" placeholder="Search Users"></input>
        </div>
        <?php if($_SESSION['user_type'] == 'Office Admin'){ ?>
        <div class="container-fluid">
            <div class="button-container">
                <button type="button" class="btn btn-primary uploadFile" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-default" data-modal-title="Upload File">
                    <i class="fa-solid fa-plus"></i> Upload File
                </button>

                <button type="button" class="btn btn-primary uploadBulk" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-default" data-modal-title="Upload Multiple Files">
                    <i class="fa-solid fa-plus"></i> Bulk Upload
                </button>
            </div>            
        </div>
        <?php }?>

        <!-- TABS -->
        <br>
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'files_list')" id="defaultOpen"><?php echo $yourOffice.' FILES'?></button>
            <button class="tablinks" onclick="openTab(event, 'events_list')" id="defaultOpen"><?php echo $yourOffice.' EVENTS'?></button>
            <button class="tablinks" onclick="openTab(event, 'users_list')" id="defaultOpen"><?php echo $yourOffice.' USERS'?></button>
        </div>


        <!-- TABS -->
        <div id="files_list" class="tabcontent">
            <table id="files_list" class="table table-bordered table-striped table-hover table-sm" style="table-layout:fixed;">
            <thead class="bg-light sticky-top top-0">
                <tr>
                    <th class="a" style="width:80%">Title</th>
                    <th class="a">Options</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                    // Sort the table data array by date posted
                    usort($tableData2, 'compareDates');

                    foreach($tableData2 as $rows => $cols)
                    {
                            if($cols['file_originating_office'] == $_SESSION['user_office'] && $cols['isExclusive'] == 'Yes'){
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
                                    <td class="a">
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
        </div>

        <div id="users_list" class="tabcontent">
            <table id="user_list" class="table table-bordered table-striped table-hover table-sm table-responsive caption-top" style="border:thin; table-layout:fixed;">
                <thead class="bg-light top-0">
                    <tr>
                        <th class="c">Name</th>
                        <th class="c">Email</th>
                        <th class="c">Status</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php
                    {
                        foreach($tableData1 as $rows => $cols)
                        if($cols['user_office'] == $_SESSION['user_office']){

                            // Determine the initial toggle state
                            $isAdmin = $cols['user_type'] == 'Admin' ? 'checked' : '';
                            $isChecked = $cols['user_status'] == 'Active' ? 'checked' : '';
                            
                            echo '
                            <tr>
                               
                                <td class="c"><a>'.$cols['user_name'].'</a></td>                                
                                <td class="c"><a>'.$cols['user_email'].'</a></td>
                                <td class="c">
                                    <span class="c text-muted">Inactive</span>
                                    <label class="switch">
                                        <input type="checkbox" disabled class="status-slider" ' . $isChecked . '>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="c">Active</span>
                                </td>
                            </tr>';

                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="events_list" class="tabcontent">
            <div class="col-lg">                          
                <table class="table table-hover table-sm caption-top">
                    <caption style="font-size:16px">Upcoming Events</caption>
                    <thead class="bg-light top-0">
                            <tr>
                                    <td class="b" style="text-align: center; width:80%;">
                                            <a> Event Name </a>
                                    </td>
                                    <td class="b" style="text-align: center;">
                                            <a> Event Duration </a>
                                    </td>
                                    <td></td>
                            </tr>
                    </thead>
                    <tbody id="myTable" class="table-group-divider">
                    <?php

                    // Sort the table data array by date posted
                    usort($currentEvents, 'compareEvents');

                    // Define the row limit you want to display
                    $rowLimit = 3;

                    while (count($currentEvents) < $rowLimit) {
                            $currentEvents[] = array(); // Add an empty entry to fill up
                    }
                    // Generate the limited rows in the table
                    $counter = 0;

                    foreach($currentEvents as $rows => $cols)
                    {

                            if (empty($cols)) {
                                    $trimmedFileName = "";
                                    $formattedStartDate = "";
                                    $formattedEndDate = "";
                                    $cols['file_title'] = "";
                                    $cols['file_ID'] = NULL;
                            } 
                            else 
                            {
                                    // Format the date to mm-dd-yyyy
                                    $formattedStartDate = date('m-d-Y', strtotime($cols['event_Start']));
                                    $formattedEndDate = date('m-d-Y', strtotime($cols['event_End']));
                            }
                            echo '
                            <tr style="height: 46px;">
                                    <td class="d">
                                    <a>'.$cols['file_title'].'
                                    </td>                                

                                    <td class="a" style="text-align: center">
                                    <a>'.$formattedStartDate . ' - ' . $formattedEndDate.'
                                    </td>

                                    <td class="a">';
                                    if (!empty($cols['file_ID'])) {
                                            echo '<button class="btn btn-secondary viewMore" type="button" title="View Details" data-bs-target="#modal-fs" data-bs-toggle="modal" data-id="'.$cols['file_ID'].'" data-modal-title="File Info" onclick="viewFile(\''.$cols['file_name'].'\', event)"><i class="fa-solid fa-magnifying-glass"></i></button>';
                                    }
                                    echo '</td>
                            </tr>
                            ';
                            $counter++;
                            if ($counter >= $rowLimit) {
                                    break; // Exit the loop once we reach the row limit
                            }
                            
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="col-lg">                        
                <table class="table table-hover table-sm caption-top">
                    <caption style="font-size:16px">Past Events</caption>
                    <thead class="bg-light top-0">
                            <tr>
                                    <td class="b" style="text-align: center; width:80%;">
                                            <a> Event Name </a>
                                    </td>
                                    <td class="b" style="text-align: center;">
                                            <a> Event End </a>
                                    </td>
                                    <td></td>
                            </tr>
                    </thead>
                    <tbody id="myTable" class="table-group-divider">
                    <?php

                    // Sort the table data array by date posted
                    usort($pastEvents, 'compareEventsEnd');

                    // Define the row limit you want to display
                    $rowLimit = 5;

                    while (count($pastEvents) < $rowLimit) {
                            $pastEvents[] = array(); // Add an empty entry to fill up
                    }
                    // Generate the limited rows in the table
                    $counter = 0;

                    // Generate the limited rows in the table
                    $counter = 0;

                    foreach($pastEvents as $rows => $cols)
                    {
                            if (empty($cols)) {
                                    $formattedStartDate = "";
                                    $formattedEndDate = "";
                                    $cols['file_title'] = "";
                                    $cols['file_ID'] = NULL;
                            } 
                            else 
                            {
                                    // Format the date to mm-dd-yyyy
                                    $formattedEndDate = date('m-d-Y', strtotime($cols['event_End']));
                            }
                            echo '
                            <tr style="height: 46px;">
                                    <td class="d">
                                    <a>'.$cols['file_title'].'
                                    </td>                                

                                    <td class="a" style="text-align: center;">
                                    <a>'.$formattedEndDate.'
                                    </td>

                                    <td class="a">';
                                    if (!empty($cols['file_ID'])) {
                                            echo '<button class="btn btn-secondary viewMore" type="button" title="View Details" data-bs-target="#modal-fs" data-bs-toggle="modal" data-id="'.$cols['file_ID'].'" data-modal-title="File Info" onclick="viewFile(\''.$cols['file_name'].'\', event)"><i class="fa-solid fa-magnifying-glass"></i></button>';
                                    }
                                    echo '</td>
                            </tr>
                            ';
                            $counter++;
                            if ($counter >= $rowLimit) {
                                    break; // Exit the loop once we reach the row limit
                            }
                            
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ================================================== -->


<script>
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
</script>