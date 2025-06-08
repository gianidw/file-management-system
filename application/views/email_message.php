<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Post in Intranet</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                color: #333;
                margin: 0;
                padding: 20px;
            }

            .container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 20px;
            }

            p {
                margin: 0 0 20px;
            }

            a {
                color: #007bff;
                text-decoration: none;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <p><img src="http://giani.philhealth.gov.ph/intra/assets/logo.png" alt="Company Logo" width="166px" height="60px"></p>
            <p>Good day!</p>
            <p>There's a new post in the PhilHealth Intranet
                <?php if (isset($fileOffice)): ?>
                    for <?php echo $fileOffice; ?>
                <?php endif; ?>!
            </p>
            <?php if (isset($fileTitle)): ?>
                <p>Subject: <?php echo $fileTitle; ?></p>
            <?php endif; ?>

            <p>Visit <a href="http://giani.philhealth.gov.ph/intra" target="_blank">here</a>!</p>
        </div>
    </body>
</html>

