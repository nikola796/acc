<?php
    require_once 'core/HTML/BBCodeParser2.php';
    $options = @parse_ini_file('core/BBCodeParser.ini');
    //var_dump($options);
    $parser = new HTML_BBCodeParser2($options);
?>
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
    <link href="http://localhost/intranet_test/public/css/libs/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="http://localhost/intranet_test/public/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="http://localhost/intranet_test/public/css/styles.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://localhost/intranet_test/public/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="http://localhost/intranet_test/public/js/fileinput.js" type="text/javascript"></script>
    <script src="http://localhost/intranet_test/public/js/locales/bg.js" type="text/javascript"></script>
    <script src="http://localhost/intranet_test/public/js/locales/es.js" type="text/javascript"></script>
    <script src="http://localhost/intranet_test/public/themes/explorer/theme.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

</head>
<body>
<div class="container">

    <?php if($review):?>

        <div style="border: solid 1px orange; padding:20px; margin: 20px">

            <?= $review ?>

        </div>
    <?php endif;?>

    <div class="row">
        <div id="callout-formgroup-inputgroup" class="bs-callout bs-callout-warning">
            <h4 class="bg-success">Добавете текст в полето по-долу.Може да използвате bbcode за да стилизирате текста си.</h4>
        </div>


        <form action="http://localhost/intranet_test/public/upload.php" method="post">
    <div class="form-group">
        <textarea id="text" class="form-control" placeholder="Textarea" rows="4" name="text"></textarea>
</div>
    <div class="form-group">
    <input id="file" name="file-fr" type="file">
    </div>
    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">Описание на файла:</span>
        <input type="text" name="label" class="form-control" id="label" aria-describedby="basic-addon3">
    </div>
    </div>
            <div class="form-control file-caption  kv-fileinput-caption" tabindex="500">
                <div class="file-caption-name"></div>
            </div>


            <div class="input-group-btn">
                <button class="btn btn-default fileinput-remove fileinput-remove-button" title="Изчисти избраните" tabindex="500" type="button"><i class="glyphicon glyphicon-trash"></i>  <span class="hidden-xs">Премахни</span></button>
                <button class="btn btn-default hide fileinput-cancel fileinput-cancel-button" title="Откажи качването" tabindex="500" type="button"><i class="glyphicon glyphicon-ban-circle"></i>  <span class="hidden-xs">Откажи</span></button>
                <a class="btn btn-default fileinput-upload fileinput-upload-button" title="Качи избраните файлове" tabindex="500" href="http://localhost/intranet_test/public/upload.php"><i class="glyphicon glyphicon-upload"></i>  <span class="hidden-xs">Качи</span></a>
                <div class="btn btn-primary btn-file" tabindex="500"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;  <span class="hidden-xs">Избери …</span><input type="file" name="file-fr" id="file"></div>
            </div>

            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" id="InputFile" name="myfile">
            </div>

            <div class="btn btn-primary btn-file" tabindex="500">
                <i class="glyphicon glyphicon-folder-open"></i>
                <span class="hidden-xs">Избери …</span>
                <input id="file" type="file" name="file-fr">
            </div>

            <div class="text-center">
        <button type="submit" class="btn btn-default" name="view">Прегледай</button> <button type="submit" class="btn btn-primary" name="save">Запази</button>
    </div>
</form>
</div>
</div>"
</body>
<script>
    $('#file').fileinput({
        language: 'bg',
        uploadUrl: 'http://localhost/intranet_test/public/upload.php',
        allowedFileExtensions: ['jpg', 'png', 'gif', 'txt', 'doc', 'docx', 'pdf', 'zip', 'rar'],
        uploadExtraData: function() {
            return {
                label: $("#label").val(),
                text: $("#text").val()
            };
        }
    });
</script>
</html>