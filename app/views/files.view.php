<?php

$mergeArr = array_merge($folders, $posts, $files);
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

?>



<?php require('partials/header.php') ?>
<?php if ($current_folder == 'Важно'): ?>
    <a href="http://79.124.14.51/lakorda/?i=1" target="_blank" class="style1"><img
                src="<?= url() ?>public/images/lacorda.png" width="140" height="45">
    </a>
<?php endif ?>

<?php if (count((array)$mergeArr[0]) > 1): ?>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Ресурси към <?= $current_folder ?></th>
            </tr>
            </thead>
            <?php foreach ($mergeArr as $ma): ?>
                <tr>
                    <?php if ($ma->category_id): ?>
                        <td>
                            <i style="margin-right: 3px" class="glyphicon glyphicon-folder-open"></i>
                            <a href="<?= url() . ($current_folder == 'Документи' ? $current_folder : ($department_name == $current_folder ? 'Документи/' . $current_folder : 'Документи/' . $department_name . '/' . $current_folder)) . '/' . str_replace(' ', '+', $ma->name) ?>"><?= $ma->name ?></a>
                        </td>
                    <?php endif; ?>
                    <?php if ($ma->post) {
                        echo '<td>';
                        echo '<i class="glyphicon glyphicon-pencil" style="float: left;margin-right: 5px"></i>' . $ma->post;
                        if ($ma->attachment == 1) {
                            foreach ($mergeArr as $fma) {
                                if ($ma->id == $fma->post_id) {
                                    echo '<p style="margin-left:10px"><i style="margin-right: 2px" class="glyphicon glyphicon-file"></i><a href="' . url() . 'files?' . $fma->stored_filename . '&' . $fma->original_filename . '"' . $fma->label . '</a></p>';

                                }
                            }
                        }
                    }
                    echo '</td>';
                    ?>

                    <?php if (isset($ma->stored_filename) && $ma->post_id === null): ?>
                        <td>
                            <i style="margin-right: 2px" class="glyphicon glyphicon-file"></i>
                            <a href="<?= url() ?>files?<?= $ma->stored_filename ?>& <?= $ma->original_filename ?>"><?= $ma->label ?></a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
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
