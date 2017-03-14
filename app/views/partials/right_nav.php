</div>
<div style="border: 1px solid red" class="col-lg-2" >
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Администрация</h5>
        </div>
        <div class="panel-body" >
            <form class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <input class="form-control" id="inputEmail" placeholder="Потребител" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <input class="form-control" id="inputPassword" placeholder="Парола" type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-3">
                            <a href="#" class="btn btn-primary btn-xs">Въведи</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
<div class="" style="border: 1px solid red; float:left">
    <table align="right" width="70" height="95" cellpadding="0" cellspacing="0" background="public/images/calendar.gif">
        <tr>
            <td align="center"> <font face="tahoma,arial" ><?php echo date("d");?></font><br/>
                <font face="tahoma,arial" size="2">
                    <?php  setlocale(LC_TIME, 'bg_BG'); echo  strftime("%b");?>
                </font><br/>
                <font face="tahoma,arial" ><?php echo date("Y");?></font><br/>
                <font face="tahoma,arial" >
                    <?php setlocale(LC_TIME, 'bg_BG'); echo strftime("%a");?>
                </font> </td>
        </tr>
    </table>
    
</div>
</div>


</div>

