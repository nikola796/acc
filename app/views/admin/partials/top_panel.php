<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="text-align: center">
                <!-- Logo -->
                <div class="logo" >
                    <h1><a href="index.html">Финансов помощник</a></h1>
                </div>
            </div>
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                                <ul class="dropdown-menu animated fadeInUp">
                                    <?php if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === true):?>
                                        <li><a href="profile">Profile</a></li>
                                        <li><a href="<?= uri()?>admin/logout">Изход</a></li>
                                        <?php else:?>
                                        <li><a href="<?= uri()?>login">Login</a></li>
                                        <li><a href="<?= uri()?>signup">Sign Up</a></li>
                                    <?php endif;?>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>