<?php $title = 'Документи'?>
<?php require('partials/header.php') ?>
<div class="text-center"><h4>Дирекции</h4><hr /></div>


<ul style="list-style-type: none;line-height: 200%;">

    <?php foreach ($departments as $department): ?>

        <li><a href="documents/<?= $department->id ?>"><?= $department->name ?></a></li>

    <?php endforeach;?>

</ul>


<?php require('partials/footer.php') ?>