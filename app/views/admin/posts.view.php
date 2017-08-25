<?php require('partials/header.php') ?>
<?php
if (isset($_SESSION['update_post'])) {
    foreach ($_SESSION['update_post'] as $res) {
        $r .= '\n' . $res;

    }
echo '<script>alert('.$r.')</script>';
}
var_dump($_SESSION['update_post']);
//unset($_SESSION['update_post']);
//$r = '';
//$msg = 'Премахнахте файл: '.implode(', ', $_SESSION['tt']);
//var_dump($r);
 //dd($files)
?>
    <style>
        .table tbody > tr > td.vert-align {
            vertical-align: middle;
        }

        /*.spacer-bg {*/
        /*margin:5%;*/
        /*}*/
    </style>
    <div class="col-md-10" style="margin-bottom: 50px;">
        <div class="content-box-large">
            <div class="panel-heading">
                <div class="panel-title"><h4 class="text-center">Нова публикация</h4>
                </div>
            </div>
            <div class="panel-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <div id="callout-formgroup-inputgroup" class="bs-callout bs-callout-warning">

                    </div>
                    <div class="form-group">
                        <textarea cols="80" id="text" name="text" rows="10" placeholder="Място за текст"></textarea>
                    </div>

                    <div class="form-group">
                        <span class="form-control-static"><strong>Изберете от списъка в коя папка да бъде Вашата публикация.</strong></span>

                        <span class="form-control-static"><strong>Или създайте </strong></span>
                        <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Нова папка</button> -->
                        <a href="#" id="mod"><strong>Нова папка</strong></a>
                        <!-- Modal -->

                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Нова папка</h4>
                                    </div>
                                    <div id="sel" class="modal-body">
                                        <div class="form-group">
                                            <label for="folderName">Име на новата папка</label>
                                            <input type="text" class="form-control" id="newFolderName"
                                                   placeholder="Наименование">
                                        </div>
                                        <div class="form-group">
                                            <label for="folderName">Място на новата папка</label>
                                            <select name="folder" id="perentFolder" class="form-control">
                                                <?= ($_SESSION['role'] == 1 ? '<option value="0">Главна директория</option>' : '') ?>
                                                <?php foreach ($folders as $folder): ?>

                                                    <option value="<?= $folder->category_id ?>"><?= $folder->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="sorting">Поредност на показване</label>
                                            <select id="sort_number_new_folder" name="sorting" class="form-control">

                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Отказ
                                        </button>
                                        <button type="button" id="createFolder" class="btn btn-primary">Запази</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Modal -->

                    </div>


                    <div id="perentFolders" class="form-group">
                        <select name="folder" class="form-control" id="folder">
                            <?= ($_SESSION['role'] == 1 ? '<option value="0">Главна директория</option>' : '') ?>
                            <?php foreach ($folders as $folder): ?>
                                <option value="<?= $folder->category_id ?>"><?= $folder->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="sort_number_div" class="form-group">
                        <label for="sort_number">Ще се показва в папаката на ред:</label>
                        <select name="sort_number" class="form-control" id="sort_number">
                        </select>
                        <div id="old_sort_number"></div>
                    </div>
                    <div class="spacer-bg"></div>
                    <div class="form-group">

                        <input type="button" class="form-control btn-info" id="addAnotherFile" value="Добави файл"/>

                    </div>
                    <div id="attachedFiles">

                    </div>


                    <div class="spacer-bg"></div>
                    <div class="text-center">
                        <!--                <button type="submit" class="btn btn-default" id="view_post" name="view">Прегледай</button>-->
                        <button type="submit" class="btn btn-primary" name="save" id="submit_form" value="1">Запази
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12" id="accordion">
                        <div class="content-box-header panel-heading">
                            <div class="panel-title "><a style="text-decoration: none" id="allPosts" href="#">Всички
                                    публикации</a></div>
                        </div>

                        <div id="posts_div" style="display: none" class="content-box-large box-with-header">
                            <?php if (count($posts) > 0): ?>
                                <div class="panel-body">
                                    <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                        <table id="example" class="table table-striped table-bordered dataTable"
                                               border="0"
                                               cellspacing="0" cellpadding="0" aria-describedby="example_info">
                                            <thead>
                                            <tr>
                                                <th>Публикация</th>
                                                <th>Прикачен файл</th>
                                                <th>Папка</th>
                                                <th>Добавен от:</th>
                                                <th>Добавен на:</th>
                                                <th>Последна промяна:</th>
                                                <th>Файл описание</th>
                                                <th>Файл име</th>
                                                <th>Поредност в папката</th>
                                                <th>Действия</th>
                                            </tr>
                                            </thead>
                                            <tbody id="table_body">
                                            <?php foreach ($posts as $post): ?>
                                                <tr>
                                                    <td class="post"><?= $post->post ?></td>
                                                    <td class="attachment"><?= ($post->attachment == 1 ? 'Да' : 'He') ?></td>
                                                    <td class="post_folder"><input type="hidden" name="post_folder_id"
                                                                                   class="post_folder_id"
                                                                                   value="<?= $post->directory ?>"><?= $post->folder ?>
                                                    </td>
                                                    <td><input type="hidden" name="post_id" class="user_post_id"
                                                               value="<?= $post->id ?>"/><span
                                                                class="role"><?= $post->username ?></span></td>
                                                    <td><input type="hidden" name="access_id" class="access_id"
                                                               value="<?= $ura->access_id ?>"><span
                                                                class="access"><?= ($post->added_when ? date('Y-m-d H:i:s', $post->added_when) : '') ?></span>
                                                    </td>
                                                    <td class=""><span class="name"><?= $post->modified ?></span></td>
                                                    <td class=""><span class="name"><?= $post->label ?></span></td>
                                                    <td class="name"><span class="name"><?= $post->file_name ?></span>
                                                        <input type="hidden" name="file_id" class="file_id"
                                                               value="<?= $post->file_id ?>">
                                                    </td>
                                                    <td class=""><span
                                                                class="sort_number"><?= $post->sort_number ?></span>
                                                    </td>
                                                    <td class="vert-align">
                                                        <div class="text-center">
                                                            <button title="Редактирай" id="<?= $post->id ?>"
                                                                    class="btn btn-primary btn-xs post_id">
                                                                <i class="glyphicon glyphicon-pencil"></i>
                                                            </button>
                                                            <button title="Премахни" id="<?= $post->id ?>"
                                                                    class="btn btn-danger btn-xs del_post">
                                                                <i class="glyphicon glyphicon-remove"></i>

                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            <?php else: ?>
                                <p>Няма добавени публикации.</p>
                            <?php endif; ?>
                        </div>


                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="accordion2">
                        <div class="content-box-header panel-heading">
                            <div class="panel-title "><a style="text-decoration: none" id="allFiles" href="#">Всички
                                    файлове</a></div>
                        </div>
                        <div id="files_div" style="display: none" class="content-box-large box-with-header">
                            <?php if (count($files) > 0): ?>
                                <div class="panel-body">
                                    <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                        <table id="files" class="table table-striped table-bordered dataTable"
                                               border="0"
                                               cellspacing="0" cellpadding="0" aria-describedby="example_info">
                                            <thead>
                                            <tr>
                                                <th>Описание</th>
                                                <th>Име на файла</th>
                                                <th>Добавен от:</th>
                                                <th>Папка</th>
                                                <th>Добавен на:</th>
                                                <th>Публикация към файла</th>
                                                <th>Поредност в папката</th>
                                                <th>Действия</th>
                                            </tr>
                                            </thead>
                                            <tbody id="table_body">

                                            <?php foreach ($files as $file): ?>
                                                <tr>
                                                    <td class="file_label"><?= $file->label ?></td>
                                                    <td class="file_name"><?= $file->original_filename ?></td>
                                                    <td class="email"><?= $file->author ?></td>
                                                    <td><input type="hidden" name="folder_id" class="folder_id"
                                                               value=""><span class="role"><?= $file->folder ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="access"><?= $file->modified ?></span>
                                                    </td>
                                                    <td class="name"><span class="name"><?= $file->post ?></span></td>
                                                    <td class="sort_name"><span
                                                                class="name"><?= $file->sort_number ?></span></td>
                                                    <td class="vert-align">
                                                        <div class="text-center">
                                                            <button title="Премахни" id="<?= $file->id ?>"
                                                                    class="btn btn-danger btn-xs del_file">
                                                                <i class="glyphicon glyphicon-remove"></i>

                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            <?php else: ?>
                                <p>Няма добавени файлове</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="<?php echo url() ?>vendor/ckeditor/ckeditor/ckeditor.js"></script>


