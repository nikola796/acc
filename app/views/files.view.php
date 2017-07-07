<?php require('partials/header.php') ?>

<?php if ($folders[0]->name): ?>
    <h5>Папки към <?= $current_folder ?></h5>


    <ul>

        <?php foreach ($folders as $folder): ?>
            <li>
                <a href="<?php echo url()?><?= str_replace(' ', '+', $folder->name) ?>/Файлове/<?= $folder->category_id ?>"><?= $folder->name ?></a>
            </li>
        <?php endforeach ?>
    </ul>
    <hr />
<?php endif; ?>

<?php if (count($posts) > 0): ?>
    <h5>Постове към <?= $current_folder ?></h5>


    <ul>

        <?php foreach ($posts as $post): ?>

            <li><?= $post->post ?></li>   <!-- OLD VERSION -> parser()->qParse(htmlspecialchars($post->post)) -->
            <?php foreach ($files as $file): ?>
                <?php if ($file->post_id == $post->id): ?>
                    <p style="margin-left:5px"><a href="<?php echo url()?>files?<?= $file->stored_filename ?>&<?= $file->original_filename ?>"><?= $file->label ?></a>
                    </p>
                <?php endif ?>
            <?php endforeach ?>

        <?php endforeach ?>
    </ul>
    <hr />
<?endif ?>

<?php foreach ($files as $only_files): ?>

    <?php
    if ($only_files->post_id == null) {
        $msg = '<h5>Файлове към ' . $current_folder . '</h5>';
        break;
    } else{
        $msg = '';
    }
    ?>

<?php endforeach ?>
<?php if(strlen($msg) > 0):?>
    <?= $msg ?>
    <ul>

        <?php foreach ($files as $file): ?>
            <?php if ($file->post_id === null): ?>
                <li><a href="<?php echo url()?>files?<?= $file->stored_filename ?>&<?= $file->original_filename ?>"><?= $file->label ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach ?>
    </ul>
    <hr />
<?php endif?>
<?php require 'partials/footer.php';
