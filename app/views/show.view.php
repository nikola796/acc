<?php $title = 'Дирекция "'. $dep .'"'?>
<?php require 'partials/header.php';?>

    <div class="text-center"><h4>Дирекция "<?= $dep ?>"</h4></div>
<p>Папки</p>
<ul style="list-style-type: none;line-height: 200%;">

    <?php foreach ($folders as $document): ?>

        <li><a href="<?php echo url()?>/<?= str_replace(' ', '+', $document->name)?>/Файлове/<?= $document->category_id?>"><?= $document->name ?></a></li>

    <?php endforeach; ?>

</ul>
<?php if(count($posts) > 0 ): ?>
    <p>Публикации:</p>
    <ul style="list-style-type: none;line-height: 200%;">

        <?php foreach ($posts as $post): ?>

            <li> <?= parser()->qParse(htmlspecialchars($post->post)) ?></li>

        <?php endforeach; ?>

    </ul>
<?php endif;?>

<?php require 'partials/footer.php';