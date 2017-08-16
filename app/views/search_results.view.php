<?php require('partials/header.php') ?>
<style>
    .table tbody > tr > td.vert-align {
        vertical-align: middle;
    }

    /*.spacer-bg {*/
    /*margin:5%;*/
    /*}*/
</style>
<div class="row">
    <div class="col-md-14">
    <h3>Резултати от Вашето търсене:</h3>
<div class="spacer-sm"></div>
    <div id="table_res" style="margin-top: 20px">

        <table id="example" class="display" cellspacing="5" width="100%">
            <thead>
            <tr>
                <th>Име на файла</th>
                <th>Описание</th>
                <th>Добавен от:</th>
                <th>Дата</th>
                <th>Звено</th>
                <th>Пространство</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($search_results as $search_result): ?>
            <tr>
                <td><a class="no-style" href="<?php echo url()?>files?<?= $search_result['stored_filename']?>&<?= $search_result['original_filename']?>"><?=$search_result['original_filename']?></a></td>
                <td><?=$search_result['label']?></td>
                <td><?=$search_result['name']?></td>
                <td><?=$search_result['modified']?></td>
                <td><?=$search_result['zveno']?></td>
                <td><?=$search_result['folder']?></td>
            </tr>
            <?php endforeach;?>

            </tbody>
        </table>
    </div>
    </div>
</div>

<?php require 'partials/footer.php';?>
<script>
    $('#example').DataTable();
</script>