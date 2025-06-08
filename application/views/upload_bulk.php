
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
?>

<!doctype html>
<html>
     <head>
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Multiple files upload at once with php</title>
     </head>

     <body >
     
          <form method='post' action='<?php echo base_url('task/upload_bulk/')?>' enctype='multipart/form-data'>
               <div class="container">
                    <input class="form-control" type='file' name="userfile[]" id="userfile" multiple><br/>
                    <div class="form-check">
                         <label class="form-check-label" for="group_files">Group These Files Together</label>
                         <input class="form-check-input" type="checkbox" name="group_files" id="group_files" value="1">
                    </div>

                    <br>
                    <div class="container" style="display: flex; align-items: center;"">
                         <label style="margin-right: 10px;">Is this file just for your office?</label>
                         <input type="radio" id="isExclusiveYes" name="isExclusive" style="margin-right: 5px;" value="Yes" <?php echo (@$FormData['isExclusive'] === 'Yes') ? 'checked' : ''; ?>>
                         <label for="isExclusiveYes">Yes</label>
                         <input type="radio" id="isExclusiveNo" name="isExclusive" style="margin-right: 5px;" value="No" <?php echo (@$FormData['isExclusive'] === 'No') ? 'checked' : ''; ?>>
                         <label for="isExclusiveNo">No</label>
                    </div>

                    <br>
                    <input class="inputbx" type="hidden" name="file_date_created" readonly value="<?php echo $today;?>">
                    <div  style="text-align:center">
                         <input class="btn btn-secondary" type='submit' name='submit' value='Upload'>
                    </div>        
               </div>
          </form>

          <?php
          if(isset($_POST['submit'])){

               $countfiles = count($_FILES['userfile']['name']);
               $totalFileUploaded = 0;
               $uploadedFilesArray = array();

               for($i = 0; $i < $countfiles; $i++){
                    $filename = $_FILES['userfile']['name'][$i];

                    ## Location
                    $location = "./assets/files/".$filename;
                    $extension = pathinfo($location,PATHINFO_EXTENSION);
                    // $extension = strtolower($extension);

                    ## File upload allowed extensions
                    $valid_extensions = array("xls", "xlsx", "ppt", "pptx", "pdf", "docx", "doc", "zip", "rar");

                    ## Check file extension
                    if(in_array(strtolower($extension), $valid_extensions)) {
                         ## Upload file
                         if(move_uploaded_file($_FILES['userfile']['tmp_name'][$i],$location))
                         {
                              $fileData = array(
                                   'file_name' => $filename,
                                   'file_path' => $location,
                                   'file_date_created' => $today
                              );

                              $uploadedFilesArray[] = $fileData;
                              // echo "file name : ".$filename."<br/>";

                              $totalFileUploaded++;
                         }
                    }

               }

              
     }
     ?>
     </body>
</html>

