<?php
//include_once "core/init.inc.php";
//
//if (!empty($_POST['text'])){
//
//    die();
//
//    echo '<div style="border: solid 1px orange; padding:20px; margin: 20px">';
//
    require_once 'core/HTML/BBCodeParser2.php';
    $options = @parse_ini_file('core/BBCodeParser.ini');
    //var_dump($options);
    $parser = new HTML_BBCodeParser2($options);
//    echo $parser->qParse(htmlspecialchars($_POST['text']));
//
//    echo '</div>';
//}
//?>
<!doctype html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php if($review):?>

    <div style="border: solid 1px orange; padding:20px; margin: 20px">

        <?= $review ?>

    </div>
<?php endif;?>

<form action="" method="post">
    <textarea name="text" style="width: 300px; height: 200px"><?php echo @$_POST['text']; ?></textarea>
    <br />
    <input type="submit" name="view" value="Преглед" /><input type="submit" name="save" value="Запази" />





</form>

<ul>

    <?php foreach ($posts as $post):?>

    <li><?=  $parser->qParse(htmlspecialchars($post->post))?></li>

    <?php endforeach;?>

</ul>



</body>
</html>
