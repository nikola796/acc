<?php $title = 'Интранет сървър'?>
<?php require('partials/header.php') ?>

<div class="content-box-large" style="background: whitesmoke; border-radius: 5px">
    <div class="panel-heading">
        <div class="panel-title">Промяна на парола</div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" id="new_pass">
            <div class="form-group">
                <label for="inputPassword1" class="col-sm-2 control-label">Нова парола</label>
                <div class="col-sm-10">
                    <input class="form-control" id="inputPassword1" placeholder="Password" type="password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword2" class="col-sm-2 control-label">Потвърди паролата</label>
                <div class="col-sm-10">
                    <input class="form-control" id="inputPassword2" placeholder="Password" type="password">
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

<?php require('partials/footer.php') ?>
<script>
    <?php if(strlen($response) > 0): ?>
    BootstrapDialog.show({
        title: 'Грешка',
        message: '<?php echo $response ?>',
        onhide: function() {
            window.location.replace('<?php echo url()?>');
        }
    });

    <?php else: ?>
    $(document).on('submit', '#new_pass', function(e){
        e.preventDefault();
        var pass = $('#inputPassword1').val();
        var pass_confirm = $('#inputPassword2').val();
        if($.trim(pass).length == 0 || $.trim(pass_confirm).length == 0){
            BootstrapDialog.alert('Не сте попълнили полета парола и потвърди парола!');
            return false;
        }
        if ($.trim(pass) != $.trim(pass_confirm)){
            BootstrapDialog.alert('Паролите на съвпадат!');
            return false;
        }
        if ($.trim(pass) < 6 || $.trim(pass_confirm) < 6){
            BootstrapDialog.alert('Прекалено кратка парола! Въведете поне 6 символа.');
            return false;
        }
        $.ajax({
            method: 'POST',
            url: '<?php echo url()?>new_password',
            data: {pass: pass, user_id: <?php echo $userId ?>}
        }).done(function(data){
            BootstrapDialog.show({
                message: data,
                buttons: [{
                    label: 'OK',
                    action: function(dialogRef){
                        dialogRef.close();
                    }
                }],
                onhide: function() {
                    window.location.replace('<?php echo url()?>');
                }
            });
        })
    })
    <?php endif;?>

</script>



