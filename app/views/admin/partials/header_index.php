<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Моето пространство</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
<!--    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">-->

    <!-- Bootstrap -->
    <link href="<?php echo url()?>public/css/libs/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo url() ?>public/css/libs/bootstrap-dialog.css" media="all" rel="stylesheet"
          type="text/css"/>

    <!-- Select2 -->
    <link href="<?php echo url()?>public/css/libs/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo url()?>public/css/jquery.dataTables.css">
    <!-- styles -->
    <link href="<?php echo url()?>/public/css/app.bundle.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <style>
        html {
            height: 100%;
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            position: relative;
            margin: 0;
            padding-bottom: 6rem;
            min-height: 100%;
            font-family: "Helvetica Neue", Arial, sans-serif;
        }

        li {
            list-style: none;
        }

        span.glyphicon-remove {
            color: red;
            margin-left: 10px;
        }

        span.glyphicon-remove:hover {
            cursor: pointer;
        }

        .btn-default {
            margin-left: 10px;
        }

        #fileSelect {
            margin: 10px
        }

        #fileSelect:hover {
            cursor: pointer;
        }

        /*.row {*/
        /*border: 1px dashed #aaa;*/
        /*border-radius: 4px;*/
        /*padding: 20px;*/
        /*}*/

        #fileList {
            display: none;
            border: 1px dashed #aaa;
            border-radius: 4px;
        }

        #attached li {
            margin: 5px 0;
        }

        footer {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            text-align: center;
        }

    </style>
</head>
<body>
<?php require ('top_panel.php') ?>
<div class="page-content">
    <div class="row">

