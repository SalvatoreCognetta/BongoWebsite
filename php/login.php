<?php
	// $str = "<div id=\"id01\" class=\"modal\">
	// 		<span onclick=\"document.getElementById('id01').style.display='none'\" class=\"close\" title=\"Close Modal\">&times;</span>

	// 		<!-- Modal Content -->
	// 		<form id=\"test\" class=\"modal-content animate\" action=\"/action_page.php\">
	// 			<div class=\"imgcontainer\">
	// 				 <img src=\"../img/bar.jpeg\" alt=\"Avatar\" class=\"avatar\"> 
	// 			</div>

	// 			<div class=\"container\">
	// 				<label for=\"uname\">
	// 					<b>Username</b>
	// 				</label>
	// 				<input type=\"text\" placeholder=\"Enter Username\" name=\"uname\" required>

	// 				<label for=\"psw\">
	// 					<b>Password</b>
	// 				</label>
	// 				<input type=\"password\" placeholder=\"Enter Password\" name=\"psw\" required>

	// 				<button type=\"submit\">Login</button>
	// 				<label>
	// 					<input type=\"checkbox\" checked=\"checked\" name=\"remember\"> Remember me
	// 				</label>
	// 			</div>

	// 			<div class=\"container\" style=\"background-color:#f1f1f1\">
	// 				<button type=\"button\" onclick=\"document.getElementById('id01').style.display='none'\" class=\"cancelbtn\">Cancel</button>
	// 				<span class=\"psw\">Forgot
	// 					<a href=\"#\">password?</a>
	// 				</span>
	// 			</div>
	// 		</form>
	// 	</div>";



	$str = "<div class=\"limiter \">
	
			<div class=\"wrap-login modal\"  id=\"login-form-id\">
				<form class=\"login-form modal-content animate\" >
					<span class=\"login-form-logo\">
					<i class=\"zmdi zmdi-landscape\"></i>
					</span>

					<span class=\"login-form-title\">
						Log in
					</span>

					<div class=\"wrap-login-input\">
						<input class=\"login-input\" type=\"text\" name=\"username\" placeholder=\"Username\">
					</div>

					<div class=\"wrap-login-input\">
						<input class=\"login-input\" type=\"password\" name=\"pass\" placeholder=\"Password\">
					</div>

					<div class=\"wrap-login-ceckbox\">
						<input class=\"login-input-checkbox\" id=\"ckbx\" type=\"checkbox\" name=\"remember-me\">
						<label class=\"label-checkbox\" for=\"ckbx\"> Remember me</label>
					</div>
					100 
					<div class=\"wrap-login-btn\">
						<button class=\"login-btn\"> Login </button>
					</div>

					<div class=\"wrap-login-forgt\">
						<a href=\"#\">Forgot Password?</a>
					</div>
				</form>
		
		</div>
	</div>";

	echo $str;

?>