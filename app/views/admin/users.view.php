<?php require('partials/header.php') ?>

    <style>
        #select2-id {
            width: 100%;
        }
    </style>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12" id="accordion">
                <div class="content-box-header panel-heading">
                    <div class="panel-title "><a id="newUserForm" href="#">Нов потребител</a></div>

                    <!--                    <div class="panel-options">-->
                    <!--                        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>-->
                    <!--                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>-->
                    <!--                    </div>-->
                </div>
                <div id="createUserForm" style="display: none" class="content-box-large box-with-header">
                    <form action="" role="form" id="createUser" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputUser">Потребител</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Потребител" id="inputUser" class="form-control">
                                <input type="hidden" name="user_id" id="user_id_hidden" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputEmail">Поща</label>
                            <div class="col-sm-10">
                                <input type="email" placeholder="Поща" id="inputEmail" class="form-control">
                            </div>
                        </div>
                        <div class="form-group" id="div_pass">
                            <label class="col-sm-2 control-label" for="inputPassword">Парола</label>
                            <div class="col-sm-10">
                                <input type="password" placeholder="Парола" id="inputPassword" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Роля</label>
                            <div class="col-sm-10">
                                <select name="roles" id="roles" class="form-control" style="width: 100%">
                                    <option></option>
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?= $role->id ?>"><?= $role->role ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Звено</label>
                            <div class="col-sm-10">
                                <select name="department" id="department" class="form-control" style="width: 100%">
                                    <option></option>
                                    <?php foreach ($departments as $department): ?>
                                        <option value="<?= $department->id ?>"><?= $department->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Достъп</label>
                            <div class="col-sm-10">
                                <select name="folder[]" id="folder" class="form-control" multiple="multiple"
                                        style="width: 100%">
                                    <option></option>
<!--                                    --><?php //foreach ($folders as $folder): ?>
<!--                                        <option value="--><?//= $folder->category_id ?><!--">--><?//=(strpos($folder->name, '*') !== false ? 'tt'.$folder->name : '<strong>rr'.$folder->name.'</strong>')?><!--</option>-->
<!--                                    --><?php //endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!--                        <div class="form-group has-error">-->
                        <!--                            <label class="col-md-2 control-label">Input error</label>-->
                        <!--                            <div class="col-md-10">-->
                        <!--                                <div class="input-group">-->
                        <!--                                    <input type="text" class="form-control">-->
                        <!--                                    <span class="input-group-addon"><i class="glyphicon glyphicon-remove-circle"></i></span>-->
                        <!--                                </div>-->
                        <!--                                <span class="help-block"><i class="fa fa-warning"></i> Please correct the error</span>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-primary" type="submit" id="submit_button"></button>
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
                        <div class="panel-title"><label>Всички потребители</label></div>



                    </div>

                    <div class="panel-body">
                        <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <table id="example" class="table table-striped table-bordered dataTable" border="0" cellspacing="0" cellpadding="0" aria-describedby="example_info">
                            <div>
                                <label>
                                    <input type="checkbox" id="all_check"> Включи деактивираните потребители
                                </label>
                            </div>
                            <thead>
                            <tr>
                                <th>Потребител</th>
                                <th>Поща</th>
                                <th>Звено</th>
                                <th>Роля</th>
                                <th>Достъп</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
<!--                            <tbody id="table_body">-->
<!--                            --><?php //foreach ($users_roles_access as $ura): ?>
<!--                                <tr>-->
<!--                                    <td class="name">--><?//= $ura->name ?><!--</td>-->
<!--                                    <td class="email">--><?//= $ura->email ?><!--</td>-->
<!--                                    <td><input type="hidden" name="dep_id" class="dep_id"-->
<!--                                               value="--><?//= $ura->dep_id ?><!--"><span class="dep">--><?//= $ura->dep ?><!--</span> </td>-->
<!--                                    <td><input type="hidden" name="role_id" class="role_id"-->
<!--                                               value="--><?//= $ura->role_id ?><!--"><span class="role">--><?//= $ura->role ?><!--</span></td>-->
<!--                                    <td><input type="hidden" name="access_id" class="access_id"-->
<!--                                               value="--><?//= $ura->access_id ?><!--"><span class="access">--><?//= $ura->access ?><!--</span></td>-->
<!--                                    <td>-->
<!--                                        <div class="text-center">-->
<!--                                            <button id="--><?//= $ura->id ?><!--" class="btn btn-primary btn-xs user_id">-->
<!--                                                <i class="glyphicon glyphicon-pencil"></i>-->
<!--                                                Edit-->
<!--                                            </button>-->
<!--                                            <button id="--><?//= $ura->id ?><!--" class="btn btn-danger btn-xs del_user"-->
<!--                                                    style="margin-left:5%">-->
<!--                                                <i class="glyphicon glyphicon-remove"></i>-->
<!--                                                Delete-->
<!--                                            </button>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                </tr>-->
<!--                            --><?php //endforeach; ?>
<!--                            </tbody>-->
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

<!--    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
<!---->
<!--    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">-->

    <script src="<?php echo url() ?>public/datatables/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo url() ?>public/datatables/dataTables.bootstrap.js"></script>

