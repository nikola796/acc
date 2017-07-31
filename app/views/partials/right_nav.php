</div>
<div style="" class="col-md-3 pull-right" >
    <div class="panel panel-primary" style="float: right">
        <div class="panel-heading">
            <h5 class="panel-title text-center">Администрация</h5>
        </div>
        <div class="panel-body" >
            <form method="post" action="<?php echo url() ?>auth" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <input class="form-control" id="username" name="username" placeholder="Потребител" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <input class="form-control" id="password" name="password" placeholder="Парола" type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-4">
                            <button  id="user_login_form" class="btn btn-primary btn-xs">Въведи</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <a id="reset_password"  href="#"><strong>Забравена парола</strong></a>
                        </div>
                    </div>
                    <?php if($_SESSION['is_logged'] === true):?>
                    <div class="form-group">
                        <div class="text-center">
                            <a style="color:blueviolet" id="admin_redirect"  href="#"><strong>Администрация</strong></a>
                        </div>
                    </div>
                    <?php endif;?>
                </fieldset>
            </form>
        </div>
    </div>



    <div class="panel panel-primary" style="float: right;background-color: #FFFFE6;border:1px solid #FFFFE6">

    <table style="margin:0 auto" align="" width="70" height="95" cellpadding="0" cellspacing="0" background="<?php echo url()?>public/images/calendar.gif">
        <tr>
            <td align="center"> <font face="tahoma,arial" ><?php echo date("d");?></font><br/>
                <font face="tahoma,arial" size="2">
                    <?php  setlocale(LC_TIME, 'bg_BG.UTF8'); echo  strftime("%b");?>
                </font><br/>
                <font face="tahoma,arial" ><?php echo date("Y");?></font><br/>
                <font face="tahoma,arial" >
                    <?php setlocale(LC_TIME, 'bg_BG.UTF8'); echo strftime("%a");?>
                </font> </td>
        </tr>

    </table>

    <?php require('online_users.php')?>
</div>

</div>



</div>
