<?php require 'right_nav.php' ?>

</div>

<!--<script src="--><?php //echo url()?><!--public/js/libs/jquery-3.2.1.js"></script>-->
<!--<script src="--><?php //echo url()?><!--public/js/libs/jquery-2.2.4.min.js"></script>-->


<script>
    $(document).ready(function () {
         $('#example').DataTable();

        $(document).on('click', '#register', function(e) {
            e.preventDefault();
            console.log('Click');
            BootstrapDialog.show({
                title: 'Регистрация',
                message: $(
                    '<input type="text" id="user_email" class="form-control" placeholder="Вашият мейл...">' +
                    '<input type="text" id="username_register" class="form-control" placeholder="Потребителско име">' +
                    '<input type="password" id="user_password_register" class="form-control" placeholder="Парола">' +
                    '<input type="password" id="user_password_confirm" class="form-control" placeholder="Потвърди Паролата">'
                ),
                buttons: [{
                    label: 'Изпрати',
                    cssClass: 'btn-primary',
                    hotkey: 13, // Enter
                    action: function () {
                        if($.trim($('#user_email').val()).length == 0){
                            alert('Не сте въвели поща!');
                            return false;
                        } else if($.trim($('#username_register').val()).length < 3){
                            alert('Въвели сте прекалено кратко потребителско име!');
                            return false;
                        } else if($.trim($('#user_password_register').val()).length < 8) {
                            alert('Въвели сте прекалено кратка парола!');
                            return false;
                        } else if($('#user_password_register').val() !== $('#user_password_confirm').val()) {
                            alert('Паролите не съвпадат!');
                            return false;
                        }

                        $.ajax({
                            method: 'POST',
                            url: '<?php echo url()?>users',
                            data: {
                                name: $('#username_register').val(),
                                pass: $('#user_password_register').val(),
                                email: $('#user_email').val(),
                                role: 1,
                                department: 1,
                                access: 1,
                                action: 'add',
                                id: 0
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
                    }
                }]
            })
        })

        $(document).on('click', '#reset_password', function(e){
            e.preventDefault();
            BootstrapDialog.show({
                title: 'Забравена парола',
                message: $('<input type="text" id="user_email" class="form-control" placeholder="Вашият мейл...">'),
                buttons: [{
                    label: 'Изпрати',
                    cssClass: 'btn-primary',
                    hotkey: 13, // Enter.
                    action: function(dialogRef) {
                        if($.trim($('#user_email').val()).length == 0){
                            alert('Не сте въвели поща!');
                            return false;
                        } else if($.trim($('#user_email').val()).length < 12){
                            alert('Въвели сте прекалено кратка поща!');
                            return false;
                        }
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo url()?>reset_password',
                            data: {email: $('#user_email').val()}
                        }).done(function (data) {
                            BootstrapDialog.show({
                                message: data,
                                buttons: [{
                                    label: 'Разбрах',
                                    cssClass: 'btn-primary',
                                    hotkey: 13, // Enter.
                                    action: function(){
                                        $.each(BootstrapDialog.dialogs, function(id, dialog){
                                            dialog.close();
                                        });
                                    }
                                }]
                                })
                        })
                    }
                }]
            });
        });

        $(document).on('click', '#admin_redirect', function(e){
            e.preventDefault();
            window.location.replace("<?= url()?>admin/home");
        })

        $(document).on('click', '#user_login_form', function(e){
            e.preventDefault();
            var username =  $('#username').val();
            var password = $('#password').val()
            var errors = '<ul>';
            if((username.trim()).length < 3){
                errors += "<li>Прекалено кратко име</li>";
            }
            if((password.trim()).length < 6){
                errors  += "<li>Прекалено кратка парола</li>";
            }
            if(errors.length > 4){
                errors += '</ul>';
                BootstrapDialog.alert({
                    type: BootstrapDialog.TYPE_WARNING,
                    title: 'Внимание',
                    message: errors,
                });
            } else{
                $.ajax({
                    method: 'POST',
                    url: '<?= url()?>auth',
                    data: {username: username, password: password}
                }).done(function(data){
                    //console.log(data);
                    if(data == 'Logged'){
                        window.location.replace("<?= url()?>admin/home");
                    } else{
                        BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_WARNING,
                            title: 'Внимание',
                            message: data,
                        });
                    }

                });
            }


        })
    })
</script>

<script>
    $( function() {

        var cache = {};
        $( "#inputSearch" ).autocomplete({
            minLength: 2,
            source: function( request, response ) {
                var term = request.term;
                if ( term in cache ) {
                    response( cache[ term ] );
                    return;
                }

                $.getJSON( "<?=url()?>search", request, function( data, status, xhr ) {
                    cache[ term ] = data;
                    response( data );
                });
            }
        });
    } );
</script>

</body>

</html>