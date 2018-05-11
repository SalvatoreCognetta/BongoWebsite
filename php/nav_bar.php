<nav class="main-nav">
	<div class="logo-search">
		<h1 class="logo">
			<a href="./home.php">Bongo</a>
		</h1>
		<form class="search-form" action="search_page.php">
			<input type="text" name="city" >
		</form>
	</div>
	<ul class="main-nav-list">
		<li>
			
		</li>
		<!-- <li>
			<a href="./home.php">Home</a>
		</li> -->

		<?php 
		if (!isset($_SESSION['loggedin'])) { 
		?>
		<li>
			<a onclick="document.getElementById('login-container').style.display='block'">Accedi</a>
		</li>
		<?php } else { ?>
		<li class="user-dropdown">
			<span class="user-avatar-menu" onclick="arrow_change('user-arrow')">
				<?php 
				$location = get_location($_SESSION['userid'], $conn);
				
				?>
				<img class="user-avatar" src="<?php echo $location;?>" width="30" height="30" alt=" ">
				<img id="user-arrow" class="arrow-down" src="../img/icon/arrow_drop_down_black_24px.svg" alt="Arrow">
			</span>
			<ul id="drop-menu" class="drop-menu" style="display:none;">
				<li><a href="./profile.php">Profilo</a></li>
				<li><a>Test2</a></li>
				<li style="border-top: 1px solid grey;">
					<a href="./logout.php">Logout</a>
				</li>
		</ul>
		</li>
		<?php } ?>

		<li>
			<a href="../html/help.html">Aiuto</a>
		</li>
		<li>
			<a href="../html/about.html">Chi siamo</a>
		</li>
		<li>
			<a>Crea un evento</a>
		</li>
	</ul>
</nav>
