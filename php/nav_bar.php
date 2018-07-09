<?php 
include_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
include_once DIR_UTIL . 'sessionUtil.php';

?>
<nav class="main-nav">
	<div class="logo-search">
		<h1 class="logo">
			<a href="./index.php">Bongo</a>
		</h1>
		<form class="search-form" action="search_page.php">
			<!-- <input type="text" name="city" > -->
			<input type="text" name="city" id="nav_city_input" list="nav_cities_list" autocomplete="off">
			<datalist id="nav_cities_list">
			</datalist>
		</form>
	</div>
	<ul class="main-nav-list">
		<!-- <li>
			<a href="./index.php">Home</a>
		</li> -->

		<?php 
		if (!isLogged()) { 
		?>
		<li>
			<a onclick="document.getElementById('login-container').style.display='block'">Accedi</a>
		</li>
		<?php } else { ?>
		<li class="user-dropdown">
			<span class="user-avatar-menu" onclick="arrow_change('user-arrow')">
				<?php 
				$location = get_avatar_location($_SESSION['userid']);
				?>
				<img class="user-avatar" src="<?php echo $location;?>" width="30" height="30" alt=" ">
				<img id="user-arrow" class="arrow-down" src="../img/icon/arrow_drop_down_black_24px.svg" alt="Arrow">
			</span>
			<ul id="drop-menu" class="drop-menu" style="display:none;">
				<li><?php echo $_SESSION['username'];?></li>
				<hr>
				<li><a href="./profile.php">Profilo</a></li>
				<li><a href="./followed_events.php">Eventi</a></li>
				<li style="border-top: 1px solid grey;">
					<a href="./logout.php">Logout</a>
				</li>
		</ul>
		</li>
		<?php } ?>

		<li>
			<a href="./help.php">Aiuto</a>
		</li>
		<li>
			<a href="./about.php">Chi siamo</a>
		</li>
		<li>
			<a href="./create_event_page.php">Crea un evento</a>
		</li>
	</ul>
</nav>
