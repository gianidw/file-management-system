<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
?>

    </main>
</body>

<script src="<?php echo $CI->config->base_url();?>/assets/js/bootstrap/bootstrap.js"></script>
<script src="<?php echo $CI->config->base_url();?>/assets/js/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo $CI->config->base_url();?>/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo $CI->config->base_url();?>/assets/js/datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $CI->config->base_url();?>/assets/fontawesome6.4/js/fontawesome.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/toast/jqm.js"></script>
<script src="<?php echo base_url(); ?>assets/toast/toast.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } 
            else {
                dropdownContent.style.display = "block";
            }
        });
    }
    
    <?php 
        if($this->session->flashdata('success')){ ?>
        toastr.success("<?php echo $this->session->flashdata('suc'); ?>");
    <?php 
    }
        else if($this->session->flashdata('wrong')){?>
        toastr.error("<?php echo $this->session->flashdata('wrong'); ?>");
    <?php 
    }
        else if($this->session->flashdata('warning')){?>
        toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
    <?php 
    }
        else if($this->session->flashdata('info')){?>
        toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php 
    }
        $this->session->unset_userdata ('success');
        $this->session->unset_userdata ('wrong');
        $this->session->unset_userdata ('warning');
        $this->session->unset_userdata ('info');
    ?>

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

    document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) =>{
                const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

            if(toggle && nav && bodypd && headerpd){
                toggle.addEventListener('click', ()=>{
                    nav.classList.toggle('display')
                    toggle.classList.toggle('bx-x')
                    bodypd.classList.toggle('body-pd')
                    headerpd.classList.toggle('body-pd')
                })
            }
        }
        showNavbar('header-toggle','nav-bar','body-pd','header')
    });


    // Function to hide dropdown items when the page loads
    function hideDropdownItems() {
        const dropdownContainers = document.querySelectorAll('.dropdown-container');
        dropdownContainers.forEach((container) => {
        container.style.display = 'none'; // Hide the dropdown items
        });
    }

    // Function to toggle visibility of dropdown items when sidebar is expanded/collapsed
    function toggleDropdownItems() {
        const sidebar = document.getElementById('nav-bar');
        const dropdownContainers = sidebar.querySelectorAll('.dropdown-container');
        const isSidebarCollapsed = sidebar.classList.contains('display');

        dropdownContainers.forEach((container) => {
        // If the sidebar is collapsed, hide the dropdown items
        // If the sidebar is expanded, show the dropdown items
        container.style.display = isSidebarCollapsed ? 'none' : 'block';
        });
    }

    // Call the hide function when the page loads
    document.addEventListener('DOMContentLoaded', hideDropdownItems);

    // Call the toggle function when the sidebar is toggled
    document.getElementById('header-toggle').addEventListener('click', toggleDropdownItems);

    // Function to increment View Count upon opening file data modal
    function viewFile(filename) {
        event.preventDefault();
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('task/view/'); ?>" + filename,
            success: function() {
                console.log("View count incremented successfully");
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    $(document).ready(function () {

        function updateNotificationIcon() {
            $.ajax({
                url: "<?php echo site_url('Home/getUnreadNotifications'); ?>", //getUnreadNotifications is in MY_Controller
                method: 'GET',
                success: function (data) {
                    // console.log("Raw data: ", data);
                    // Check if there are unread notifications
                    const hasUnreadNotifications = data.some(notification => notification.is_read === "0");
                    // console.log("Has unread notifications: ", hasUnreadNotifications);
                    // Show/hide the notification icons based on the result
                    if (hasUnreadNotifications) {
                        $('#idleBell').hide();
                        $('#animatedBell').show();
                    } else {
                        $('#idleBell').show();
                        $('#animatedBell').hide();
                    }
                },
                error: function (error) {
                    console.error('Error fetching notifications: ', error);
                }
            });
        }

        // Initial check when the page loads
        updateNotificationIcon();   

        // When the bell icon is clicked
        $('.fa-bell').click(function () {
            var notificationPopup = $('#notification-popup');

            if (notificationPopup.is(':visible')) {
                notificationPopup.css('transform', 'scale(0)');
                setTimeout(function () {
                    notificationPopup.hide();
                }, 300);
                updateNotificationIcon();
            } 
            else {
                notificationPopup.show();
                setTimeout(function () {
                    notificationPopup.css('transform', 'scale(1)');
                }, 0);
            }

            // If you want to load notifications from the server, you can use an AJAX request here
            $.ajax({
                url: "<?php echo site_url('Home/getUnreadNotifications'); ?>",
                method: 'GET', // Change to 'POST' if needed
                success: function (data) {
                    
                    // Loop through notifications and add them to the list
                    var notificationList = $('#notification-list');
                    notificationList.empty(); // Clear existing notifications
                    $.each(data, function (index, notification) {
                        var listItem = $('<li class="notification-item text-muted" data-notification-id="' + notification.notification_id + '"> New Upload: ' + notification.file_title + '</li>');
                        notificationList.append(listItem);
                    });
                    // console.log(data);
                },
                error: function (error) {
                    console.error('Error fetching notifications: ', error);
                }
            });
        });

        $('.notification-item').mouseenter(function () {
            var notificationId = $(this).data('notification-id');
            console.log(notificationId);
            // Send an AJAX request to mark the notification as read
            $.ajax({
                url: '<?php echo site_url('Home/markAsRead/'); ?>' + notificationId,
                method: 'POST',
                success: function (response) {
                    // Handle success, if needed
                    console.log('Notification marked as read');
                },
                error: function (error) {
                    console.error('Error marking notification as read: ', error);
                }
            });

            // Change the notification appearance to indicate it's read
            $(this).addClass('read-notification');
        });

        // Event delegation for click on notification items
        $('#notification-list').on('click', '.notification-item', function () {
            var notificationId = $(this).data('notification-id');

            // Fetch the file details using AJAX and open the modal
            $.ajax({
                url: '<?php echo base_url('task/file_details'); ?>',
                method: 'POST',
                data: { notificationId: notificationId }, // Adjust this data as needed
                success: function (response) {
                    // Handle the AJAX response here if needed
                    $('#modal-fs .modal-body').html(response);
                    // Show the modal
                    $('#modal-fs').modal('show');
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });

    });
</script>

</script>


    <footer>
        <div class="text-center mt-5 text-muted  ">
            © Copyright &copy; 2023 &mdash; <a href="https://www.philhealth.gov.ph/" target=_blank>philhealth.gov.ph</a>
        </div>
    </footer>
      
    
</html>