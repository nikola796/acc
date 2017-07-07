<?php require('partials/header.php') ?>

    <style>
        #select2-id, #select2-perentFolder-container {
            width: 100%;
        }

        .select2-close-mask {
            z-index: 2099;
        }

        .select2-dropdown {
            z-index: 3051;
        }

    </style>
    <div class="col-md-10">
        <div class="row">
            <div id="accordion" class="col-md-12">
                <div class="content-box-header panel-heading">
                    <div class="panel-title "><a href="#" id="newDepartmentForm">Ново пространство</a></div>
                </div>
                <div class="content-box-large box-with-header" style="display: none;" id="createUserForm">
                    <form class="form-horizontal" id="createUser" role="form" action="">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="folderName">Име на пространството</label>
                                <input type="text" class="form-control" id="newFolderName"
                                       placeholder="Наименование">
                            </div>
                        </div>
                        <div id="hidden_content"></div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="folderName">Място на пространството</label>
                                <select name="folder" id="parentFolder" class="form-control" style="width: 100%">
                                    <?= ($_SESSION['role'] == 1 ? '<option value="0">Главна директория</option>' : '') ?>
                                    <?php foreach ($folders as $folder): ?>

                                        <option value="<?= $folder->category_id ?>"><?= $folder->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class=" col-sm-12">
                                <button id="submit_button" type="submit" class="btn btn-primary form-control"
                                        value="add">Създай
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="content-box-large">
                    <div class="panel-heading">
                        <div class="panel-title"><label>Моите пространства:</label></div>
                    </div>
                    <div class="form-group">
                        <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Нова папка</button> -->

                        <!-- Modal -->

                        <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
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
                                            <select name="folder" id="perentFolder" class="form-control"
                                                    style="width: 100%">
                                                <?= ($_SESSION['role'] == 1 ? '<option value="0">Главна директория</option>' : '') ?>
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
                    <div class="panel-body">
                        <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                            <table id="example" class="table table-striped table-bordered dataTable" border="0"
                                   cellspacing="0" cellpadding="0" aria-describedby="example_info">
                                <div>
                                    <label>
                                        <input type="checkbox" id="all_check"> Включи деактивираните
                                    </label>

                                </div>
                                <thead>
                                <tr>
                                    <th>Име</th>
                                    <th>Родител</th>
                                    <th>Звено</th>
                                    <th>Добавена на:</th>
                                    <th>Добавена от:</th>
                                    <th>Променена на</th>
                                    <th>Променена от</th>
                                    <th>Статус</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>

<?php require('partials/footer.php') ?>

    <link href="<?php echo url() ?>public/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

    <script src="<?php echo url() ?>public/datatables/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo url() ?>public/datatables/dataTables.bootstrap.js"></script>

    <script src="<?php echo url() ?>public/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo url() ?>/public/js/posts.js"></script>

    <script>

        $(document).ready(function () {

            $('#example_test').DataTable();
            $('#parentFolder').select2();
        });
