<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Not Found</title>
    <link href="<?php echo url()?>public/css/libs/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?php echo url()?>public/css/libs/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo url()?>public/css/libs/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <style>
        .error-template {padding: 40px 15px;text-align: center;}
        .error-actions {margin-top:15px;margin-bottom:15px;}
        .error-actions .btn { margin-right:10px; }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="error-template">
            <h1>Oops!</h1>
            <h2>404 Not Found</h2>
            <div class="error-details">
                Sorry, an error has occured, Requested page not found!<br>

            </div>
            <div class="error-actions">
                <a href="<?php echo url() ?>" class="btn btn-primary">
                    <i class="icon-home icon-white"></i> Take Me Home </a>
                <a href="mailto:<?php echo SUPPORT_MAIL ?>" class="btn btn-default">
                    <i class="icon-envelope"></i> Contact Support </a>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo url()?>public/js/libs/jquery-2.2.4.min.js"></script>
<script src="<?php echo url()?>public/js/libs/bootstrap.min.js"></script>
</body>
</html>