<?php require('partials/footer.php') ?>
    <script>


    </script>
    <link href="<?php echo url() ?>public/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

    <script src="<?php echo url() ?>public/datatables/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo url() ?>public/datatables/dataTables.bootstrap.js"></script>
    <script src="<?php echo url() ?>/public/js/posts.js"></script>
    <script>

    </script>
    <script>
        CKEDITOR.replace('text');
        $(document).on('click', 'form button[type=submit]', function(e) {
            //   alert($.each($('.uploaded_file').val()));

                  //  e.preventDefault(); //prevent the default action

            });
        $(document).ready(function () {
            //alert($('#perentFolders option:selected').val());
            $.ajax({
                url: 'get_sort_numbers',
                type: 'POST',
                data: {parent: $('#perentFolders option:selected').val()}
            }).done(function (data) {
                data++;
                $('#old_sort_number').html('<input type="hidden" name="default_sort_number" id="default_sort_number" value="' + data + '" />')
                var i;
                for (i = 1; i <= data; i++) {
                    $('#sort_number, #sort_number_new_folder').append('<option value="' + i + '">' + i + '</option>');
                }
                $('#sort_number, #sort_number_new_folder').val(data).prop('selected');


            });
        });
        $(document).on('change', '#perentFolder', function () {

            $('#sort_number_new_folder').html('');
            $.ajax({
                url: 'get_sort_numbers',
                type: 'POST',
                data: {parent: $('#perentFolder option:selected').val()}
            }).done(function (data) {
                data++;
                alert(data);
                var i;
                for (i = 1; i <= data; i++) {
                    $('#sort_number_new_folder').append('<option value="' + i + '">' + i + '</option>');
                }

                $('#sort_number_new_folder').val(data).prop('selected');

                $('#default_sort_number').val(data);

            });
            });
        var sort_num;
        $(document).on('change', '#perentFolders', function () {
            $('#sort_number').html('');
            //console.log(sort_num);
            $.ajax({
                url: 'get_sort_numbers',
                type: 'POST',
                data: {parent: $('#perentFolders option:selected').val()}
            }).done(function (data) {

                if ($('#submit_form').val() != 2 || sort_num.length == 0) {
                    data++;
                    $('#default_sort_number').val(data);
                }
                var i;

                for (i = 1; i <= data; i++) {
                    $('#sort_number').append('<option value="' + i + '">' + i + '</option>');
                }

                if ($('#submit_form').val() != 2) {
                    $('#sort_number').val(data).prop('selected');
                } else {

                    if(sort_num.length !== 0){
                        $('#sort_number').val(Number(sort_num)).prop('selected');
                        sort_num = '';

                    } else{

                        $('#sort_number').val(data).prop('selected');
                    }

                }
            });
        });

        $('#posts').addClass('current');

        <?php if(isset($_SESSION['update_post']) && count($_SESSION['update_post']) > 0):?>
        BootstrapDialog.alert({
            type: BootstrapDialog.TYPE_SUCCESS,
            title: 'Успех',
            message: '<?=$r?>'
        });
        <?php  unset($_SESSION['update_post']);?>
        <?php endif;?>
        var dataTable = $('#example,#files').DataTable();




  <?php      if (isset($_SESSION['add_new_file_post']) && count($_SESSION['add_new_file_post']) > 0) : ?>

   <?php

