<?php require('partials/header.php') ?>

    <h3>Файлове към <?= $files[0]->dir?></h3>
<ul>

<?php foreach($files as $file): ?>
    <li><a href="http://localhost/intranet_test/public/files/<?= $file->name ?>"><?= $file->label ?></a></li>
<?php endforeach ?>
</ul>
<?php require 'partials/footer.php';