<?php require 'right_nav.php' ?>

</div>

<!--<div id="table_res">-->
<!---->
<!--    <table id="example" class="display" cellspacing="0" width="100%">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Name</th>-->
<!--            <th>Position</th>-->
<!--            <th>Office</th>-->
<!--            <th>Age</th>-->
<!--            <th>Start date</th>-->
<!--            <th>Salary</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tfoot>-->
<!--        <tr>-->
<!--            <th>Name</th>-->
<!--            <th>Position</th>-->
<!--            <th>Office</th>-->
<!--            <th>Age</th>-->
<!--            <th>Start date</th>-->
<!--            <th>Salary</th>-->
<!--        </tr>-->
<!--        </tfoot>-->
<!--        <tbody>-->
<!--        <tr>-->
<!--            <td>Tiger Nixon</td>-->
<!--            <td>System Architect</td>-->
<!--            <td>Edinburgh</td>-->
<!--            <td>61</td>-->
<!--            <td>2011/04/25</td>-->
<!--            <td>$320,800</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Garrett Winters</td>-->
<!--            <td>Accountant</td>-->
<!--            <td>Tokyo</td>-->
<!--            <td>63</td>-->
<!--            <td>2011/07/25</td>-->
<!--            <td>$170,750</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Ashton Cox</td>-->
<!--            <td>Junior Technical Author</td>-->
<!--            <td>San Francisco</td>-->
<!--            <td>66</td>-->
<!--            <td>2009/01/12</td>-->
<!--            <td>$86,000</td>-->
<!--        </tr>-->
<!--        </tbody>-->
<!--    </table>-->
<!---->
<!--</div>-->


<script src="<?php echo url()?>public/js/libs/jquery-2.2.4.min.js"></script>
<script src="<?php echo url()?>public/js/libs/bootstrap.min.js"></script>
<script src="<?php echo url() ?>public/js/libs/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo url() ?>public/js/libs/bootstrap-dialog.js" type="text/javascript"></script>

<link href="<?php echo url() ?>public/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

<script src="<?php echo url() ?>public/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo url() ?>public/datatables/dataTables.bootstrap.js"></script>

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

<script>
    $( function() {
        //$(document).on('sub')
//        $('#search_result, #example').DataTable();
//        var results_from_search = $("#example").html();
//        BootstrapDialog.show({
//            type: BootstrapDialog.TYPE_DEFAULT,
//            size: BootstrapDialog.SIZE_WIDE,
//            title: 'Внимание',
//            message: results_from_search
//        })

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