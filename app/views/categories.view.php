<?php

//$mergeArr = $folders;//array_merge($folders, $posts, $files);
$sumAmount = 0;
//echo count((array)$mergeArr);
//dd($mergeArr);
if ($current_folder != 'category') {
    if ($current_folder == $department_name) {
        $nav .= ' > <a href="' . uri() . 'category">Категории</a>';
        $nav .= ' > <span>' . $current_folder . ' </span>';
    } else {
        $nav .= '> <a href="' . uri() . 'category">Категории</a> > <a href="' . uri() . 'category/' . $department_name . '"> ' . $department_name . '</a> > <span> ' . $current_folder . ' </span>';

    }
} else {
    $nav = ' > <a href="' . uri() . 'category">Категории</a>';
}

//usort($mergeArr, function ($a, $b) {
    //return $a->sort_number - $b->sort_number;
//});

?>

<?php $title = 'Документи'?>
<?php require('partials/header.php') ?>


<?php if (count((array)$folders) > 1): ?>
    <style>
        #category_table{
            background-color:#FFFFE6;
        }
        .warning {
            background-color: #F99;
        }
    </style>
    <h4>Категории</h4>
    <div class="spacer-big"></div>
    <table id="category_table" class="display responsive no-wrap" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Име</th>
            <th>Дата</th>
        </tr>
        </thead>
        <?php foreach ($folders as $ma): ?>
            <?php if($ma->sort_number == null) continue ?>
            <tr>
                <?php if ($ma->category_id): ?>
                    <td><?= $ma->sort_number?></td>
                    <td><i style="margin-right: 5px" class="glyphicon glyphicon-folder-open"></i>

                        <a href="<?= url() . ($current_folder == 'category' ? $current_folder : ($department_name == $current_folder ? 'category/' . $current_folder : 'category/' . $department_name . '/' . $current_folder)) . '/' . str_replace(' ', '+', $ma->name) ?>"><?= $ma->name ?></a>
                    </td>
                    <td><?= $ma->modified?></td>
                <?php endif; ?>

        <?php endforeach; ?>
    </table>

<?php else:?>
    <h4>Не са открити документи!</h4>
<?php endif ?>
<?php require 'partials/footer.php'; ?>

<?php if (isset($_SESSION['file_error'])): ?>
    <script>
        BootstrapDialog.show({
            type: BootstrapDialog.TYPE_WARNING,
            title: 'Внимание',
            message: '<?=$_SESSION['file_error']?>'
        });
    </script>';
<?php endif; ?>
<?php unset($_SESSION['file_error']); ?>

