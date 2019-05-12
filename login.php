<!DOCTYPE html>

<html>
<?php include 'head.php'?>
<body>
	<?php include 'header.php'?>
	
	<h2>Bejelentkezés</h2>
	
	

	<?php
		function chekUser($user) {
			$names = array();

			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');

			if(!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
					
			}else {
				//echo "Sikeres kapcsolodás!";
			}

			
			

			$select = 'SELECT nev FROM ugyfel ORDER BY 1';
			
			$stid = oci_parse($conn, $select);

			oci_execute($stid);


			$nfields = oci_num_fields($stid);
		
			
			for ($i = 1; $i<=$nfields; $i++){
				$field = oci_field_name($stid, $i);
				
			}
			
			oci_execute($stid);


			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {
				
				
				foreach ($row as $item) {
					
					array_push($names,$item);
				}
				
			}
			
			if (in_array($user, $names)) {
   				//echo '<br>'.'megfelelő felhasználó év';
   				return true;
			}else {
				//echo '<br>'.'helytelen felhasználó név';
				return false;
			}
			oci_close($conn);
		}	
		if(isset($_POST['name']) && chekUser($_POST['name'])) {
			//session_start();
			$_SESSION['name'] = $_POST['name'];

			echo '<br>'.'megfelelő felhasználó év';
			
			header("Location: login.php");
			
		}else if(!isset($_SESSION['name'])){
			echo "<form method='POST'>
				<input type='text' name='name'/>
				<input type='submit' name = '' value='Bejelentkezés'/>
				</form>";
		}
		if(isset($_POST['name']) && !chekUser($_POST['name'])) {
			echo '<br>'."<p class = 'error'>Helytelen felhasználó név</p>";
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
