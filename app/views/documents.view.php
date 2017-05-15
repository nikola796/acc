<?php $title = 'Документи'?>
<?php require('partials/header.php') ?>


<div class="text-center"><h4>Дирекции, митници и самостоятелни звена</h4><hr /></div>


<ol style="line-height: 250%;">

    <?php foreach ($departments as $department): ?>

        <li><a href='Документи/<?= str_replace(' ', '+', $department->name) ?>'><?= $department->name ?></a></li>

    <?php endforeach;?>

</ol>


<?php require('partials/footer.php') ?>