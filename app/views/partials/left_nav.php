<div class="row">

    <div style="" class="col-md-3">

        <div class="panel panel-primary" style="background-color: #FFFFE6;">
            <div class="panel-heading">
                <h5 class="panel-title text-center">Документи</h5>
            </div>
            <div class="list-group table-of-contents">
                <a class="list-group-item" href="<?php echo url()?>">Начало</a>
                <a style="color:red" class="list-group-item" href="<?php echo url()?>Документи/Важно">Важно</a>
                <a class="list-group-item" href="<?php echo url()?>Документи">Преглед на документи</a>
                <a class="list-group-item" href="#tables">Форум</a>
                <a class="list-group-item" href="#forms">Чат</a>
            </div>
        </div>

        <div class="panel panel-primary" style="background-color: #FFFFE6; ">
            <div class="panel-heading">
                <h5 class="panel-title text-center">Търсене</h5>
            </div>
            <div class="panel-body">

                <form id="search_form" class="form-horizontal" action="<?= url()?>search" method="post" name="form1" target="_blank">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input class="form-control" name="term" id="inputSearch" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-1">
                                <input type="submit" class="btn btn-primary btn-xs" value="Търси" />
                                <img src="<?php echo url()?>public/images/srchanim1.gif" align="absmiddle"
                                     height="50" width="50">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="panel panel-primary" style="background-color: #FFFFE6;">
            <div class="panel-heading">
                <p style="font-size:1em;color: #00FF00; font-weight:bold" class="panel-title">Валутни курсове</p>
            </div>
            <div style="bgcolor: #FFFFFF" class="panel-body">
            <a name="scrollingCode"></a><a href="http://customs.bg/bg/page/25" target="_blank">Митнически валутни
                курсове<!--а--></a>
        </div>

    </div>
    <!--    --><?php
    //
    //    setlocale(LC_ALL,"bg_BG.UTF8");
    //    echo(strftime("%d. %b. %Y. %a"));
    //    ?>
</div>

<div style="" class="col-lg-6">