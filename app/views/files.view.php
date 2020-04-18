<?php

$mergeArr = array_merge($folders, $posts, $files);
$sumAmount = 0;
$nav = '';
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

usort($mergeArr, function ($a, $b) {
    return $a->sort_number - $b->sort_number;
});

?>

<?php $title = 'Документи'?>
<?php require('partials/header.php') ?>


<?php if (count((array)$mergeArr[0]) > 1): ?>
<style>
    #example{
        background-color:#FFFFE6;
    }
    .warning {
        background-color: #F99;
    }
</style>
<h4><?= ($current_folder == 'category' ? 'Категории' : ($posts ? 'Записи към ' .$current_folder : 'Категории към ' .$current_folder)) ?></h4>
<div class="spacer-big"></div>
        <table id="example" class="display responsive no-wrap" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Име</th>
                <th>Дата</th>
               <?php if ($posts) {
                            echo '<th>Стойност</th>';
                        }
               ?>
            </tr>
            </thead>
            <?php foreach ($mergeArr as $ma): ?>
                <?php if($ma->sort_number == null) continue ?>
                <tr>
                    <?php if ($ma->category_id): ?>
                        <td><?= $ma->sort_number?></td>
                        <td><i style="margin-right: 5px" class="glyphicon glyphicon-folder-open"></i>

                            <a href="<?= url() . ($current_folder == 'category' ? $current_folder : ($department_name == $current_folder ? 'category/' . $current_folder : 'category/' . $department_name . '/' . $current_folder)) . '/' . str_replace(' ', '+', $ma->name) ?>"><?= $ma->name ?></a>
                        </td>
                    <td><?= $ma->modified?></td>
                    <?php endif; ?>
                    <?php if (isset($ma->post)) {

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
                        $sumAmount+= $ma->amount / 100;
                        echo '</td><td>'.$ma->modified.'</td><td>'. $ma->amount / 100 .'</td>';
                    }
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
            <?php if ($posts) echo '<tr><td>0</td><td>Total:</td><td></td><td>'. $sumAmount .'</td></tr>' ?>
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

