<!DOCTYPE html>

<html>
<?php include 'head.php'?>
<body>
	<?php include 'header.php'?>
	
	
	<?php 
		if(!isset($_SESSION['name'])) {
			echo "<h2>Bejelentkezés</h2>";
		}

	?>
	

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
		function getEgyenleg($nev) {
			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');

			if(!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
					
			}else {
				//echo "Sikeres kapcsolodás!";
			}

			$select = "SELECT egyenleg FROM ugyfel WHERE nev = '$nev'";
			
			$stid = oci_parse($conn, $select);

			oci_execute($stid);


			$nfields = oci_num_fields($stid);
		
			
			for ($i = 1; $i<=$nfields; $i++){
				$field = oci_field_name($stid, $i);
				
			}
			
			oci_execute($stid);

			$egyenleg = -1;
			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {
				
				
				foreach ($row as $item) {
					
					$egyenleg = $item;
				}
				
			}
			
			
			oci_close($conn);
			return $egyenleg;
		}

		function chekPass($user,$pass) {
			

			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');

			if(!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
					
			}else {
				//echo "Sikeres kapcsolodás!";
			}

			
			

			$select = "SELECT jelszo FROM ugyfel WHERE nev = '$user' ORDER BY 1";
			
			$stid = oci_parse($conn, $select);

			oci_execute($stid);


			$nfields = oci_num_fields($stid);
		
			
			for ($i = 1; $i<=$nfields; $i++){
				$field = oci_field_name($stid, $i);
				
			}
			
			oci_execute($stid);

			$realPass = "";
			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {
				
				foreach ($row as $item) {
					$realPass = $item;
				}
			}
			if(!strcmp($realPass, $pass)) {
				return true;
			}
			else {
				return false;
			}
			
			oci_close($conn);
		}
		function getId($name) {
			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');

			if(!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

			}else {
					//echo "Sikeres kapcsolodás!";
			}


			$select = "Select id FROM ugyfel WHERE nev = '$name'";

			$stid = oci_parse($conn, $select);

			oci_execute($stid);


			$nfields = oci_num_fields($stid);

			
			for ($i = 1; $i<=$nfields; $i++){
				$field = oci_field_name($stid, $i);
				
			}
			
			oci_execute($stid);

			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {

				
				$ugyid = -1;
				foreach ($row as $item) {
					
					$ugyid = $item;
				}	
			}
			
			oci_close($conn);
			return $ugyid;
		}

		function getJaratIds($id) {
			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');

			if(!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

			}else {
					//echo "Sikeres kapcsolodás!";
			}


			$select = "Select jarat FROM foglalas WHERE ugyfel = '$id'";

			$stid = oci_parse($conn, $select);

			oci_execute($stid);


			$nfields = oci_num_fields($stid);

			
			for ($i = 1; $i<=$nfields; $i++){
				$field = oci_field_name($stid, $i);
				
			}
			
			oci_execute($stid);
			$jaratok = [];
			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {

				
				

				foreach ($row as $item) {
					
					array_push($jaratok,$item);
					
				}	
			}
			
			oci_close($conn);
			return $jaratok;
		}

		function createTable($s,$text) {

			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');

			if(!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

			}else {
					//echo "Sikeres kapcsolodás!";
			}

			echo "<h3>".$text."</h3>";
			echo '<table border="0" class = "table-dark">';

			$select = $s;

			$stid = oci_parse($conn, $select);

			oci_execute($stid);


			$nfields = oci_num_fields($stid);

			echo '<tr>';
			for ($i = 1; $i<=$nfields; $i++){
				$field = oci_field_name($stid, $i);
				echo '<th>' . $field . '</th>';
			}
			
			echo '</tr>';


			oci_execute($stid);


			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {

				echo '<tr>';
				foreach ($row as $item) {
					echo '<td>' . $item . '</td>';
				}
				
				echo '</tr>';
			}
			echo '</table>';
			oci_close($conn);
		}

		if(isset($_POST['name']) && chekUser($_POST['name']) && chekPass($_POST['name'],$_POST['pass'])) {
			//session_start();
			$_SESSION['name'] = $_POST['name'];

			echo '<br>'.'megfelelő felhasználó év';
			
			header("Location: login.php");
			
		}else if(!isset($_SESSION['name'])){
			echo "<form method='POST'>
				<label for = 'name' style=' margin: 0 auto;text-align: center;'>Név</label>
				<input type='text' name='name' required/>
				<label for = 'pass' style=' margin: 0 auto;text-align: center;margin-top: 10px;'>Jelszó</label>
				<input type='password' name='pass' required/>
				<input type='submit' name = '' value='Bejelentkezés'/>
				</form>";
		}
		if(isset($_POST['name']) && isset($_POST['pass']) && (!chekUser($_POST['name']) || !chekPass($_POST['name'],$_POST['pass']))) {
			echo '<br>'."<p class = 'error'>Helytelen felhasználó név vagy jelszó</p>";
		}
		if(isset($_SESSION['name'])) {
			$nev = $_SESSION['name'];
			$egyen = getEgyenleg($nev);
			echo "<div class = 'welcome'>";
			echo "<h2>Üdv $nev!</h2>";
			echo "<p class = 'egyen'>Egyenleged: $egyen Ft</p>";
			echo "<a href='login.php?logout=true' class='logout'>Kijelentkezés</a>";
			echo "</div>";
			
			$jaratok = getJaratIds(getId($_SESSION['name']));
			if(isset($jaratok[0])) {
				$select = "SELECT * FROM jarat WHERE ";
			
				foreach ($jaratok as $jarat) {
					$select .= "id = '$jarat' OR ";
				}
				$select = substr($select, 0, -3);
				
				$text = "Jaratok amikre foglaltál jegyet";
				
				createTable($select,$text);
			}
			else {
				echo "<p class = 'error'>Még nem foglaltál jegyeket.</p>";
			}
			
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