$message = '';
   foreach ($_SESSION['add_new_file_post'] as $k => $msg){
                     if($k == 'error'){
                    $type = "BootstrapDialog.TYPE_DANGER";
                    $title = 'Грешка';

                }elseif ($k == 'success' || $k == 'new_post'){
                    $type = "BootstrapDialog.TYPE_SUCCESS";
                    $title = "Успех";
                }
                $message .= $msg.'<br />';
   }
   ?>
//                if($k == 'error'){
//                    $type = 'BootstrapDialog.TYPE_DANGER';
//                    $title = 'Грешка';
//
//                }elseif ($k == 'success'){
//                    $type = 'BootstrapDialog.TYPE_SUCCESS';
//                    $title = 'Успех';
//                }
//                $msg = $msg;
//            }

             BootstrapDialog.alert({
                                type: <?= $type ?>,
                                title: "<?= $title ?>",
                                message: "<?= $message ?>"
                                });
<?php endif ?>
       <?php     unset($_SESSION['add_new_file_post'])?>


        $(document).on('click', '.file_id', function () {
            console.log($(this).attr('id'));
        })

        $(document).on('click', '.del_file', function () {
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: 'delete-file',
                data: {file_id: id}
            }).done(function (data) {
                console.log(data);
                var msg = '';
                if (data >= 1) {
                    msg = 'Успешно премахнахте файл';

                } else {
                    msg = 'Възникна проблем с изтриване на файла';
                }

                BootstrapDialog.alert({
                    type: BootstrapDialog.TYPE_SUCCESS,
                    title: 'Успех',
                    message: msg,
                    onhide: function (dialogRef) {
                        window.location.reload(true);
                    }
                })
            })
        })

        $(document).on('click', '.del_post', function () {
            var post_id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: 'delete-post',
                data: {post_id: post_id}
            }).done(function (data) {
                if (data.data.del_post == 1) {
                    var msg = 'Успешно изтрихте публикацията';

                    if (data.data.del_file == 1) {
                        msg += ' и файла към нея!'
                    } else if (data.data.del_file > 1) {
                        msg += ' и файловете към нея!'
                    }

                } else {
                    msg = 'Възникна проблем. Моля опитайте по-късно';
                }
                BootstrapDialog.alert({
                    type: BootstrapDialog.TYPE_SUCCESS,
                    title: 'Успех',
                    message: msg,
                    onhide: function (dialogRef) {
                        window.location.reload(true);
                    }
                });

                console.log(data.data.del_post);
            })
        });
        /**************** EDIT POST **********************************************************************/

        $(document).on('click', '.post_id', function () {
            //console.log("click");
            var post_id = $(this).closest('tr').find('input.user_post_id').val();
            var post = $(this).closest('tr').find('td:eq(0)').html();
            var attached = $(this).closest('tr').find('td:eq(1)').text();

            sort_num = $(this).closest('tr').find('td:eq(8)').text();
            $('#old_sort_number').html('<input type="hidden" id="sor_num" name="old_sort_number" value="' + sort_num + '" /><input type="hidden" id="old_parent" name="old_parent" value="' + $(this).closest('tr').find('input.post_folder_id').val() + '" />');

            console.log('Old number is: ' + sort_num);
            $('#folder').val('');
            $('#folder').val($(this).closest('tr').find('input.post_folder_id').val()).trigger('change');

            CKEDITOR.instances['text'].setData(post)
            //$('#cke_1_contents').html(post);
            $('#attachedFiles').html('<input type="hidden" name="postId" value="' + post_id + '" />');
            if (attached == 'Да') {
                var file_label = $(this).closest('tr').find('td:eq(6)').text().split('; ');
                //console.log(file_label);
                var file_name = $(this).closest('tr').find('td:eq(7)').text().split('; ');

                var file_id = $(this).closest('tr').find('input.file_id').val().split('; ');


                $('#attachedFiles').append('<strong><span>Файлове към публикацията:</span></strong><div class="spacer-sm"></div>')
                $.each(file_label, function (i, v) {
                    $('#attachedFiles').append('<div class="form-inline"><span style="float:left" class="file_name">Име на файла: <strong class="file_name_txt">' + file_name[i] + '</strong> </span><input class="attached_files_id" type="hidden" name="file_id[]" value="' + file_id[i] + '"><span style="margin-left:5%">Описание на файла: <strong>' + v + '</strong></span> <span class="glyphicon glyphicon-remove"></span> <br /></div>');
                    $('#attachedFiles').append('<div class="spacer-sm"></div>');
                    // console.log('Описание на файла: ' + v + '; Име на файла: '+ file_name[i])
                });

            }

            $('#submit_form').text('Обнови');
            $('#submit_form').val(2);
            $("html, body").animate({scrollTop: 0}, "slow");
            return false;

        });

        $(document).on('change', '.select_file', function () {
            //console.log( $(this).closest('div').find('span.file_name').html());
            $(this).closest('div').find('span.file_name').html('');
        })

        $('#allPosts').click(function (e) {
            e.preventDefault();
            $('#posts_div').toggle();
        });
        $('#allFiles').click(function (e) {
            e.preventDefault();
            $('#files_div').toggle();
        });
        $('#folder, #sort_number').select2();
    </script>

<?php require("partials/bottom.php");