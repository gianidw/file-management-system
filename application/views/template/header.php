<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$user_id = $this->session->userdata('user_id');
$officeAbbreviations = array(
    "Dev" => "Dev",
    "Office of the President and Chief Executive Officer" => "OP-CEO",
    "Office of the Chief Information Officer - Information Management Sector" => "OCIO-IMS",
    "Office of the Chief Operating Officer" => "OCOO",
    "Task Force Informatics" => "TFI",
    "IPPSD" => "IPPSD",
    "ITMD" => "ITMD",
    "PMO" => "PMO",
    "Human Resource Department" => "HRD",
    "Physical Resource and Infrastructure Department" => "PRID",
    "Protest and Appeals Review Department" => "PARD",
    "Fund Management Sector" => "FMS",
    "Treasury Department" => "Treasury Department",
    "International and Local Engagement Department" => "ILED",
    "CorComm" => "CorComm",
    "Corporate Planning Department" => "CorPlan",
    "Corporate Marketing Department" => "CorMar",
    "Management Services Sector" => "MMS",
    "Corporate Affairs Group" => "CAG",
    "Health Finance Policy Sector" => "HFPS"
);
// Set "Your Office" module to user's office
$yourOffice = @$officeAbbreviations[$_SESSION['user_office']];

// 12/4/2023 -- Commented out Notification Bell @ line 493 for presentation since it's not ready
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <link rel="icon" style="width:20px" type="image/x-icon" href="/intra/assets/Logo1.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <title>PhilHealth Intranet</title>

    
    <link href="<?php echo base_url();?>assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/fontawesome6.4/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/fontawesome6.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/all.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/toast/toast.min.css">
    <script src="<?php echo $CI->config->base_url();?>assets/js/jquery-3.7.0.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet"></link>


    <style>
        .headerlabel{
            display:inline-block;
            width:60px;
            vertical-align: top;
            width: 40px;
            text-align: right;
        }
        .headerlabel2{
            display:inline-block;
            width:140px;
            line-height: 15px;
        }
        .colon {
            display: inline-block;
            text-align: right;
            vertical-align: top;
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


        .sidenav {
            position: fixed;
            z-index: 1;
        }
        
        .sidenav a, .dropdown-btn {
            text-decoration: none;
            display: block;
            border: none;
            background: none;
            cursor: pointer;
            outline: none;
        }

        .sidenav a:hover, .dropdown-btn:hover {
            color: #20d61a;
        }

        /* Main content */
        /* .main {
            margin-left: 200px;
            font-size: 20px;
            padding: 0px 10px;
        } */

        /* Add an active class to the active dropdown button */
        .active {
            background-color: none;
            color: blue;
        }

        /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
        .dropdown-container {
            display: none;
            background-color: none;
            padding-left: 2rem;
            padding-right: none;
        }

        .dropdown-item{
            color: blue;
        }
        .dropdown-item:hover{
            background-color: transparent;
        }

        /* Some media queries for responsiveness */
        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
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
        body{
            background: url('/intra/assets/bg.jpg');
            background-size: cover;
        /* background-repeat: no-repeat; */
        }

        .highlight {
            background-color: yellow;
            font-weight: bold;
        } 
        
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");
            :root{
            --header-height: 3rem;
            --nav-width: 68px;
            --first-color-light: #AFA5D9;
            --white-color: #F7F6FB;
            --normal-font-size: 1rem;
            --z-fixed: 100}*, 
            ::before, ::after{
            box-sizing: border-box;
        }
        
        body{
            position: relative;
            margin: var(--header-height) 0 0 0;
            padding: 0 1rem;
            transition: .5s
        }
        
        a{
            text-decoration: none
        }
        
        .header{
            width: 100%;
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            z-index: var(--z-fixed);
            transition: .5s
        }
        
        .header-toggle{
            color: #000000;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .header_img{
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden
        }
        
        .header_img img{
            width: 40px
        }
        
        .l-navbar{
            position: fixed;
            left: -30%;
            width: calc(var(--nav-width) - 10px);
            height: 100vh;
            padding: .5rem 1rem 0 0;
            transition: .5s;
            z-index: 999;
        }

        .l-navbar.collapsed .dropdown-item {
            display: none;
        }
        
        .l-navbar .dropdown-item {
            display: block;
        }

        .nav{
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden
        }
        
        .nav_logo, .nav_link{
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            padding: .5rem 0 .5rem 1.5rem
        }
        
        .nav_logo{
            margin-bottom: 2rem
        }
        
        .nav_logo-icon{
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            padding: .5rem 0 .5rem 1.5rem
        }
        
        .nav_logo-name{
            font-weight: 700
        }
        
        .nav_link{
            position: relative;
            color: var(--first-color-light);
            margin-bottom: 1.5rem;
            transition: .3s
        }
        
        .nav_link:hover{
            color: var(--white-color)
        }
        
        .show{
            left: 0
        }
        
        .body-pd{
            padding-left: calc(var(--nav-width) + 1rem)
        }
        
        .active{
        color: var(--white-color)
        }
        
        .active::before{
            content: '';
            position: absolute;
            left: 0;
            width: 2px;
            height: 32px;
            background-color: var(--white-color)
        }
        
        .height-100{
        height: 100vh
        }
        @media print {
			.tedt{
				font-weight:bold;
				display: none;
			}
            .modal {
                overflow: hidden !important;
                overflow-y: hidden !important;
            }
            body{
                /* margin: calc(var(--header-height) + 1rem) 0 0 0;
                padding-left: calc(var(--nav-width) + 2rem); */
                overflow: hidden !important;
                overflow-y: hidden !important;

            }}
        @media screen and (min-width: 768px){
            .toprint{
                overflow: hidden;
                overflow-y: hidden;
            }
            body{
                margin: calc(var(--header-height) + 1rem) 0 0 0;
                padding-left: calc(var(--nav-width) + 2rem);
                /* overflow: hidden;
                overflow-y: hidden; */
            }
            
            .header{
                height: calc(var(--header-height) + 1rem)
            }
            
            .header_img{
                width: 40px;height: 40px
            }
            
            .header_img img{
                width: 45px
            }
            
            .l-navbar{
                left: 0;
                padding: 1rem 1rem 0 0
            }
            
            .display{
                width: calc(var(--nav-width) + 188px)
            }
            
            .body-pd{
                padding-left: calc(var(--nav-width) + 188px)
            }
        }
        .dropdown-toggle::after{
            margin-left: 0
        }

        .notification-popup {
            display: none;
            position: fixed;
            top: 40px;
            right: 370px;
            z-index: 999;
            background: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 10px;
            border-radius: 5px;
            transform: scale(0);
            transform-origin: top right;
            transition: transform 0.3s ease-in-out;           
        }

        #animatedBell {
            display: none;
        }

        
        /* CSS for Testing */
        .test{
            border: 1px solid red;
        }
        .tets{
            border: 1px solid blue;
        }
        /*******************/

    </style>

    <script>
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
       
        function showResult(str) {
                if (str.length==0) {
                        document.getElementById("global-search").innerHTML="";
                        document.getElementById("global-search").style.border="0px";
                        return;
                }
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                        if (this.readyState==4 && this.status==200) {
                                document.getElementById("global-search").innerHTML=this.responseText;
                                document.getElementById("global-search").style.border="1px solid #A5ACB2";
                        }
                }
                xmlhttp.open("GET","search.php?q="+str,true);
                xmlhttp.send();
        }
    </script>
  
