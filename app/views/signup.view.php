<?php require('partials/header_index.php') ?>
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>Sign Up</h6>
			                <input class="form-control" type="text" placeholder="E-mail address">
			                <input class="form-control" type="password" placeholder="Password">
			                <input class="form-control" type="password" placeholder="Confirm Password">
			                <div class="action">
			                    <a class="btn btn-primary signup" href="index.html">Sign Up</a>
			                </div>                
			            </div>
			        </div>

			        <div class="already">
			            <p>Have an account already?</p>
			            <a href="<?= uri()?>login">Login</a>
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