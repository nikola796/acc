<?php
$fb = new Facebook\Facebook([
  'app_id' => '1520466278341986',
  'app_secret' => '03968417a9c6bfb1865669d23b4441b0',
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/acc/fb-callback', $permissions);

// echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
?>
<?php require('partials/header_index.php') ?>
    <?php require ('admin/partials/top_panel.php') ?>
    <div class="page-content">
        <div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>Sign In</h6>
			                <div class="social">
	                            <a class="face_login" href="<?php echo $loginUrl?>">
	                                <span class="face_icon">
	                                    <img src="<?php echo url()?>public/images/facebook.png" alt="fb">
	                                </span>
	                                <span class="text">Sign in with Facebook</span>
	                            </a>
	                            <div class="division">
	                                <hr class="left">
	                                <span>or</span>
	                                <hr class="right">
	                            </div>
	                        </div>
			                <input class="form-control" id="username" type="text" placeholder="E-mail address">
			                <input class="form-control" id="password" type="password" placeholder="Password">
			                <div class="action">
			                    <a class="btn btn-primary signup" id="user_login_form" href="index.html">Login</a>
			                </div>                
			            </div>
			        </div>

			        <div class="already">
			            <p>Don't have an account yet?</p>
			            <a href="<?= uri()?>signup">Sign Up</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>
<?php require('admin/partials/footer.php') ?>
<script>
    $('#home').addClass('current')
</script>
<?php require("admin/partials/bottom.php");