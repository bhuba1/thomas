<?php session_start() ?>
<header>
	<h1>Thomas</h1>
	<?php
		if(isset($_SESSION['name'])) {
			$user =  $_SESSION['name'];
			echo "<p class = 'user'>Bejlentkezve mint: $user</p>"; 
		}
	?>
</header>
<?php include 'nav.php';?>