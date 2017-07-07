<?php require 'right_nav.php' ?>

</div>
<script src="<?php echo url() ?>public/js/libs/bootstrap-dialog.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {

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

</body>
</html>