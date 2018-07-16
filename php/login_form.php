
<div id="login-container" class="modal-container animate" style="display:none;">
	<span onclick="document.getElementById('login-container').style.display='none'" class="close" title="Close Login">&times;</span>
	
	<div class="wrap-login">
		<ul class="login-signin">
			<li>
				<a id="login" class="active-form" onclick="activate_form(this.id);">Login</a>
			</li>
			<li>
				<a id="signin" onclick="activate_form(this.id);">Registrati</a>
			</li>
		</ul>

		<!-- Login -->
		<form id="login-form" class="login-form" action="./login.php" onsubmit="return checkLogin(this);" method="post">
			<span class="login-form-logo">
				<img src="../img/icon/account_circle_black.svg" alt="Login logo">
			</span>

			<span class="login-form-title">
				Log in
			</span>

			<div class="wrap-input">
				<img src="../img/icon/face_black.svg" class="input-icon" alt="Account icon">
				<input id="login_username" class="input login-input" type="text" name="username" placeholder="Username" required>
			</div>

			<div class="wrap-input">
				<img src="../img/icon/lock_black.svg" class="input-icon" alt="Password icon">
				<input id="login_psw" class="input login-input" type="password" name="password" placeholder="Password" required>
			</div>


			<div class="container-login-form-btn">
				<input id="login-btn" type="submit" value="Login" name="submit" class="btn btn-wide">
			</div>

		</form>




		<!-- Registrazione -->
		<form id="signin-form" style="display:none;" class="login-form" action="./signin.php" onsubmit="return checkSignup(this);" method="post">
			<span class="login-form-title">
				Registrati
			</span>

			<div class="wrap-input">
				<label>Nome completo</label>
				<input id="signup_fullname" class="input signin-input" type="text" name="fullname" required>
			</div>

			<div class="wrap-input">
				<img src="../img/icon/face_black.svg" class="input-icon" alt="Account icon">
				<label class="input-label">Username</label> <br>
				<input id="signup_username" class="input signin-input" type="text" name="username" required>
			</div>

			<div class="wrap-input">
				<img src="../img/icon/email-24px.svg" class="input-icon" alt="Email icon" > 
				<label class="input-label">Email</label><br>
				<input id="signup_email" class="input signin-input" type="email" name="email" required>
			</div>

			<div class="wrap-input">
				<img src="../img/icon/email-24px.svg" class="input-icon" alt="Email icon"> 
				<label class="input-label">Conferma Email</label><br>
				<input id="signup_emailconfirm" class="input signin-input" type="email" name="email-confirm" required>
			</div>

			<div class="wrap-input">
				<img src="../img/icon/lock_black.svg" class="input-icon" alt="Password icon"> 
				<label class="input-label">Password</label><br>
				<input id="signup_psw" class="input signin-input" type="password" name="password" required>
			</div>

			

			<div class="container-login-form-btn">
				<input type="submit" value="Registrati" name="submit" class="btn btn-wide">
			</div>

		</form>
	</div>
</div>