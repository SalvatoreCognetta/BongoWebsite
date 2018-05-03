<div id="login-container" class="login-container animate" style="display:none;">
	<span onclick="document.getElementById('login-container').style.display='none'" class="close" title="Close Login">&times;</span>
	
	<div class="wrap-login">
		<form class="login-form" action="" method="post">
			<span class="login-form-logo">
				<img src="../img/icon/account_circle_black.svg">
			</span>

			<span class="login-form-title">
				Log in
			</span>

			<div class="wrap-input">
				<img src="../img/icon/face_black.svg" class="input-icon">
				<input class="login-input" type="text" name="username" placeholder="Username">
			</div>

			<div class="wrap-input">
				<img src="../img/icon/lock_black.svg" class="input-icon">
				<input class="login-input" type="password" name="pass" placeholder="Password">
			</div>

			<div class="remember-me">
				<input class="input-checkbox" id="ckbox" type="checkbox" name="remember-me">
				<label class="label-checkbox" for="ckbox">Remember me</label>
			</div>

			<div class="container-login-form-btn">
				<input type="submit" value="Login" class="login-form-btn">
			</div>

			<a class="forgot" href=#>Forgot Password?</a>
		</form>
	</div>
</div>