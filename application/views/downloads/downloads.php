<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
?>

<!DOCTYPE html>
<html>
<head>
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
	table{
        /* font-size: 13px; */
        box-shadow: 5px 15px 20px rgba(0, 0, 0, 0.15);
        /* table-layout: fixed; */
        /* max-width: 80%; */
    }

    @media (min-width: 768px) {
        /* .bd-placeholder-img-lg {
            font-size: 3.5rem;
        } */
    }    

    tr:nth-child(even) {
        background-color: #eee;
    }

    .a {
        text-align: center;
        vertical-align: middle;
        width: 25%;
    }
    .b {
        max-width: 100px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        vertical-align:middle;
    }

    caption{
        font-weight:bold;
        font-size:20px;
    }
    
</style>


<div class="row">
    <div class="col-md-6">
        <input id="myInput" type="search" placeholder="Search..">
        <br><br>
    </div>
</div>


<div class="row"><br></div>


<div class="row">
    <div class="col">
        <table class="table table-hover table-sm caption-top">
            <caption>HR Forms</caption>
            <thead class="bg-light top-0">
            
            </thead>
            <tbody id="myTable" class="table-group-divider">
                <?php

                usort($files, function($a, $b) {
                    return strcmp($a['file_name'], $b['file_name']);
                });
                
                foreach ($files as $id=>$file)
                {
                    if($file['file_category'] == 'HR'){
                        // Remove the last 4 characters from the file_name
                        $trimmedFileName = preg_replace('/\.(xls|xlsx|ppt|pptx|pdf|docx|doc|zip|rar)$/', '', $file['file_name']);

                        echo '
                        <tr>                                        
                            <td class="b">
                                <h6 style="margin-left:15px;">'.$trimmedFileName.'</h6>
                            </td>

                            <td class="a">
                                <button class="btn btn-secondary" style="margin-top: 10px;" type="button" title="View Entry" onclick="downloadFile(\''.$file['file_name'].'\')">
                                    <i class="fa-solid fa-download"></i>  Download
                                </button>
                                ';
                                if(@$_SESSION['user_type'] == "Admin"){
                                    echo '
                                    <button class="btn btn-danger" style="margin-top: 10px;" type="button" title="Delete Entry" onclick="javascript:window.location.href=\''.base_url('task/delete_form/').$file['file_ID'].'/'.$file['file_name'].'\'">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                    ';
                                }
                                echo '
                                <h6 style="margin-right: 10px;">
                                    <small class="text-muted" style="margin-top: 5px;">Downloads: '.$file['file_download_count'].'</small>
                                </h6>
                                
                            </td>
                        </tr>
                        ';
                    }
                }
                ?>
            </tbody>
        </table>
    </div><!-- /.col-lg-4 -->

    <div class="col">
        <table class="table table-hover table-sm caption-top">
            <caption>IT Forms</caption>
            <thead class="bg-light top-0">
            
            </thead>
            <tbody id="myTable" class="table-group-divider">
                <?php

                usort($files, function($a, $b) {
                    return strcmp($a['file_name'], $b['file_name']);
                });
                
                foreach ($files as $id=>$file)
                {
                    if($file['file_category'] == 'IT'){
                        // Remove the last 4 characters from the file_name
                        $trimmedFileName = preg_replace('/\.(xls|xlsx|ppt|pptx|pdf|docx|doc|zip|rar)$/', '', $file['file_name']);

                        echo '
                        <tr>                                        
                            <td class="b">
                                <h6 style="margin-left:15px;">'.$trimmedFileName.'</h6>
                            </td>

                            <td class="a">
                                <button class="btn btn-secondary" style="margin-top: 10px;" type="button" title="View Entry" onclick="downloadFile(\''.$file['file_name'].'\')">
                                    <i class="fa-solid fa-download"></i>  Download
                                </button>
                                ';
                                if(@$_SESSION['user_type'] == "Admin"){
                                    echo '
                                    <button class="btn btn-danger" style="margin-top: 10px;" type="button" title="Delete Entry" onclick="javascript:window.location.href=\''.base_url('task/delete_form/').$file['file_ID'].'/'.$file['file_name'].'\'">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                    ';
                                }
                                echo '
                                <h6 style="margin-right: 10px;">
                                    <small class="text-muted" style="margin-top: 5px;">Downloads: '.$file['file_download_count'].'</small>
                                </h6>
                                
                            </td>
                        </tr>
                        ';
                    }
                }
                ?>
            </tbody>
        </table>
    </div><!-- /.col-lg-4 -->
