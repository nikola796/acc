<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        <!-- Main menu -->
        <li id="home"><a href="<?php echo url()?>admin/home"><i class="glyphicon glyphicon-home"></i> Начало</a></li>
        <li><a href="<?php echo url()?>admin/calendar"><i class="glyphicon glyphicon-calendar"></i> Calendar</a></li>
<!--        <li><a href="stats.html"><i class="glyphicon glyphicon-stats"></i> Statistics (Charts)</a></li>-->
        <?php if($_SESSION['role'] == 1): ?>
        <li id="users"><a href="<?php echo url()?>admin/users"><i class="glyphicon glyphicon-list"></i> Потребители</a></li>
        <?php endif;?>
<!--        <li><a href="important"><i class="glyphicon glyphicon-record"></i>Секция Важно</a></li>-->
        <li id="posts"><a href="<?php echo url()?>admin/posts"><i class="glyphicon glyphicon-pencil"></i> Публикации</a></li>
<!--        <li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Форми</a></li>-->
        <li><a href="folders"><i class="glyphicon glyphicon-list"></i> Пространства</a></li>
<!--        <li class="submenu">-->
<!--            <a href="#">-->
<!--                <i class="glyphicon glyphicon-list"></i> Номенклатури-->
<!--                <span class="caret pull-right"></span>-->
<!--            </a>-->
<!--            <!-- Sub menu -->
<!--            <ul>-->
<!--                <li><a href="folders">Пространства</a></li>-->
<!--                <li><a href="roles">Роли</a></li>-->
<!--            </ul>-->
<!--        </li>-->
    </ul>
</div>