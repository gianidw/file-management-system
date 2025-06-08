<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();

$admincheck = $this->session->flashdata('admincheck');
$logcheck = $this->session->flashdata('logcheck');
$logout = $this->session->flashdata('logout');
// echo $logout;
if($admincheck == 1){
	?>
	<script>
		$(document).ready(function(){
			toastr.error('Access Denied! ダメですよ！')
		})
	</script>
	<?php
}
if($logcheck == 1){
	?>
	<script>
		$(document).ready(function(){
			toastr.success('Logged-in!')
		})
	</script>
	<?php
}
if($logout == 1){
    ?>
    <script>
        $(doctument).ready(function(){
            toastr.success('You logged out!')
        })
    </script>
    <?php
}


function compareEvents($a, $b) 
{
        return strtotime($a['event_Start']) - strtotime($b['event_Start']);
};
$currentEvents = [];
$pastEvents = [];

$currentTimestamp = time(); // Current timestamp
$currentDate = date('Y-m-d', $currentTimestamp); // Current date

foreach ($eventData as $event) {
    if($event['isExclusive'] == 'No'){
        $eventEndTime = strtotime($event['event_End']);
        $eventEndDate = date('Y-m-d', $eventEndTime);

        if ($eventEndTime >= $currentTimestamp || $eventEndDate == $currentDate) {
            $currentEvents[] = $event;
        } else {
            $pastEvents[] = $event;
        }
    }
}
?>

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

        <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner" style="border-radius: 15px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.15);">
                <div class="carousel-item active">
                    <!-- <svg class="/intra/assets/philhealth-header.png" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
                    <img src="/intra/assets/philhealth-28.jpg" width="100%" height="200px" style="background-repeat: no-repeat; background-size: stretch" />
                    <div class="container">
                        <!-- <div class="carousel-caption text-start">
                            <h1>Example headline.</h1>
                            <p>Some representative placeholder content for the first slide of the carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                        </div> -->
            
                    </div>
                </div>

                <div class="carousel-item">
                    <!-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
                    <img src="/intra/assets/philhealth-studies.jpg" width="100%" height="200px" style="background-repeat: no-repeat; background-size: stretch" />
                    <div class="container">
                        <!-- <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Some representative placeholder content for the second slide of the carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                        </div> -->
                    </div>
                </div>

                <div class="carousel-item">
                    <!-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
                    <img src="/intra/assets/philhealth-konsulta.jpg" width="100%" height="200px" style="background-repeat: no-repeat; background-size: stretch" />
                    <div class="container">
                        <!-- <div class="carousel-caption text-end">
                            <h1>One more for good measure.</h1>
                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                        </div> -->
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <!-- ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4" style="grid-row: span 2;">
                    <table class="table table-hover table-sm caption-top">
                        <caption style="font-size:16px">Advisories</caption>
                        <thead class="bg-light top-0">
                                
                        </thead>
                        <tbody id="myTable" class="table-group-divider">
                            <?php
                            // Function to compare dates for sorting
                            function compareDates($a, $b)
                            {
                                return strtotime($b['file_date_created']) - strtotime($a['file_date_created']);
                            }

                            // Sort the table data array by date posted
                            usort($tableData, 'compareDates');

                            // Define the row limit you want to display
                            $rowLimit = 5;

                            // Define the filter condition
                            $filterCategory = "PhilHealth Advisory";

                            // Generate the limited rows in the table
                            $counter = 0;

                            foreach($tableData as $rows => $cols)
                            {
                                if ($cols['file_category'] === $filterCategory && $cols['isExclusive'] == 'No') {
                                    // Format the date to mm-dd-yyyy
                                    $formattedDate = date('m-d-Y', strtotime($cols['file_date_created']));
                                    
                                    // Remove the last 4 characters from the file_name
                                    $trimmedFileName = substr($cols['file_name'], 0, -4);

                                    echo '
                                    <tr>                                        
                                        <td class="b">
                                            <a>'.$trimmedFileName.'</a>
                                        </td>

                                        <td class="d">
                                            <a>'.$cols['file_title'].'
                                        </td>                                

                                        <td class="d" style="text-align: center;">
                                            <a>'.$formattedDate.'
                                        </td>

                                        <td class="a">
                                            <button class="btn btn-secondary viewMore" type="button" title="View Details" data-bs-target="#modal-fs" data-bs-toggle="modal" data-id="'.$cols['file_ID'].'" data-modal-title="File Info" onclick="viewFile(\''.$cols['file_name'].'\', event)"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </td>
                                    </tr>
                                    ';
                                    $counter++;
                                    if ($counter >= $rowLimit) {
                                        break; // Exit the loop once we reach the row limit
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="col-lg-8">
                    <table class="table table-hover table-sm caption-top" style="margin-top: 12px">
                            <!-- <caption style="font-size:16px">Current & Upcoming Events</caption> -->
                            <thead class="bg-light top-0">
                                    <tr>
                                            <td class="b" style="text-align: center; width:80%;">
                                                    <a> Current & Upcoming Events </a>
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
                            $rowLimit = 5;

                            while (count($currentEvents) < $rowLimit) {
                                $currentEvents[] = array(); // Add an empty entry to fill up
                            }
                            // Generate the limited rows in the table
                            $counter = 0;

                            foreach($currentEvents as $rows => $cols)
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
                                        $formattedStartDate = date('m-d-Y', strtotime($cols['event_Start']));
                                        $formattedEndDate = date('m-d-Y', strtotime($cols['event_End']));
                                    }
                                    echo '
                                    <tr style="height: 46px;">     
                                            <td class="d">
                                            <a>'.$cols['file_title'].'
                                            </td>                                

                                            <td class="d" style="text-align: center">
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
            </div>
            
            <div class="row">
                <div class="col-lg-4">
                    <table class="table table-hover table-sm caption-top">
                        <caption style="font-size:16px">Corporate Orders</caption>
                        <thead class="bg-light top-0">
                                
                        </thead>
                        <tbody id="myTable" class="table-group-divider">
                            <?php

                            // Sort the table data array by date posted
                            usort($tableData, 'compareDates');

                            // Define the row limit you want to display
                            $rowLimit = 5;

                            // Define the filter condition
                            $filterCategory = "Corporate Order (CO)";

                            // Generate the limited rows in the table
                            $counter = 0;

                            foreach($tableData as $rows => $cols)
                            {
                                if ($cols['file_category'] === $filterCategory && $cols['isExclusive'] == 'No') {
                                    // Format the date to mm-dd-yyyy
                                    $formattedDate = date('m-d-Y', strtotime($cols['file_date_created']));
                                    
                                    // Remove the last 4 characters from the file_name
                                    $trimmedFileName = substr($cols['file_name'], 0, -4);

                                    echo '
                                    <tr>                                        
                                        <td class="b">
                                            <a>'.$trimmedFileName.'</a>
                                        </td>

                                        <td class="d">
                                            <a>'.$cols['file_title'].'
                                        </td>                                

                                        <td class="d" style="text-align: center;">
                                            <a>'.$formattedDate.'
                                        </td>

                                        <td class="a">
                                            <button class="btn btn-secondary viewMore" type="button" title="View Details" data-bs-target="#modal-fs" data-bs-toggle="modal" data-id="'.$cols['file_ID'].'" data-modal-title="File Info" onclick="viewFile(\''.$cols['file_name'].'\', event)"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </td>
                                    </tr>
                                    ';
                                    $counter++;
                                    if ($counter >= $rowLimit) {
                                        break; // Exit the loop once we reach the row limit
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-4">
                    <table class="table table-hover table-sm caption-top">
                        <caption style="font-size:16px">Corporate Personnel Orders</caption>
                        <thead class="bg-light top-0">
                                
                        </thead>
                        <tbody id="myTable" class="table-group-divider">
                            <?php

                            // Sort the table data array by date posted
                            usort($tableData, 'compareDates');

                            // Define the row limit you want to display
                            $rowLimit = 5;

                            // Define the filter condition
                            $filterCategory = "Corporate Personnel Order (CPO)";

                            // Generate the limited rows in the table
                            $counter = 0;

                            foreach($tableData as $rows => $cols)
                            {
                                if ($cols['file_category'] === $filterCategory && $cols['isExclusive'] == 'No') {
                                    // Format the date to mm-dd-yyyy
                                    $formattedDate = date('m-d-Y', strtotime($cols['file_date_created']));
                                    
                                    // Remove the last 4 characters from the file_name
                                    $trimmedFileName = substr($cols['file_name'], 0, -4);

                                    echo '
                                    <tr>                                        
                                        <td class="b">
                                            <a>'.$trimmedFileName.'</a>
                                        </td>

                                        <td class="d">
                                            <a>'.$cols['file_title'].'
                                        </td>                                

                                        <td class="d" style="text-align: center;">
                                            <a>'.$formattedDate.'
                                        </td>

                                        <td class="a">
                                            <button class="btn btn-secondary viewMore" type="button" title="View Details" data-bs-target="#modal-fs" data-bs-toggle="modal" data-id="'.$cols['file_ID'].'" data-modal-title="File Info" onclick="viewFile(\''.$cols['file_name'].'\', event)"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </td>
                                    </tr>
                                    ';
                                    $counter++;
                                    if ($counter >= $rowLimit) {
                                        break; // Exit the loop once we reach the row limit
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="col-lg-4">
                    <table class="table table-hover table-sm caption-top">
                        <caption style="font-size:16px">Corporate Memorandums</caption>
                        <thead class="bg-light top-0">
                                
                        </thead>
                        <tbody id="myTable" class="table-group-divider">
                            <?php

                            // Sort the table data array by date posted
                            usort($tableData, 'compareDates');

                            // Define the row limit you want to display
                            $rowLimit = 5;

                            // Define the filter condition
                            $filterCategory = "Corporate Memorandum (CM)";

                            // Generate the limited rows in the table
                            $counter = 0;

                            foreach($tableData as $rows => $cols)
                            {
                                if ($cols['file_category'] === $filterCategory && $cols['isExclusive'] == 'No') {
                                    // Format the date to mm-dd-yyyy
                                    $formattedDate = date('m-d-Y', strtotime($cols['file_date_created']));
                                    
                                    // Remove the last 4 characters from the file_name
                                    $trimmedFileName = substr($cols['file_name'], 0, -4);

                                    echo '
                                    <tr>                                        
                                        <td class="b">
                                            <a>'.$trimmedFileName.'</a>
                                        </td>

                                        <td class="d">
                                            <a>'.$cols['file_title'].'
                                        </td>                                

                                        <td class="d" style="text-align: center;">
                                            <a>'.$formattedDate.'
                                        </td>

                                        <td class="a">
                                            <button class="btn btn-secondary viewMore" type="button" title="View Details" data-bs-target="#modal-fs" data-bs-toggle="modal" data-id="'.$cols['file_ID'].'" data-modal-title="File Info" onclick="viewFile(\''.$cols['file_name'].'\', event)"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </td>
                                    </tr>
                                    ';
                                    $counter++;
                                    if ($counter >= $rowLimit) {
                                        break; // Exit the loop once we reach the row limit
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">LIST OF ACCREDITED COLLECTING AGENTS OF PHILHEALTH <span class="text-body-secondary"></span></h2>
                    <!-- <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p> -->
                </div>

                <div class="col-md-5">
                    <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text></svg> -->
                    <a href="https://www.philhealth.gov.ph/advisories/2023/adv2023-0019.pdf" target=_blank><img src="/intra/assets/philhealth-payment.jpg" width="90%" height="200px" style="background-repeat: no-repeat; background-size: stretch" /></a>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">Cervical Cancer coverage:<span class="text-body-secondary"></span></h2>
                    <p class="lead">A top priority of PhilHealth in Universal Health Care</p>
                </div>

                <div class="col-md-5 order-md-1">
                    <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text></svg> -->
                    <a href="https://www.philhealth.gov.ph/news/2023/cervical_coverage.pdf" target=_blank><img src="/intra/assets/philhealth-cc.jpg" width="90%" height="200px" style="background-repeat: no-repeat; background-size: stretch" /></a>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">PhilHealth increases yearly dialysis coverage to 156 sessions<span class="text-body-secondary"></span></h2>
                    <p class="lead">n PhilHealth Circular 2023-0009 entitled “Institutionalization of 156 hemodialysis sessions” which takes effect today, June 22, 2023.</p>
                </div>
                
                <div class="col-md-5">
                    <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text></svg> -->
                    <a href="https://www.philhealth.gov.ph/news/2023/dialysis_coverage.pdf" target=_blank><img src="/intra/assets/philhealth-dialysis.PNG" width="90%" height="200px" style="background-repeat: no-repeat; background-size: stretch" /></a>
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


<script>
    function openModalWithDynamicTitle2(title) {
            $('#staticBackdropLabel2').text(title);
            $('#modal-fs').modal('show');
    }

	$(document).ready(function(){
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

        
	});
</script>