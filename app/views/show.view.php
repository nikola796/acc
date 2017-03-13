
<?php require 'partials/header.php';?>

    <div class="text-center"><h4>Дирекция "<?= $documents[0]->dep ?>"</h4></div>
<ul style="list-style-type: none;line-height: 200%;">

    <?php foreach ($documents as $document): ?>

        <li><a href="/intranet_test/files/<?= $document->id?>"><?= $document->name ?></a></li>

    <?php endforeach; ?>

</ul>



<?php require 'partials/footer.php';