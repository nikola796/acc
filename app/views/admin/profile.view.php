<?php require ('partials/header.php') ?>
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <div class="col-md-10">

        <div class="content-box-large">
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-10">
                        <div class="panel-heading">
                            <div class="panel-title">Смяна на парола</div>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" id="change_password" role="form">
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-sm-2 control-label">Стара парола</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputPassword1" placeholder="Password" type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword2" class="col-sm-2 control-label">Нова парола</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputPassword2" placeholder="Password" type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Повтори паролата</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputPassword3" placeholder="Password" type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Промени</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    </div>



<?php require ('partials/footer.php')?>

    <script src="<?php url()?>public/js/libs/jquery-ui.js"></script>
    <script src="<?php url()?>public/js/custom.js"></script>
<script>
    $(document).on('submit', '#change_password', function(e){
        e.preventDefault();
        var old_pass = $.trim($('#inputPassword1').val());
        var new_pass = $.trim($('#inputPassword2').val());
        var new_pass_comfirm = $.trim($('#inputPassword3').val());
        if(old_pass.length > 0){
            if(new_pass.length > 0 && new_pass_comfirm.length > 0) {

                if (new_pass == new_pass_comfirm) {
                    $.ajax({
                        type: 'POST',
                        url: 'profile',
                        data: {
                            old_pass: old_pass,
                            new_pass: new_pass
                        }

                    }).done(function (data) {
                        BootstrapDialog.alert({
                            message: data,
                            onhide: function(){
                                window.location.reload(true);
                            }
                        })
                    })
                } else {
                    alert('Паролите нe съвпадат!');
                }
            } else {
                alert('Въведете и потвърдете новате си парола!');
            }
        } else {
            alert('Не сте въвели старата си парола!')
        }



    })
</script>

<?php require ('partials/bottom.php')?>