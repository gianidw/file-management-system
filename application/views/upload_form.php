<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
?>

<!doctype html>
<html>
     <head>
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Upload Multiple Forms</title>
     </head>

     <body >
     
          <form method='post' action='<?php echo base_url('task/upload_form/')?>' enctype='multipart/form-data'>
               <div class="container">
                    <input class="form-control" type='file' name="userfile[]" id="userfile" multiple><br/>

                    <!-- <label for="category">Category</label> -->
                    <select class="form-select form-select-sm inputbx" aria-label="Category" name="category" id="category">
                         <option selected value='Uncategorized'>--Category--</option>
                         <option value="TFI">TFI Form</option>
                         <option value="IT">IT Form</option>
                         <option value="HR">HR Form</option>
                    </select>
              

                    <br>
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
                    $location = "./assets/downloads/".$filename;
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
                                   'file_extension' => $extension
                              );

                              $uploadedFilesArray[] = $fileData;
                              // echo "file name : ".$filename."<br/>";

                              $totalFileUploaded++;
                         }
                    }

               }

               $CI->load->library('task/upload_form'); // Load your custom controller library if necessary
               $CI->task->upload_form($uploadedFilesArray);
               echo "Total File uploaded : ".$totalFileUploaded;
     }
     ?>
     </body>
</html>

