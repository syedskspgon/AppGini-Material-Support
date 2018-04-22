<?php if(!isset($Translation)){ @header('Location: index.php?signIn=1'); exit; } ?>
<?php include_once("$currDir/header.php"); ?>

<?php if($_GET['loginFailed']){ ?>
	<div class="alert alert-danger"><?php echo $Translation['login failed']; ?></div>
<?php } ?>
<style>
body, html {
    height: 100%;
    margin: 0;
}

.bgx {
    /* The image used */
    background-image: url("./assets/img/city.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

<div class="row">
	<br>
	<div class="col-sm-6 col-lg-8" id="login_splash">
		<!-- customized splash content here -->
	</div>
	<div class="col-sm-6 col-lg-4">
		<div class="card card-signup">

			<div class="header text-center" data-background-color="purple">
				<h4 class="panel-title"><?php echo $Translation['sign in here']; ?></h4>
				
				<div class="clearfix"></div>
			</div>

			<div class="card-content">
				<form method="post" action="index.php" style="margin-left:20px">
					<div class="form-group label-floating" style="margin:30px 0">
						<label class="control-label" for="username"><?php echo $Translation['username']; ?></label>
						<input class="form-control" name="username" id="username" type="text" required>
					</div>
					<div class="form-group label-floating">
						<label class="control-label" for="password"><?php echo $Translation['password']; ?></label>
						<input class="form-control" name="password" id="password" type="password" required>
						
					</div>
					<span class="help-block"><?php echo $Translation['forgot password']; ?></span>
					<div class="checkbox" style="margin-top:0px">
						<label class="control-label" for="rememberMe" style="margin-left:0px">
							<input type="checkbox" name="rememberMe" id="rememberMe" value="1">
							<span style="font-size:14px;color:#999999"><?php echo $Translation['remember me']; ?></span>
						</label>
					</div>
					

					<div class="row">
						<div class="col-sm-offset-3 col-sm-6">
							<button name="signIn" type="submit" id="submit" value="signIn" class="btn btn-primary btn-simple text-uppercase btn-lg btn-block"><?php echo $Translation['sign in']; ?></button>
						</div>
					</div>
				</form>
			</div>

			<?php if(is_array(getTableList()) && count(getTableList())){ /* if anon. users can see any tables ... */ ?>
				<div class="panel-footer">
					<?php echo $Translation['browse as guest']; ?>
				</div>
			<?php } ?>

		</div>
		<?php if(sqlValue("select count(1) from membership_groups where allowSignup=1")){ ?>
					<a class="btn btn-success pull-right" href="membership_signup.php"><?php echo $Translation['sign up']; ?></a>
				<?php } ?>
	</div>

	
</div>
<script>document.getElementById('username').focus();</script>
<?php include_once("$currDir/footer.php"); ?>
