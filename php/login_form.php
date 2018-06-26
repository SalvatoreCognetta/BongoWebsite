
<div id="login-container" class="modal-container animate" style="display:none;">
	<span onclick="document.getElementById('login-container').style.display='none'" class="close" title="Close Login">&times;</span>
	
	<div class="wrap-login">
		<ul class="login-signin">
			<li>
				<a id="login" onclick="activate_form(this.id);">Login</a>
			</li>
			<li>
				<a id="signin" onclick="activate_form(this.id);">Registrati</a>
			</li>
		</ul>

		<!-- Login -->
		<form id="login-form" class="login-form" action="./login.php" method="post">
			<span class="login-form-logo">
				<img src="../img/icon/account_circle_black.svg" alt="Login logo">
			</span>

			<span class="login-form-title">
				Log in
			</span>

			<div class="wrap-input">
				<img src="../img/icon/face_black.svg" class="input-icon" alt="Account icon">
				<input class="login-input" type="text" name="username" placeholder="Username" required>
			</div>

			<div class="wrap-input">
				<img src="../img/icon/lock_black.svg" class="input-icon" alt="Password icon">
				<input class="login-input" type="password" name="password" placeholder="Password" required>
			</div>

			<div class="remember-me">
				<input class="input-checkbox" id="ckbox" type="checkbox" name="remember-me">
				<label class="label-checkbox" for="ckbox">Remember me</label>
			</div>

			<div class="container-login-form-btn">
				<input type="submit" value="Login" name="submit" class="login-form-btn">
			</div>

			<a class="forgot" href=#>Forgot Password?</a>
		</form>




		<!-- Registrazione -->
		<form id="signin-form" style="display:none;" class="login-form" action="./signin.php" method="post">
			<span class="login-form-title">
				Registrati
			</span>

			<div class="wrap-input">
				<label>Nome completo</label>
				<input class="signin-input" type="text" name="fullname" required>
			</div>

			<div class="wrap-input">
				<img src="../img/icon/face_black.svg" class="input-icon" alt="Account icon">
				<label class="input-label">Username</label> <br>
				<input class="signin-input" type="text" name="username" required>
			</div>

			<div class="wrap-input">
				<img src="../img/icon/email-24px.svg" class="input-icon" alt="Email icon" > 
				<label class="input-label">Email</label><br>
				<input class="signin-input" type="email" name="email" required>
			</div>

			<div class="wrap-input">
				<img src="../img/icon/email-24px.svg" class="input-icon" alt="Email icon"> 
				<label class="input-label">Conferma Email</label><br>
				<input class="signin-input" type="email" name="email-confirm" required>
			</div>

			<div class="wrap-input">
				<img src="../img/icon/lock_black.svg" class="input-icon" alt="Password icon"> 
				<label class="input-label">Password</label><br>
				<input class="signin-input" type="password" name="password" required>
			</div>

			

			<div class="container-login-form-btn">
				<input type="submit" value="Signin" name="submit" class="login-form-btn">
			</div>

		</form>
	</div>
</div>