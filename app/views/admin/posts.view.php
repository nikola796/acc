<?php require('partials/header.php') ?>
<?php
if(isset($_SESSION['update_post'])){
    foreach ($_SESSION['update_post'] as $res){
        $r .= '\n' . $res;

    }

}

//unset($_SESSION['update_post']);
//$r = '';
//$msg = 'Премахнахте файл: '.implode(', ', $_SESSION['tt']);
//var_dump($r);
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

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
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
                                                <option value="0">Главна директория</option>
                                                <?php foreach ($folders as $folder): ?>

                                                    <option value="<?= $folder->category_id ?>"><?= $folder->name ?></option>
                                                <?php endforeach; ?>
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
                            <?php foreach ($folders as $folder): ?>
                                <option value="<?= $folder->category_id ?>"><?= $folder->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">

                        <input type="button" class="form-control btn-info" id="addAnotherFile" value="Добави файл"/>

                    </div>
                    <div id="attachedFiles">

                    </div>


                    <div class="spacer-bg"></div>
                    <div class="text-center">
                        <!--                <button type="submit" class="btn btn-default" id="view_post" name="view">Прегледай</button>-->
                        <button type="submit" class="btn btn-primary" name="save" id="submit_form" value="1">Запази</button>
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

                            <!--                    <div class="panel-options">-->
                            <!--                        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>-->
                            <!--                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>-->
                            <!--                    </div>-->
                        </div>

                        <div id="posts_div" style="display: none" class="content-box-large box-with-header">
                            <?php if(count($posts) > 0): ?>
                            <div class="panel-body">
                                <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                    <table id="example" class="table table-striped table-bordered dataTable" border="0"
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
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_body">
                                        <?php foreach ($posts as $post): ?>
                                            <tr>
                                                <td class="post"><?= $post->post ?></td>
                                                <td class="attachment"><?= ($post->attachment == 1 ? 'Да' : 'He') ?></td>
                                                <td class="post_folder"><input type="hidden" name="post_folder_id" class="post_folder_id"
                                                                               value="<?= $post->directory ?>"><?= $post->folder ?></td>
                                                <td> <input type="hidden" name="post_id" class="user_post_id" value="<?= $post->id ?>" /><span
                                                            class="role"><?= $post->username ?></span></td>
                                                <td><input type="hidden" name="access_id" class="access_id"
                                                           value="<?= $ura->access_id ?>"><span
                                                            class="access"><?= ($post->added_when ? date('Y-m-d H:i:s', $post->added_when) : '') ?></span>
                                                </td>
                                                <td class=""><span class="name"><?= $post->modified ?></span></td>
                                                <td class=""><span class="name"><?= $post->label ?></span></td>
                                                <td class="name"><span class="name"><?= $post->file_name ?></span>
                                                <input type="hidden" name="file_id" class="file_id" value="<?= $post->file_id ?>">
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
                                <?php else:?>
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

                            <!--                    <div class="panel-options">-->
                            <!--                        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>-->
                            <!--                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>-->
                            <!--                    </div>-->
                        </div>
                        <div id="files_div" style="display: none" class="content-box-large box-with-header">
                            <?php if(count($files) > 0): ?>
                            <div class="panel-body">
                                <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                    <table id="files" class="table table-striped table-bordered dataTable" border="0"
                                           cellspacing="0" cellpadding="0" aria-describedby="example_info">
                                        <!--                                <div>-->
                                        <!--                                    <label>-->
                                        <!--                                        <input type="checkbox" id="all_check"> Включи деактивираните потребители-->
                                        <!--                                    </label>-->
                                        <!--                                </div>-->
                                        <thead>
                                        <tr>
                                            <th>Описание</th>
                                            <th>Име на файла</th>
                                            <th>Добавен от:</th>
                                            <th>Папка</th>
                                            <th>Добавен на:</th>
                                            <th>Публикация към файла</th>
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
                                                           value=""><span class="role"><?= $file->folder ?></span></td>
                                                <td>
                                                    <span class="access"><?= $file->file_added_when ?></span>
                                                </td>
                                                <td class="name"><span class="name"><?= $file->post ?></span></td>
                                                <td class="vert-align">
                                                    <div class="text-center">
                                                        <button title="Редактирай" id="<?= $file->id ?>"
                                                                class="btn btn-primary btn-xs file_id">
                                                            <i class="glyphicon glyphicon-pencil"></i>
                                                        </button>
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
                            <?php else:?>
                            <p>Няма добавени файлове</p>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="<?php echo url()?>vendor/ckeditor/ckeditor/ckeditor.js"></script>