$(document).on('keyup', '.del_folder', function(){
    console.log('click');
})
        $(document).on('click', '#createFolder', function () {
            if (($('#newFolderName').val().length) > 0) {
                $.ajax({
                    method: 'post',
                    url: 'folders',
                    data: {
                        name: $('#newFolderName').val(),
                        parent: $('#perentFolder').val()
                    }
                })
                    .done(function (data) {
                        console.log('seccess');
                        $('#myModal').modal('hide');
                        BootstrapDialog.alert({
                            title: 'Браво',
                            message: $text
                        });
                    })
            } else {
                BootstrapDialog.alert({
                    type: BootstrapDialog.TYPE_WARNING,
                    title: 'Внимание',
                    message: 'Не сте въвели име на новата папка!'
                });
            }

        })

        $('#users').addClass('current')
        var dataTable = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "folders", // json datasource
                type: "post",  // method  , by default get
                error: function () {  // error handling
                    $(".employee-grid-error").html("");
                    $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#employee-grid_processing").css("display", "none");

                }
            }
        });


        $("body").on("click", "#all_check", function () {
            if ($('#all_check').prop('checked')) {
                $('#all_check').val(1);
            } else {
                $('#all_check').val(0);
            }
            var i = $(this).attr('data-column'); // getting column index
            var v = $(this).val(); // getting search input value
            dataTable.columns(i).search(v).draw();
            console.log(i + ' ' + v);
        });

        $('#roles').select2({
            placeholder: "Избери роля"
        });

        $('#department').select2({
            placeholder: "Избери звено"
        });

        //            var data = [
        //                <?php //foreach ($folders as $folder): ?>
        //                { id: <?//=$folder->category_id?>//, text: '<?php //echo (strpos($folder->name, '*') === false ? '<strong>'.$folder->name.'</strong>' : '<span>'.$folder->name.'</span>')?>//' },
        //                <?php //endforeach;?>
        //            ];


        //            $('#folder').select2({
        //                placeholder: "Задай достъп",
        //                data: data,
        //                templateResult: function (d) { return $(d.text); },
        //                templateSelection: function (d) { return $(d.text); },
        //            });


        $('#newDepartmentForm').click(function (e) {
            e.preventDefault();

            if ($("#createUserForm").is(':visible') && $('#newFolderName').val().length > 0) {
                $('#newFolderName').val('');
                $('#parentFolder').val(0).trigger('change');
//                    $('#inputEmail').val('');
//                    $('#roles').val(0).trigger('change');
//                    $('#department').val(0).trigger('change');
//                    $('#folder').val(0).trigger('change');
            } else {
                $('#createUserForm').toggle();

            }
            $('#submit_button').text('Създай');
            $('#submit_button').prop('value', 'add');
            $('#department_id_hidden').val('');

        });

        /*************** CREATE NEW DEPARTMENT **************************************************************/
        $(document).on('submit', '#createUser', function (e) {
            e.preventDefault();

            var form_errors = [];

            if ($.trim($("#newFolderName").val()).length == 0) {
                form_errors['folder_name'] = 'Не сте въвели име. Моля въведете име на пространството.';
            } else if ($.trim($("#newFolderName").val()).length < 2) {
                form_errors['folder_name'] = 'Името на пространството трябва да е поне 2 символа.';
            } else {
                delete form_errors['folder_name'];
            }

            if (form_errors['folder_name']) {
                BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_WARNING,
                    title: 'Внимание',
                    message: form_errors['folder_name']
                });
                return false;
            }
            var url = '';
            var success_msg = '';
            if ($('#submit_button').val() == 'edit') {
                url = 'edit-folder';
                success_msg = 'Успешно редактирахте пространството.';
            } else {
                url = 'new-folder';
                success_msg = 'Успешно добавихте ново пространство.'
            }
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    name: $('#newFolderName').val(),
                    folder_id: $('#folder_id').val(),
                    parent_id: $('#parent_id').val(),
                    parent: $('#parentFolder').find(":selected").val()
                }
            }).done(function (data) {
                console.log(data);
                if (data == 'success') {
                    BootstrapDialog.show({
                        type: BootstrapDialog.TYPE_SUCCESS,
                        title: 'Успех',
                        message: success_msg,
                        buttons: [{
                            label: 'Разбрах',
                            action: function () {
                                window.location.reload(true);
                            }
                        }]

                    });
                }
            });
            //location.reload();
        });
        //var $msg = $('#test_div');

        /***************** EDIT USER *****************************************************/
        $(document).on('click', '.folder_id', function () {
            var id = $(this).attr('id');
            var folder = $(this).closest('tr').find('td:eq(0)').text();
            var parent_id = $(this).closest('tr').find('input.parent_id').val();
            //$('input#test_input').val(folder);
            $('#hidden_content').html('<input type="hidden" name="folder_id" id="folder_id" value="' + id + '" />' +
                '<input type="hidden" name="parent_id" id="parent_id" value="' + parent_id + '" />');
            // $('#perentFolder').select2();

            $('#newFolderName').val(folder);

            $('#parentFolder').val($(this).closest('tr').find('input.parent_id').val()).trigger('change');
            console.log(folder, parent_id);
//                BootstrapDialog.show({
//                    title: 'Нова папка',
//                    message: $('#test_div'), //'Name: <input type="text" name="test" value="'+ folder +'" />',
//                    buttons: [{
//                        label: 'Създай',
//                        cssClass: 'btn-primary',
//                        action: function(){
//                            console.log('Test')
//                        }
//                    }],
//                    onhide: function(){
//                        $('#newFolderName').val('');
//                        $('#perentFolder').val(0).trigger('change');
//                    }
//                });
            $('#inputDepartment').val(folder);
            $('#createUserForm').show();
            //    var department = $(this).closest('tr').find('td:eq(2)').text();
            // var access = $(this).closest('tr').find('td:eq(4)').text().split(', ');
            //     var access_num = $(this).closest('tr').find('input.access_id').val();
            // var access_id = $('#access_id').val().split(',');
            //     $('#folder').val(0).trigger('change');
            //     if (access_num.length > 0) {
            //         $('#folder').val(access_num.split(',')).trigger('change');
            //     }

            //     $('#createUserForm').show();
            //     $('#inputUser').val(($(this).closest('tr').find('td:eq(0)').text()));
            //     $('#inputEmail').val(($(this).closest('tr').find('td:eq(1)').text()));
            //     $('#div_pass').hide();

            $('#submit_button').text('Обнови').val('edit');
            $('#department_id_hidden').val($(this).attr('id'));
            //     $('#submit_button').prop('value', 'edit');
            //console.log($(this).closest('tr').find('.user_role').text());
            //     $('#roles').val('');
            //     $('#roles').val($(this).closest('tr').find('input.role_id').val()).trigger('change');

            //     $('#department').val('');
            //     $('#department').val($(this).closest('tr').find('input.dep_id').val()).trigger('change');

        });

        /**************** DE_ACTIVATE USER *******************************************************/
        $(document).on('click', '.del_folder', function () {
            var id = $(this).prop('id');
//            var button_class = $(this).prop('class');
            var message = 'Искате да изтриете пространство. Моля изберете дали да изтриете само избраното пространство или и неговите под-пространства!';
//            var label = '';
//            var active = null;
            var butt_class = 'btn-danger';
//            if (button_class.search('activate') > 0) {
//                message = 'Вие искате да активирате звено. Моля потвърдете!';
//                label = 'Активирай';
//                active = 1;
//                butt_class = 'btn-success'
//            }
//            if (button_class.search('del') > 0) {
//                message = 'Вие искате да деактивирате звено. При деактивиране на звеното ще се деактивират всички папки и файлове към него. Моля потвърдете!';
//                label = 'Деактивирай';
//                active = 0
//                butt_class = 'btn-danger';
//            }
            BootstrapDialog.show({
                type: BootstrapDialog.TYPE_WARNING,
                title: 'Внимание',
                message: message,
                buttons: [{
                    label: 'Избраното пространство',
                    cssClass: butt_class,
                    action: function (dialogItself) {
                        $.ajax({
                            method: 'POST',
                            url: 'delete-folder?' + id,
                            data: {del: 'only_folder'}

                        }).done(function (data) {
                            var msg_type = '';
                            var title = '';
                            if (data == 'Неуспех!') {
                                msg_type = BootstrapDialog.TYPE_WARNING;
                                title = 'Неуспех';
                            } else {
                                msg_type = BootstrapDialog.TYPE_SUCCESS
                                title = 'Успех';
                            }
                            if (data) {
                                BootstrapDialog.show({
                                    type: msg_type,
                                    title: title,
                                    message: data,
                                    buttons: [{
                                        label: 'Разбрах',
                                        action: function () {
                                            location.reload();
                                        }
                                    }]

                                });
                            }
                        });
                        dialogItself.close()
                    }
                }, {
                    label: 'Избаното и неговите под-пространства',
                    cssClass: butt_class,
                    action: function (dialogItself) {
                        $.ajax({
                            method: 'POST',
                            url: 'delete-folder?' + id,
                            data: {del: 'all'}

                        }).done(function (data) {
                            var msg_type = '';
                            var title = '';
                            if (data == 'Неуспех!') {
                                msg_type = BootstrapDialog.TYPE_WARNING;
                                title = 'Неуспех';
                            } else {
                                msg_type = BootstrapDialog.TYPE_SUCCESS
                                title = 'Успех';
                            }
                            if (data) {
                                BootstrapDialog.show({
                                    type: msg_type,
                                    title: title,
                                    message: data,
                                    buttons: [{
                                        label: 'Разбрах',
                                        action: function () {
                                            location.reload();
                                        }
                                    }]

                                });
                            }
                        });
                        dialogItself.close()
                    }
                }, {
                    label: 'Отказ',
                    action: function (dialogItself) {
                        dialogItself.close();
                    }
                }]

            });
        });


        $(document).on('change', '#deactivated_users', function () {
            //var param;
            if ($('#deactivated_users:checkbox:checked').length > 0) {
                // param = 'all';
                location.href = 'users?all';
            } else {
                console.log('Active')
                // param = 'active';
            }

        })

    </script>

<?php require("partials/bottom.php");