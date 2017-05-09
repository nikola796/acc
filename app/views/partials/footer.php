<?php require 'right_nav.php' ?>

</div>
<script src="<?php url() ?>public/js/libs/bootstrap-dialog.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {

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