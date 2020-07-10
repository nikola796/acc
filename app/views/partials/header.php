<!doctype html>
<html lang="bg">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?= $title?></title>
    <link href="<?php echo url()?>public/css/libs/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?php echo url()?>public/css/libs/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo url()?>public/css/libs/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo url() ?>public/css/libs/bootstrap-dialog.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo url()?>public/css/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo url()?>public/css/libs/jquery.dataTables.css" rel="stylesheet" media="screen">
    <link href="<?php echo url() ?>public/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( ".datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );
    </script>
</head>

<body bgcolor="#010080" leftmargin="0" topmargin="0" style="">

<div class="container">
    
<?php require('nav.php');