<?php require('partials/footer.php') ?>
    <script>

        CKEDITOR.replace( 'text' );

    </script>
    <link href="<?php echo url() ?>public/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

    <!--    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
    <!---->
    <!--    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">-->

    <script src="<?php echo url() ?>public/datatables/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo url() ?>public/datatables/dataTables.bootstrap.js"></script>
    <script src="<?php echo url() ?>/public/js/posts.js"></script>
    <script>

    </script>
    <script>



        $('#posts').addClass('current');
        <?php if(isset($_SESSION['update_post'])):?>
       BootstrapDialog.alert({
           type: BootstrapDialog.TYPE_SUCCESS,
           title: 'Успех',
           message: '<?=$r?>'
       });
       <?php  unset($_SESSION['update_post']);?>
       <?php endif;?>
        var dataTable = $('#example,#files').DataTable();
        //    $(document).on('submit', 'form', function(e){
        //        e.preventDefault()
        //        console.log('Form is Submitted')
        //    })
        //BootstrapDialog.alert('test');
<?php
        if (isset($_SESSION['add_new_file_post'])) {

            echo " BootstrapDialog.alert({
                                type: BootstrapDialog.TYPE_SUCCESS,
                                title: 'Успех',
                                message: '";
            foreach ($_SESSION['add_new_file_post'] as $msg) {
                echo $msg . '<br />';
            }
            echo "'})";

            unset($_SESSION['add_new_file_post']);
        }
        ?>
//         if (isset($_SESSION['update_post'])) {
//

//
//           unset($_SESSION['update_post']);
//        }
        $(document).on('click', '.file_id', function(){
            console.log($(this).attr('id'));
        })

        $(document).on('click', '.del_file', function(){
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: 'delete-file',
                data: {file_id: id}
            }).done(function (data) {
                console.log(data);
                var msg = '';
                if(data >= 1){
                    msg = 'Успешно премахнахте файл';

                } else {
                    msg = 'Възникна проблем с изтриване на файла';
                }

                BootstrapDialog.alert({
                    type: BootstrapDialog.TYPE_SUCCESS,
                    title: 'Успех',
                    message: msg,
                    onhide: function(dialogRef){
                        window.location.reload(true);
                    }
                })
            })
        })

        $(document).on('click', '.del_post', function(){
            var post_id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: 'delete-post',
                data: {post_id: post_id}
            }).done(function (data) {
                if(data.data.del_post == 1){
                    var msg = 'Успешно изтрихте публикацията';

                    if(data.data.del_file == 1){
                        msg += ' и файла към нея!'
                    } else if(data.data.del_file > 1){
                        msg += ' и файловете към нея!'
                    }

                } else{
                    msg = 'Възникна проблем. Моля опитайте по-късно';
                }
                    BootstrapDialog.alert({
                        type: BootstrapDialog.TYPE_SUCCESS,
                        title: 'Успех',
                        message: msg,
                        onhide: function(dialogRef){
                            window.location.reload(true);
                        }
                    });

                console.log(data.data.del_post);
            })
        });

        $(document).on('click', '.post_id', function(){
            var post_id = $(this).closest('tr').find('input.user_post_id').val();
            var post = $(this).closest('tr').find('td:eq(0)').html();
            var attached = $(this).closest('tr').find('td:eq(1)').text();
            $('#folder').val('');
            $('#folder').val($(this).closest('tr').find('input.post_folder_id').val()).trigger('change');
            CKEDITOR.instances['text'].setData(post)
            //$('#cke_1_contents').html(post);
            $('#attachedFiles').html('<input type="hidden" name="postId" value="'+ post_id +'" />');
            if(attached == 'Да'){
                var file_label = $(this).closest('tr').find('td:eq(6)').text().split('; ');
                console.log(file_label);
                var file_name = $(this).closest('tr').find('td:eq(7)').text().split('; ');
                var file_id =  $(this).closest('tr').find('input.file_id').val().split('; ');


                $('#attachedFiles').append('<strong><span>Файлове към публикацията:</span></strong><div class="spacer-sm"></div>')
               $.each(file_label, function(i, v){
                   $('#attachedFiles').append('<div class="form-inline"><span style="float:left" class="file_name">Име на файла: <strong class="file_name_txt">' + file_name[i] + '</strong> </span><input class="attached_files_id" type="hidden" name="file_id[]" value="'+file_id[i]+'"><span style="margin-left:5%">Описание на файла: <strong>' + v + '</strong></span> <span class="glyphicon glyphicon-remove"></span> <br /></div>');
                   $('#attachedFiles').append('<div class="spacer-sm"></div>');
                   // console.log('Описание на файла: ' + v + '; Име на файла: '+ file_name[i])
                });

            }

            $('#submit_form').text('Обнови');
            $('#submit_form').val(2);
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;

        });

        $(document).on('change', '.select_file', function(){
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
$('#folder').select2();
    </script>

<?php require("partials/bottom.php");