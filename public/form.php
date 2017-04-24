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
<form enctype="multipart/form-data">
    <input id="file-fr" name="file-fr[]" type="file" multiple>

</form>
</div>
</body>
<script>
    $('#file-fr').fileinput({
        language: 'bg',
        uploadUrl: 'http://localhost/intranet_test/public/upload.php',
        allowedFileExtensions: ['jpg', 'png', 'gif']
    });
</script>
</html>