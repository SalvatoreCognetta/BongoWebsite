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
		<li class="user-dropdown">
			<span class="user-avatar-menu" onclick="arrow_change('user-arrow')">
				<?php 
				$query = "SELECT location FROM upload INNER JOIN user";
				$stmt = $conn->prepare($query);
				$stmt->execute();
				$result = $stmt->get_result();
				if(!$row = $result->fetch_assoc())
					echo "Errore durante l'upload della foto nel database.";
				?>
				<img class="user-avatar" src="<?php echo $row['location'];?>" width="30" height="30" alt="Account avatar">
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
