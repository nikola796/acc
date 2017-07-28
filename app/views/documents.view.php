<?php $title = 'Документи' ?>
<?php $nav = ' > <a href="'.uri().'Документи">Документи</a>'; ?>

<?php require('partials/header.php') ?>


    <div class="text-center"><h4>Пространства</h4>
        <hr style="color:aqua"/>
    </div>


    <ol style="line-height: 250%;">

        <?php foreach ($departments as $department): ?>

            <li><a href='Документи/<?= str_replace(' ', '+', $department->name) ?>'>
                    <i class="glyphicon glyphicon-folder-open" style="margin-right: 5px;"></i> <?= $department->name ?>
                </a></li>

        <?php endforeach; ?>

    </ol>



<?php require('partials/footer.php') ?>