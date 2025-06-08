<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();

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
    <head>
        <style>
        table{
                font-size: 13px;
                box-shadow: 5px 15px 20px rgba(0, 0, 0, 0.15);
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
        
        thead th{
                padding: 10px !important;
                height: 5px;
        }
        .icon{
                width: 80px;
                height: 80px;
                object-fit: cover;
        }

        h1{ 
                font-size: clamp(20px, 3vw, 28px);
                margin: 0.67em;
                font-weight: bold;
                text-align: justify;
        }

        h1, h4, h5, h6, .i{
                color: black;
        }

        .container-fluid.no-padding div{
                padding: 0px;
        }

        .displayHeader{
                display: flex;
                align-items: center;
        }

        .bottom-buttons {
                position: absolute;
                bottom: 15px;
        }
        .carousel-inner {
                height: 300px;
        }
        
        </style>
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

        <div id="myCarousel" class="carousel slide carousel-dark" data-bs-ride="carousel">
                <div class="carousel-indicators">
                        <?php for ($i = 0; $i < count($currentEvents); $i++) : ?>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="<?php echo $i; ?>" <?php echo ($i === 0) ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo ($i + 1); ?>"></button>
                        <?php endfor; ?>
                </div>

                <div class="carousel-inner container" style="background-color: #f5f3f2; border-radius: 25px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.15);">
                        <?php
                        $firstIteration = true;
                        foreach($currentEvents as $array=>$index){
                        ?>
                                <div class="carousel-item <?php echo ($firstIteration) ? 'active' : ''; ?>" data-bs-interval="5000">
                                        <?php
                                        $firstIteration = false;
                                        usort($currentEvents, 'compareEvents');   
                                        ?>

                                        <div class="container-fluid no-padding">
                                                <div class="row displayHeader">

                                                        <div class="col-auto">
                                                                <img class="icon" src="<?php echo base_url().'/assets/icons/'.$index['file_extension'].'.png'?>" alt=<?php echo $index['file_name'];?>>
                                                                </img>
                                                        </div>

                                                        <div class="col" style="display: flex; align-items: center; justify-content: space-between; height: 230px;">
                                                                <div style="display: flex; flex-direction: column;"> 
                                                                        <i class="i" style="margin-left: 28px; margin-top: 10px;">
                                                                        <?php echo $index['file_name'];?>
                                                                        </i>
                                                                        <h1>
                                                                        <?php echo $index['file_title'];?>
                                                                        </h1>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>

                                        <div>
                                                <div class="row" style="display: flex; justify-content: space-between;">
                                                        <div class="col">
                                                                <h5 class="container-fluid" style="text-align: right;">
                                                                        <i>
                                                                                Date Start: <?php echo $index['event_Start']; ?>
                                                                        </i>
                                                                </h5>
                                                        
                                                                <h5 class="container-fluid" style="text-align: right;">
                                                                        <i>
                                                                                Date End: <?php echo $index['event_End']; ?>
                                                                        </i>
                                                                </h5>
                                                        </div>                                                                
                                                </div>
                                        </div>
                                </div>
                        <?php
                        }?>
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


        <div class="container">
                <div class="row">
                        <div class="col-lg-6">                        
                                <table class="table table-hover table-sm caption-top">
                                        <caption style="font-size:16px">Current & Upcoming Events</caption>
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
                                        $rowLimit = 10;

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
                        </div><!-- /.col-lg-4 -->

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
                                        $rowLimit = 10;

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

                                                        <td class="d" style="text-align: center;">
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
                        </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
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