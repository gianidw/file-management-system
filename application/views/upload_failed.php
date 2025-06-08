<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();

echo "<h2>Invalid Input:</h2>";
echo implode("<br>", $errorArray);
?>

<html>
        <body>
                <p>You will be redirected in 3 seconds</p>
                <script>
                var timer = setTimeout(function() {
                        window.location='/intra/home/admin_panel'
                }, 3000);
                </script>
        </body>
</html>