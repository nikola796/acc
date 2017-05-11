<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <title>Krajee JQuery Plugins - &copy; Kartik</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="css/libs/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/plugins/sortable.js" type="text/javascript"></script>
    <script src="js/fileinput.js" type="text/javascript"></script>
    <script src="js/locales/bg.js" type="text/javascript"></script>
    <script src="js/locales/es.js" type="text/javascript"></script>
    <script src="themes/explorer/theme.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

</head>
<body>
<div class="container">
<!--<form enctype="multipart/form-data">-->
<!--    <input id="file-fr" name="file-fr[]" type="file" multiple>-->
<!---->
<!--</form>-->

    <div >
        <table id="example" class="table table-striped table-bordered dataTable" border="0" cellspacing="0" cellpadding="0" aria-describedby="example_info">
            <div>
                <label>
                    <input type="checkbox" id="all_check"> Включи деактивираните потребители
                </label>
            </div>
            <thead>
            <tr>
                <th>Потребител</th>
                <th>Поща</th>
                <th>Звено</th>
                <th>Роля</th>
                <th>Достъп</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            </thead>

        </table>
    </div>

</div>



</body>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script>

    $(document).ready(function() {
        //$('#example').DataTable();

        var dataTable = $('#example').DataTable( {
            "ajax": "<?php url()?>admin/users/"
        } );

    } );

//    $('#file-fr').fileinput({
//        language: 'bg',
//        uploadUrl: 'http://localhost/intranet_test/public/upload.php',
//        allowedFileExtensions: ['jpg', 'png', 'gif']
//    });
</script>
</html>