</div>

<div class="row">
    <div class="col">
        <table class="table table-hover table-sm caption-top">
            <caption>TFI Forms</caption>
            <thead class="bg-light top-0">
            
            </thead>
            <tbody id="myTable" class="table-group-divider">
                <?php

                usort($files, function($a, $b) {
                    return strcmp($a['file_name'], $b['file_name']);
                });
                
                foreach ($files as $id=>$file)
                {
                    if($file['file_category'] == 'TFI'){
                        // Remove the last 4 characters from the file_name
                        $trimmedFileName = preg_replace('/\.(xls|xlsx|ppt|pptx|pdf|docx|doc|zip|rar)$/', '', $file['file_name']);

                        echo '
                        <tr>                                        
                            <td class="b">
                                <h6 style="margin-left:15px;">'.$trimmedFileName.'</h6>
                            </td>

                            <td class="a">
                                <button class="btn btn-secondary" style="margin-top: 10px;" type="button" title="View Entry" onclick="downloadFile(\''.$file['file_name'].'\')">
                                    <i class="fa-solid fa-download"></i>  Download
                                </button>
                                ';
                                if(@$_SESSION['user_type'] == "Admin"){
                                    echo '
                                    <button class="btn btn-danger" style="margin-top: 10px;" type="button" title="Delete Entry" onclick="javascript:window.location.href=\''.base_url('task/delete_form/').$file['file_ID'].'/'.$file['file_name'].'\'">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                    ';
                                }
                                echo '
                                <h6 style="margin-right: 10px;">
                                    <small class="text-muted" style="margin-top: 5px;">Downloads: '.$file['file_download_count'].'</small>
                                </h6>
                                
                            </td>
                        </tr>
                        ';
                    }
                }
                ?>
            </tbody>
        </table>
    </div><!-- /.col-lg-4 -->

    <div class="col">
        <table class="table table-hover table-sm caption-top">
            <caption>Other Forms</caption>
            <thead class="bg-light top-0">
            
            </thead>
            <tbody id="myTable" class="table-group-divider">
                <?php

                usort($files, function($a, $b) {
                    return strcmp($a['file_name'], $b['file_name']);
                });
                
                foreach ($files as $id=>$file)
                {
                    if($file['file_category'] == 'Uncategorized'){
                        // Remove the last 4 characters from the file_name
                        $trimmedFileName = preg_replace('/\.(xls|xlsx|ppt|pptx|pdf|docx|doc|zip|rar)$/', '', $file['file_name']);

                        echo '
                        <tr>                                        
                            <td class="b">
                                <h6 style="margin-left:15px;">'.$trimmedFileName.'</h6>
                            </td>

                            <td class="a">
                                <button class="btn btn-secondary" style="margin-top: 10px;" type="button" title="View Entry" onclick="downloadFile(\''.$file['file_name'].'\')">
                                    <i class="fa-solid fa-download"></i>  Download
                                </button>
                                ';
                                if(@$_SESSION['user_type'] == "Admin"){
                                    echo '
                                    <button class="btn btn-danger" style="margin-top: 10px;" type="button" title="Delete Entry" onclick="javascript:window.location.href=\''.base_url('task/delete_form/').$file['file_ID'].'/'.$file['file_name'].'\'">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                    ';
                                }
                                echo '
                                <h6 style="margin-right: 10px;">
                                    <small class="text-muted" style="margin-top: 5px;">Downloads: '.$file['file_download_count'].'</small>
                                </h6>
                                
                            </td>
                        </tr>
                        ';
                    }   
                }
                ?>
            </tbody>
        </table>
    </div><!-- /.col-lg-4 -->
</div>



	
      


<script>
        function downloadFile(filename) {
            window.location.href = "<?php echo base_url('task/download_form/'); ?>" + filename;
        }
</script>