<?php 
include_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
include_once DIR_UTIL . 'sessionUtil.php';

?>
<nav class="main-nav">
	<div class="logo-search">
		<h2 class="logo">
			<a href="./index.php">Bongo</a>
		</h2>
		<form class="search-form" action="search_page.php">
			<input type="text" name="city" id="nav_city_input" list="nav_cities_list" autocomplete="off">
			<datalist id="nav_cities_list">
			</datalist>
		</form>
	</div>
	<ul class="main-nav-list">

		<?php 
		if (!isLogged()) { 
		?>
		<li>
			<a onclick="document.getElementById('login-container').style.display='block'">Accedi/Registrati</a>
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
			
				<li><a href="./profile.php">Profilo</a></li>
				<li><a href="./followed_events.php">Eventi</a></li>
				<li><a href="./created_events.php">Gestisci</a></li>
				<li><a href="./logout.php">Logout</a></li>

		</ul>
		</li>
		<?php } ?>

		<li>
			<a href="../html/help.html">Aiuto</a>
		</li>
		<li>
			<a href="./about.php">Chi siamo</a>
		</li>
		<li>
			<a href="./create_event_page.php">Crea un evento</a>
		</li>
	</ul>
</nav>
