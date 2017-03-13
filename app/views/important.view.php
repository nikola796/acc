<?php require 'partials/header.php';?>

    <div class="text-center"><div align="left"><a href="http://10.30.1.5/index.php?username=am&password=4477505d28284bd99a6ff73574d51d0b&ph=1" target="_blank" class="style1"><img src="public/images/Apis7.png" width="150" height="80">
            </a>
            &nbsp;&nbsp;&nbsp;<a href="http://79.124.14.51/lakorda/?i=1" target="_blank" class="style1"><img src="public/images/lacorda.png" width="140" height="45" >
            </a>
            &nbsp;&nbsp;&nbsp;<a href="ss6.php?main=mkc"><img src="public/images/ucc_spotlight.png" width="140" height="70" alt="Митнически кодекс на Съюза" title="Митнически кодекс на Съюза">
            </a>
        </div></div>
    <ul style="list-style-type: none;line-height: 200%;margin-top: 10px">

        <?php foreach ($important_documents as $document): ?>

            <li><a href="http://localhost/intranet_test/public/files/<?= $document->name?>" download="" target="_blank"><?= $document->label ?></a></li>

        <?php endforeach; ?>

    </ul>



<?php require 'partials/footer.php';?>