<!--    <script src="--><?php //url() ?><!--public/js/tables.js"></script>-->
<!--    <script src="//code.jquery.com/jquery-1.12.4.js"></script>-->
<!--    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>-->
<!--    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>-->
<!--    <script src="--><?php //url() ?><!--public/js/libs/select2.min.js"></script>-->

    <script src="<?php echo url() ?>public/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {

            $(document).ready(function() {
                $('#example_test').DataTable();
            } );

            $('#users').addClass('current')
            var dataTable = $('#example').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url :"users/all", // json datasource
                    type: "post",  // method  , by default get
                    error: function(){  // error handling
                        $(".employee-grid-error").html("");
                        $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#employee-grid_processing").css("display","none");

                    }
                }
            } );


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

            var data = [
                <?php foreach ($folders as $folder): ?>
                { id: <?=$folder->category_id?>, text: '<?php echo (strpos($folder->name, '*') === false ? '<strong>'.$folder->name.'</strong>' : '<span>'.$folder->name.'</span>')?>' },
                <?php endforeach;?>
                ];


            $('#folder').select2({
                placeholder: "Задай достъп",
                data: data,
                templateResult: function (d) { return $(d.text); },
                templateSelection: function (d) { return $(d.text); },
            });


            $('#newUserForm').click(function (e) {
                e.preventDefault();

                if ($("#createUserForm").is(':visible') && ($('#inputUser').val().length > 0 || $('#inputEmail').val().length > 0)) {
                    $('#inputUser').val('');
                    $('#inputEmail').val('');
                    $('#roles').val(0).trigger('change');
                    $('#department').val(0).trigger('change');
                    $('#folder').val(0).trigger('change');
                } else {
                    $('#createUserForm').toggle();

                }
                $('#submit_button').text('Създай');
                $('#submit_button').prop('value', 'add');
                $('#user_id_hidden').val('');

            });

/*************** CREATE NEW USER **************************************************************/
            $(document).on('submit', '#createUser', function (e) {
                e.preventDefault();
                //console.log($('#user_id_hidden').val());
                var form_errors = [];
                if ($('#inputUser').val() == '') {
                    form_errors['username'] = 'Въведете потребителско име';
//                    $('#inputUser').parent('div').parent('div').addClass('has-error');
//                    $('#inputUser').parent('div').html('<div class="input-group"><input type="text" placeholder="Потребител" id="inputUser" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-remove-circle"></i></span></div><span class="help-block"><i class="fa fa-warning"></i>' + form_errors['username'] + '</span>')

                } else {
//                    $('#inputUser').parent('div').parent('div').parent('div').removeClass('has-error');
//                    $('#inputUser').parent('div').parent('div').html('<input type="text" placeholder="Потребител" id="inputUser" class="form-control">');
//
                    delete form_errors['username'];
                }

                $.ajax({
                    method: 'POST',
                    data: {
                        name: $('#inputUser').val(),
                        pass: $('#inputPassword').val(),
                        email: $('#inputEmail').val(),
                        role: $('#roles :selected').val(),
                        department: $('#department :selected').val(),
                        access: $('#folder').val(),
                        action: $('#submit_button').val(),
                        id: $('#user_id_hidden').val()
                    }
                }).done(function (data) {
                    if (data) {
                        BootstrapDialog.show({
                            type: BootstrapDialog.TYPE_SUCCESS,
                            title: 'Успех',
                            message: data,
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



/***************** EDIT USER *****************************************************/
            $(document).on('click', '.user_id', function () {
                // console.log($(this).attr('id'));
                // var role = $(this).closest('tr').find('td:eq(3)').text();
                var department = $(this).closest('tr').find('td:eq(2)').text();
                // var access = $(this).closest('tr').find('td:eq(4)').text().split(', ');
                var access_num = $(this).closest('tr').find('input.access_id').val();
                console.log(access_num);
                // var access_id = $('#access_id').val().split(',');
                $('#folder').val(0).trigger('change');
                if (access_num.length > 0) {
                    $('#folder').val(access_num.split(',')).trigger('change');
                }

                $('#createUserForm').show();
                $('#inputUser').val(($(this).closest('tr').find('td:eq(0)').text()));
                $('#inputEmail').val(($(this).closest('tr').find('td:eq(1)').text()));
                $('#div_pass').hide();

                $('#submit_button').text('Обнови');
                $('#user_id_hidden').val($(this).attr('id'));
                $('#submit_button').prop('value', 'edit');
                //console.log($(this).closest('tr').find('.user_role').text());
                $('#roles').val('');
                $('#roles').val($(this).closest('tr').find('input.role_id').val()).trigger('change');

                $('#department').val('');
                $('#department').val($(this).closest('tr').find('input.dep_id').val()).trigger('change');

            });

/**************** DE_ACTIVATE USER *******************************************************/
            $(document).on('click', '.del_user, .activate_user', function () {
                var id = $(this).prop('id');
                var button_class = $(this).prop('class');
                var message = '';
                var label = '';
                var active = null;
                var butt_class = '';
                if(button_class.search('activate') > 0){
                    message = 'Вие искате да активирате потребител. Моля потвърдете!';
                    label = 'Активирай';
                    active = 1;
                    butt_class = 'btn-success'
                }
                if(button_class.search('del') > 0){
                    message = 'Вие искате да деактивирате потребител. Моля потвърдете!';
                    label = 'Деактивирай';
                    active = 0
                    butt_class = 'btn-danger';
                }
                BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_WARNING,
                    title: 'Внимание',
                    message: message,
                    buttons: [{
                        label: label,
                        cssClass: butt_class,
                        action: function (dialogItself) {
                            $.ajax({
                                method: 'POST',
                                url: 'users/delete/' + id,
                                data: {active: active}

                            }).done(function (data) {
                                if (data) {
                                    BootstrapDialog.show({
                                        type: BootstrapDialog.TYPE_SUCCESS,
                                        title: 'Успех',
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
            })


            $(document).on('change', '#deactivated_users', function(){
                //var param;
                if($('#deactivated_users:checkbox:checked').length > 0){
                   // param = 'all';
                    location.href = 'users?all';
                } else {
                    console.log('Active')
                   // param = 'active';
                }

            })

        })
    </script>

<?php require("partials/bottom.php");