<header>
	<nav class="main-nav">
		<h1 class="logo"><a href="./home.php">Bongo</a></h1>
		<ul class="main-nav-list">
			<!-- <li>
				<a href="./home.php">Home</a>
			</li> -->

			<?php 
			if ($_SESSION['loggedin'] == false) { 
			?>
			<li>
				<a onclick="document.getElementById('login-container').style.display='block'">Accedi</a>
			</li>
			<li>
				<a href="../html/signin.html">Registrati</a>
			</li>
			<?php } else { ?>
			<li class="user-img">
				<a class="header-user">
					<img src="https://secure.gravatar.com/avatar/cda27793a7df7b0679ec0349df6fd03e?s=46&amp;d=identicon" width="30" height="30">
					<img src="../img/icon/arrow_drop_down_black_24px.svg">
				</a>
			</li>
			<li>
				<a href="./logout.php">Logout</a>
			</li>
			<?php } ?>

			<li>
				<a href="../html/help.html">Aiuto</a>
			</li>
			<li>
				<a href="../html/about.html">Chi siamo</a>
			</li>
		</ul>
	</nav>
</header>