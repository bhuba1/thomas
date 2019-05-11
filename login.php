<!DOCTYPE html>

<html>
<?php include 'head.php'?>
<body>
	<?php include 'header.php'?>
	
	<h1>Login</h1>
	
	

	<?php
		function check($user) {

		}	
		if(isset($_POST['name'])) {
			//session_start();
			$_SESSION['name'] = $_POST['name'];
			header("Location: login.php");
			
		}else if(!isset($_SESSION['name'])){
			echo "<form method='POST'>
				<input type='text' name='name'/>
				<input type='submit' name = '' value='Login'/>
				</form>";
		}
		if(isset($_SESSION['name'])) {
			echo "<a href='login.php?logout=true'>Kijelentkezés</a>";
		}
		if(isset($_GET['logout']) && $_GET['logout']){
			// remove all session variables
			session_unset();

			// destroy the session
			session_destroy();
			header("Location: login.php");
		}
	 ?>
</body>
</html>
