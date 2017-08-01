<?php require('partials/header.php') ?>
<?php
if (isset($_SESSION['update_post'])) {
    foreach ($_SESSION['update_post'] as $res) {
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

        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        /*.spacer-bg {*/
        /*margin:5%;*/
        /*}*/
    </style>
    <div class="col-md-10" style="margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-12" id="accordion">
                <div class="content-box-header panel-heading">
                    <?=$path?>
                    <div class="panel-title "><a id="newDocForm" href="#">Нов документ</a></div>

                    <!--                    <div class="panel-options">-->
                    <!--                        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>-->
                    <!--                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>-->
                    <!--                    </div>-->
                </div>
                <div id="createDocForm" style="display: none" class="content-box-large box-with-header">
                    <form action="" method="post" role="form" id="createDoc" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" placeholder="Описание" id="file_label" name="file_label" class="form-control">
                            <input type="hidden" name="user_id" id="user_id_hidden" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-control btn-info text-center" for="my-file-selector">
                                <input id="my-file-selector" type="file" name="user_file" class="text-center" style="display:none;" onchange="$('#upload-file-info').html($(this).val());">
                                Прикачи файл
                            </label>
                            <span class='label label-info text-center' id="upload-file-info"></span>
                        </div>


                        <div class="form-group">
                            <button class="form-control btn-primary" type="submit" id="submit_button"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12" id="accordion">
                        <div class="content-box-header panel-heading">
                            <div class="panel-title "><a style="text-decoration: none" id="allPosts" href="#">Всички
                                    документи</a></div>
                        </div>

                        <div id="posts_div" style="display: none" class="content-box-large box-with-header">

                            <div class="panel-body">
                                <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                    <table id="example" class="table table-striped table-bordered dataTable" border="0"
                                           cellspacing="0" cellpadding="0" aria-describedby="example_info">
                                        <thead>
                                        <tr>
                                            <th>Име на файл</th>
                                            <th>Описание</th>
                                            <th>Автор</th>
                                            <th>Дата</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_body">
                                        <?php foreach ($all_documents as $doc): ?>
                                            <tr>
                                                <td class="name"><?= $doc->name ?></td>
                                                <td class="attachment"><?= $doc->label ?></td>
                                                <td class="post_folder"><?= $doc->author ?></td>
                                                <td><?= date('Y-m-d', $doc->added_when) ?></span></td>
                                                <td class="vert-align">
                                                    <div class="text-center">
                                                        <button title="Редактирай" id="<?= $doc->id ?>"
                                                                class="btn btn-primary btn-xs post_id">
                                                            <i class="glyphicon glyphicon-pencil"></i>
                                                        </button>
                                                        <button title="Премахни" id="<?= $doc->id ?>"
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

                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script src="<?php echo url() ?>public/ckeditor/ckeditor.js"></script>


<?php require('partials/footer.php') ?>

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
        $(document).on('click', '#allPosts', function (e) {
            e.preventDefault();
            $('#posts_div').toggle();

        });
        $(document).on('click', '#newDocForm', function (e) {
            e.preventDefault();
            $('#createDocForm').toggle();
            $('#submit_button').text('Добави');


        })
        var dataTable = $('#example,#files').DataTable();

    </script>

<?php require("partials/bottom.php");