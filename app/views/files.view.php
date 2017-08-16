<?php


$mergeArr = array_merge($folders, $posts, $files);
//echo count((array)$mergeArr);
//dd($mergeArr);
if ($current_folder != 'Документи') {
    if ($current_folder == $department_name) {
        $nav .= ' > <a href="' . uri() . 'Документи">Документи</a>';
        $nav .= ' > <span>' . $current_folder . ' </span>';
    } else {
        $nav .= '> <a href="' . uri() . 'Документи">Документи</a> > <a href="' . uri() . 'Документи/' . $department_name . '"> ' . $department_name . '</a> > <span> ' . $current_folder . ' </span>';

    }
} else {
    $nav = ' > <a href="' . uri() . 'Документи">Документи</a>';
}

usort($mergeArr, function ($a, $b) {
    return $a->sort_number - $b->sort_number;
});
//dd($mergeArr);
//echo '<pre>' . print_r($mergeArr, true) . '</pre>';die();
?>

<?php require('partials/header.php') ?>
<?php if ($current_folder == 'Важно'): ?>
    <a href="http://79.124.14.51/lakorda/?i=1" target="_blank" class="style1"><img
                src="<?= url() ?>public/images/lacorda.png" width="140" height="45">
    </a>
<?php endif ?>

<?php if (count((array)$mergeArr[0]) > 1): ?>
<style>
    #example{
        background-color:#FFFFE6;
    }
    .warning {
        background-color: #F99 !important;
    }
</style>
<h4>Ресурси към <?= $current_folder ?></h4>
<div class="spacer-big"></div>
        <table id="example" class="display responsive no-wrap" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Име</th>
                <th>Дата</th>
            </tr>
            </thead>
            <?php foreach ($mergeArr as $ma): ?>
                <?php if($ma->sort_number == null) continue ?>
                <tr>
                    <?php if ($ma->category_id): ?>
                        <td><?= $ma->sort_number?></td>
                        <td><i style="margin-right: 5px" class="glyphicon glyphicon-folder-open"></i>

                            <a href="<?= url() . ($current_folder == 'Документи' ? $current_folder : ($department_name == $current_folder ? 'Документи/' . $current_folder : 'Документи/' . $department_name . '/' . $current_folder)) . '/' . str_replace(' ', '+', $ma->name) ?>"><?= $ma->name ?></a>
                        </td>
                    <td><?= $ma->modified?></td>
                    <?php endif; ?>
                    <?php if ($ma->post) {

                        echo '<td>'.$ma->sort_number.'</td>';
                        echo '<td><i class="glyphicon glyphicon-pencil" style="float: left;margin-right: 5px"></i>' . $ma->post;
                        if ($ma->attachment == 1) {
                            foreach ($mergeArr as $k => $fma) {
                                if ($ma->id == $fma->post_id) {
                                    echo '<p style="margin-left:10px"><i style="margin-right: 2px" class="glyphicon glyphicon-file"></i><a href="' . url() . 'files?' . $fma->stored_filename . '&' . $fma->original_filename . '"</a>' . $fma->label . '</p>';
                                    $key[] = $k;
                                }
                            }
                        }
                        echo '</td><td>'.$ma->modified.'</td>';
                    }
                    //dd($mergeArr);
                    //echo '</td><td>'.$ma->modified.'</td>';
                    ?>

                    <?php if (isset($ma->stored_filename) && $ma->post_id === null): ?>
                        <td><?= $ma->sort_number?></td>
                        <td><i style="margin-right: 5px" class="glyphicon glyphicon-file"></i>
                            <a href="<?= url() ?>files?<?= $ma->stored_filename ?>& <?= $ma->original_filename ?>"><?= $ma->label ?></a>
                        </td>
                        <td>
                            <?= $ma->modified ?>
                        </td>
                    <?php endif; ?>
                </tr>
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

