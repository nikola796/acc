
<footer>
    <div class="container">

        <div class="copy text-center">
            Copyright 2018 <a href='http://customs.bg/'>Vladislav Andreev</a>
        </div>

    </div>
</footer>
<script src="<?php echo url()?>public/js/libs/jquery-3.2.1.js"></script>

<script src="<?php echo url() ?>public/js/plugins/sortable.js" type="text/javascript"></script>
<script src="<?php echo url() ?>public/js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo url() ?>public/js/locales/bg.js" type="text/javascript"></script>
<script src="<?php echo url() ?>public/js/locales/es.js" type="text/javascript"></script>
<script src="<?php echo url() ?>public/themes/explorer/theme.js" type="text/javascript"></script>
<script src="<?php echo url() ?>public/js/libs/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo url() ?>public/js/libs/bootstrap-dialog.js" type="text/javascript"></script>

<script src="<?php echo url() ?>public/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo url() ?>public/datatables/dataTables.bootstrap.js"></script>

<script src="<?php echo url() ?>public/js/libs/jquery-ui.js" type="text/javascript"></script>

<script src="<?php echo url() ?>public/js/libs/select2.min.js"></script>

<script src="<?php echo url()?>/public/js/app.bundle.js"></script>

<script src="<?php echo url()?>public/js/tables.js"></script>

<script>
    $( function() {
        // $( ".datepicker" ).datepicker({
        //     dateFormat: "yy-mm-dd"
        // });
        
    
        $("#startPeriod").datepicker({
            dateFormat: "yy-mm-dd",
            //minDate: 1,
            onSelect: function (date) {
                var date2 = $('#startPeriod').datepicker('getDate');
                date2.setDate(date2.getDate() + 1);
                $('#endPeriod').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('#endPeriod').datepicker('option', 'minDate', date2);
            }
        });
        $('#endPeriod').datepicker({
            dateFormat: "yy-mm-dd",
            onClose: function () {
                var dt1 = $('#startPeriod').datepicker('getDate');
                //console.log(dt1);
                var dt2 = $('#endPeriod').datepicker('getDate');
                if (dt2 <= dt1) {
                    var minDate = $('#endPeriod').datepicker('option', 'minDate');
                    $('#endPeriod').datepicker('setDate', minDate);
                }
            }
        });

    });
</script>
