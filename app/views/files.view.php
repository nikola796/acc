<?php require('partials/header.php') ?>
<?php if ($folders[0]->name): ?>
    <h5>Папки към <?= $current_folder ?></h5>


    <ul>

        <?php foreach ($folders as $folder): ?>
            <li>
                <a href="http://localhost/intranet_test/<?= str_replace(' ', '+', $folder->name) ?>/Файлове/<?= $folder->category_id ?>"><?= $folder->name ?></a>
            </li>
        <?php endforeach ?>
    </ul>

    <hr>
<?php endif; ?>

<?php if (count($posts) > 0): ?>
    <h5>Постове към <?= $current_folder ?></h5>


    <ul>

        <?php foreach ($posts as $post): ?>
            <li><?= parser()->qParse(htmlspecialchars($post->post)) ?></li>
            <?php foreach ($files as $file): ?>
                <?php if ($file->post_id == $post->id): ?>
                    <p><a href="http://localhost/intranet_test/public/files/<?= $file->name ?>"><?= $file->label ?></a>
                    </p>
                <?php endif ?>
            <?php endforeach ?>
        <?php endforeach ?>
    </ul>
<?endif ?>

<?php foreach ($files as $file): ?>

    <?php if ($file->post_id === null): ?>
        <h5>Файлове към <?= $current_folder ?></h5>


        <ul>

            <?php foreach ($files as $file): ?>
                <?php if ($file->post_id === null): ?>
                    <li><a href="http://localhost/intranet_test/public/files/<?= $file->name ?>"><?= $file->label ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
    <?php break ?>
<?php endforeach ?>


<?php require 'partials/footer.php';