</head>
  
  
  
<body id="body-pd">
    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow header tedt" id="header" style="background-color: #e3f2fd;">
        <div class="container-fluid" style="position:relative;">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="<?php echo base_url('home')?>"><img src="/intra/assets/logo.png" width="166px" height="60px"></a>
            
            <div class="d-flex align-items-center justify-content-end flex-grow-1">
                <form class="me-2" name="global-search" action="<?php echo base_url('home/do_search')?>" method="POST">
                    <input type="global-search" size="30" name="global-search" id="global-search" placeholder="Search.." value="<?php echo isset($_POST['global-search']) ? htmlspecialchars($_POST['global-search']) : ''; ?>" <?php echo isset($_POST['global-search']) ? 'autofocus' : ''; ?>>
                </form>

                <?php
                    if(isset($_SESSION['user_id'])){?>
                        <!-- <div class="m-3">
                            <i id="idleBell" class="fa-solid fa-bell fa-lg" style="cursor: pointer;"></i>
                            <i id="animatedBell" class="fa-solid fa-bell fa-beat-fade fa-lg" style="cursor: pointer;"></i>
                        </div> -->
                    <?php
                    };
                ?>

                <div class="user-info me-2" style="font-size:12px;">
                        <?php
                        if(isset($_SESSION['user_id'])){
                            $userName = $this->security->xss_clean($_SESSION['user_name']);
                            $userEmail = $this->security->xss_clean($_SESSION['user_email']);
                            $userOffice = $this->security->xss_clean($yourOffice);
                            if ($_SESSION['user_type'] == "Admin") {
                                echo '
                                    <label class="headerlabel text-muted">User</label>
                                    <span class="colon">: &nbsp;&nbsp;</span>
                                    <label class="headerlabel2">'.$userName.' (Admin)</label><br>
                                ';
                            } else {
                                echo '
                                    <label class="headerlabel text-muted">User</label>
                                    <span class="colon">: &nbsp;&nbsp;</span>
                                    <label class="headerlabel2">'.$userName.'</label><br>
                                ';
                            }
                            echo '
                                <label class="headerlabel text-muted">Email</label>
                                <span class="colon">: &nbsp;&nbsp;</span>
                                <label class="headerlabel2">'.$userEmail.'</label><br>
                                ';

                            if ($_SESSION['user_type'] == "Office Admin") {
                                echo '
                                    <label class="headerlabel text-muted">Office</label>
                                    <span class="colon">: &nbsp;&nbsp;</span>
                                    <label class="headerlabel2">'.$userOffice.' (Office Admin)</label><br>
                                ';
                            } else {
                                echo '
                                    <label class="headerlabel text-muted">Office</label>
                                    <span class="colon">: &nbsp;&nbsp;</span>
                                    <label class="headerlabel2">'.$userOffice.'</label><br>
                                ';
                            }
                        };
                        ?>            
                </div>
                
                <?php
                if(isset($_SESSION['user_id'])){?>
                    <div class="nav-item text-nowrap">
                        <a class="btn btn-danger" type="button" href="<?php echo site_url('home/logout');?>">Sign Out</a>
                    </div>
                <?php
                }
                else{?>
                    <div class="nav-item text-nowrap">
                        <a class="btn btn-success" type="button" href="<?php echo site_url('home/login');?>">Sign In</a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </header>

    <!-- ========== NOTIFICATION POP-UP ========== -->
    <div id="notification-popup" class="notification-popup">
        <ul id="notification-list">
        </ul>
    </div>

    <!-- ========== MODALS ========== -->

    <!-- DEFAULT MODAL -->
    <div class="modal fade" id="modal-default" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="staticBackdropLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                
                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- FULLSCREEN MODAL -->
    <div class="modal fade" id="modal-fs" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="staticBackdropLabel2"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- MODAL TOGGLE TEMPLATE -->

    <!-- <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Modal 1</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Show a second modal and hide this one with the button below.
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-bs-target="#editModal" data-bs-toggle="modal">Open second modal</button>
        </div>
        </div>
    </div>
    </div> -->

    <div class="modal fade" id="editModal" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="editModalTitle" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalTitle">EDIT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-toggle="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <!-- <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- =========================== -->

    <div>
        <div class="row l-navbar" id="nav-bar">
            <nav id="sidebarMenu" class="nav">
            <div class="position-sticky pt-3 sidebar-sticky sidenav">
                <ul class="nav flex-column text-nowrap">
            
                    <li class="nav-item" style="display:inline-block;">
                        <div class="header-toggle container fluid">
                            <i id="header-toggle" class="fas fa-bars fa-sm" style="color: #0d6efd;"></i>
                        </div>
                    </li>

                    <li class="nav-item text-nowrap" style="display:inline-block;">
                        <a class="nav_logo-icon" aria-current="page" href="<?php echo base_url('home');?>">
                        <i class="fa-solid fa-home" style="width:20px"></i>
                        <span>&nbsp;HOME</span>
                        </a>
                    </li>

                    <?php
                    if(@$_SESSION['user_type'] == "Admin"){?>
                        <li class="nav-item" style="display:inline-block;">
                            <a class="nav_logo-icon" href="<?php echo base_url('home/admin_panel');?>">
                            <i class="fa-solid fa-user" style="width:20px"></i>
                            <span>&nbsp;ADMIN PANEL</span></a>
                        </li>
                    <?php
                    }
                    else;?>

                    <?php
                    if(isset($_SESSION['user_id'])){?>
                        <li class="nav-item text-nowrap" style="display:inline-block;">
                            <a class="nav_logo-icon" aria-current="page" href="<?php echo base_url('home/do_office');?>">
                            <i class="fa-solid fa-house-laptop" style="width:20px"></i>
                            <span>&nbsp;<?php echo strtoupper(@$yourOffice)?> OFFICE</span>
                            </a>
                        </li>
                    <?php
                    }
                    else;?>

                    <li class="nav-item text-nowrap" style="display:inline-block;">
                        <a class="nav_logo-icon" aria-current="page" href="<?php echo base_url('home/do_events');?>">
                        <i class="fa-solid fa-calendar-days" style="width:20px"></i>
                        <span>&nbsp;EVENTS & TRAINING</span>
                        </a>
                    </li>
                

                    <li class="nav-item" style="display:inline-block;">
                        <a class="nav_logo-icon" id="nav-logo-icon">
                            <i class="fa-solid fa-scroll" style="width:20px"></i>
                            <span>&nbsp;ISSUANCES</span>
                        </a>

                        <div class="dropdown-container" style="font-size:14px;">
                            <ul class="nav flex-column">
                                <a class="dropdown-item" href="<?php echo base_url('home/do_issuances?link=co');?>">Corporate Order</a>
                                <a class="dropdown-item" href="<?php echo base_url('home/do_issuances?link=cpo');?>">Corporate Personnel Order</a>
                                <a class="dropdown-item" href="<?php echo base_url('home/do_issuances?link=cm');?>">Corporate Memorandum</a>
                                <a class="dropdown-item" href="<?php echo base_url('home/do_issuances?link=circular');?>">PhilHealth Circular</a>
                                <a class="dropdown-item" href="<?php echo base_url('home/do_issuances?link=sop');?>">Standard Operating Procedure</a>
                                <a class="dropdown-item" href="<?php echo base_url('home/do_issuances?link=wins');?>">Work Instruction</a>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item" style="display:inline-block;">
                        <a class="nav_logo-icon" aria-current="page" href="<?php echo base_url('home/do_issuances?link=advisory');?>">
                            <i class="fa-solid fa-bullhorn" style="width:20px"></i>
                            <span class="nav_icon">&nbsp;NEWS & ADVISORIES</span>
                        </a>
                    </li>
    
                    <li class="nav-item" style="display:inline-block;">
                        <a class="nav_logo-icon" aria-current="page" href="<?php echo base_url('home/directory');?>">
                            <i class="fa-solid fa-address-book" style="width:20px"></i>
                            <span class="nav_icon">&nbsp;DIRECTORY</span>
                        </a>
                    </li>

                    <li class="nav-item" style="display:inline-block;">
                        <a class="nav_logo-icon" aria-current="page" href="<?php echo base_url('home/do_download');?>">
                            <i class="fa-solid fa-download" style="width:20px"></i>
                            <span class="nav_icon">&nbsp;DOWNLOADS</span>
                        </a>
                    </li>  
                    
                    <?php
                    if(@$_SESSION['user_type'] == "Dev"){?>
                        <li class="nav-item text-nowrap" style="display:inline-block;">
                            <a class="nav_logo-icon" aria-current="page" href="<?php echo base_url('home/test');?>">
                            <i class="fa-solid fa-radiation fa-beat-fade" style="width:20px"></i>
                            <span>&nbsp;MODULE TEST AREA</span>
                            </a>
                        </li>
                    <?php
                    }
                    else;?>

                </ul>
            </div>
            </nav>
        </div>
    </div>



    <main>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?php echo strtoupper(@$title)?></h1>
        </div>

