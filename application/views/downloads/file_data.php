<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$data = $_POST;
?>

<style>
    .pdf{
        width: 80px;
        height: 80px;
        object-fit: cover;
    }

    h1{ 
        font-size: 2.5em;
        margin: 0.67em;
        font-weight: bold;
        text-align: justify;
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
    
    .file-details {
        height: 150px; /* Set the same height as in the HTML */
        overflow-y: auto; /* Enable scrolling if content exceeds fixed height */
    }

    .file-details h4 {
        margin-left: 30px;
    }

</style>

<?php
foreach($data as $dataID => $id){
    $filedata = $this->m_home->getfileData($id);
?>

<!-- Header -->
<div class="container-fluid no-padding">
    <div class="row displayHeader">

        <div class="col-auto">
            <img class="pdf" src="<?php echo base_url().'/assets/icons/'.$filedata['file_extension'].'.png'?>" alt=<?php echo $filedata['file_name'];?>>
            </img>
        </div>

        <div class="col" style="display: flex; align-items: center; justify-content: space-between; height: 150px;">
            <div style="display: flex; flex-direction: column;"> 
                <i style="margin-left: 28px; margin-top: 10px;">
                    <?php echo $filedata['file_name'];?>
                </i>
                <h1 style="font-size: <?php echo min(40, (100 / 3)); ?>px;">
                    <?php echo $filedata['file_title'];?>
                </h1>
            </div>

        </div>

        
        
    </div>
</div>

<hr>

<!-- Body -->
<div class="container-fluid no-padding">
    <div class="row" style="display: flex; justify-content: flex-end;">

        <h6 class="container-fluid">
            <i>
                Originating Office: <?php echo $filedata['file_originating_office'];?>
            </i>

            <i>
                Date Uploaded: <?php echo $filedata['file_date_created']; ?>
            </i>
        </h6>

        
        <h2 class="text-muted">
            Content Preview:
        </h2>
        
        <div class="file-details" style="height: 300px;">
            <h4 style="margin-left: 30px;">
                <?php echo $filedata['file_details'];?>
            </h4>
        </div>



        <div class="bottom-buttons" style="display: flex; align-items: center; justify-content: flex-end;">
            <div>
                <h6 style="margin-right: 10px; text-align:center">
                    <small class="text-muted" style="margin-bottom: 5px;">Views: <?php echo $filedata['file_view_count'];?></small>
                </h6>
                <hr style="margin: 5px 0; width: 90%;">
                <h6 style="margin-right: 10px; text-align:center">
                    <small class="text-muted" style="margin-top: 5px;">Downloads: <?php echo $filedata['file_download_count'];?></small>
                </h6>
            </div>
            <?php
            if((@$_SESSION['user_type'] == "Admin") || (@$_SESSION['user_type'] == "Office Admin" && $filedata['isExclusive'] == 'Yes')){?>
                <button class="btn btn-info editFile" style="margin-right: 10px;" type="button" data-bs-toggle="modal" data-bs-target="#editModal" title="Edit Entry" onclick="javascript:window.location.href=\''.base_url('home/do_edit/').$filedata['file_ID'].'\'" data-id="<?php echo $filedata['file_ID']; ?>" data-modal-title="Edit File"><i class="fa-solid fa-pen-to-square"></i> EDIT</button>
                <button class="btn btn-danger deleteFile" style="margin-right: 10px;" type="button" title="Delete Entry" data-id="<?php echo $filedata['file_ID']; ?>" data-file="<?php echo $filedata['file_name']; ?>"><i class="fa-solid fa-trash"></i> DELETE</button>
            <?php
            }?>
            <!-- <button class="btn btn-secondary" style="margin-right: 10px;" onclick="openFile('<?php echo $filedata['file_name']; ?>')">
                <i class="fa-solid fa-eye"></i> Click Here to View
            </button> -->
            
            <a class="btn btn-secondary" style="margin-right: 10px;" href="<?php echo base_url('assets/files/') . $filedata['file_name']; ?>" target="_blank">
                <i class="fa-solid fa-eye"></i> View File
            </a>
           
            <button class="btn btn-secondary" style="margin-right: 10px;" onclick="downloadFile('<?php echo $filedata['file_name']; ?>')">
                <i class="fa-solid fa-download"></i> Download
            </button>
        </div>
                
    </div>
</div>
    
<?php     
}
?>



<?php
// Temporary
// echo '<pre class="test">';
// print_r($filedata);
?>

<script type="text/javascript">
    $(document).ready(function() {
        function removeModalBackdrops() {
            $('.modal-backdrop').remove();
        }

        $("#editModal").on("show.bs.modal", function(event) {  
            removeModalBackdrops();
            var editButton = $(event.relatedTarget); //
            var file_ID = editButton.data("id");
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('home/do_edit'); ?>',
                data: { file_ID: file_ID },
                success: function(response) {
                    // Handle the AJAX response here if needed
                    $('#modal-fs').modal('hide'); // Close the first modal
                    $('#editModal .modal-body').html(response);
                    // Show the modal
                    $('#editModal').modal('show');
                    console.log('<?php echo base_url('home/do_edit'); ?>');

                },
                error: function(xhr, status, error) {
                    console.error(error);
                    console.log('<?php echo base_url('home/do_edit'); ?>');

                }
            });
        });

        $(".deleteFile").on("click", function() {
            var file_ID = $(this).data("id");
            var file_name = $(this).data("file");

            // Show confirmation dialog before proceeding with the deletion
            if (confirm("Are you sure you want to delete this file?")) {
                // Make AJAX request to delete the file
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('task/delete_file_action'); ?>',
                    data: { file_ID: file_ID, file_name: file_name },
                    success: function(response) {
                        // Handle the AJAX response here if needed
                        console.log(response);
                        // Reload the page to reflect the changes after successful deletion
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        console.log('<?php echo base_url('task/delete_file_action'); ?>');
                    }
                });
            }
        });
    });

    function downloadFile(filename) {
        window.location.href = "<?php echo base_url('task/download/'); ?>" + filename;
    }

    // function openFile(filename) {
    //     $.ajax({
    //         type: "GET",
    //         success: function() {
    //             // Simulate click on an anchor link to open the PDF in a new tab
    //             var link = document.createElement('a');
    //             link.href = "<?php echo base_url('assets/files/'); ?>" + filename;
    //             link.target = "_blank";
    //             link.click();
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(error);
    //         }
    //     });
    // }
</script>