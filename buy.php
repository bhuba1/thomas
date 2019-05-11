<!DOCTYPE html>

<html>
<?php include 'head.php'?>
<body>
	<?php include 'header.php'?>
	<?php 
		if(!isset($_SESSION['name'])) {
			header("Location: login.php");
		}
	?>
	
	<h1>Jegy vásárlás</h1>
	
	<?php
		$id = -1;
		$ar = -1;
		if(isset($_POST['id']) && isset($_POST['ar'])) {
			$id = $_POST['id'];
			$ar = $_POST['ar'];
		}else {
			//header("Location: jarat.php");
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
			echo '<th>' . 'Ár'. '</th>';
			echo '</tr>';


			oci_execute($stid);


			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {

				echo '<tr>';
				foreach ($row as $item) {
					echo '<td>' . $item . '</td>';
				}
				echo '<td>' . $_POST['ar'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
			oci_close($conn);
		}

		function createSelect($table,$rowName,$name) {
			try{
				//$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
				$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
			}catch(PDOException $e){
				echo ($e->getMessage());
			}
			
			$select = "SELECT $rowName FROM $table ";
			
			$stid = oci_parse($conn, $select);

			oci_execute($stid);
			oci_execute($stid);

				echo "<select name = '$name'>";
				while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {
					
					
					foreach ($row as $item) {
						echo "<option value='$item'>" . $item . '</option>';
					}
					
				}
			echo'</select>';
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
		function getLastId($table) {
			try{
				//$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
				$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
			}catch(PDOException $e){
				echo ($e->getMessage());
			}
			
			$select = "SELECT id FROM $table ORDER BY ID DESC OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY";
			//echo $select;
			$stid = oci_parse($conn, $select);

			oci_execute($stid);
			
			$count = -1;
			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {
					
				
				foreach ($row as $item) {
					$count = $item;
				}
				
			}
			oci_close($conn);
			$count++;
			return $count;
		}
		function getOsztaly($id) {
			try{
				//$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
				$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
			}catch(PDOException $e){
				echo ($e->getMessage());
			}
			
			$select = "SELECT jarmuszam FROM jarat WHERE id ='$id'  ORDER BY ID DESC OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY";
			//echo $select;
			$stid = oci_parse($conn, $select);

			oci_execute($stid);
			
			$szam = -1;
			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {
				foreach ($row as $item) {
					$szam = $item;
				}
				
			}
			$select = "SELECT osztaly FROM jarmu WHERE jarmuszam ='$szam'  ORDER BY osztaly DESC OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY";
			//echo $select;
			$stid = oci_parse($conn, $select);

			oci_execute($stid);
			
			$osztaly = -1;
			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {
				foreach ($row as $item) {
					$osztaly = $item;
				}
				
			}

			oci_close($conn);
			
			return $osztaly;
		}
		function insert($fogid, $ugyid, $jaratid, $osztaly) {
			try{
				//$conn = oci_connect('SYSTEM', 'system', $tns,'UTF8');
				$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');
			}catch(PDOException $e){
		    echo ($e->getMessage());
			}
				
			
				
				$sql = "INSERT INTO foglalas Values('$fogid', '$ugyid', '$jaratid', '$osztaly')";

				
				
				$stid = oci_parse($conn, $sql);
				oci_execute($stid);

				oci_close($conn);
				echo "Foglalas hozzáadva";
				
				header("Location: jarat.php");
				//echo "<meta http-equiv=refresh content=\"0; URL=jarat.php\">";
		}
	?>
	
	<form method="POST" class = 'buy_form'>
		<?php 
			$select = "SELECT honnan, hova, datum, indulas, menetido FROM jarat WHERE id = '$id'";
			$text = "Kiválasztott járat";
			createTable($select,$text);
			
			$ugyid = getId($_SESSION['name']);
			$fogid = getLastId('foglalas');
			$jaratid = $_POST['id'];
			$osztaly = getOsztaly($jaratid);
			
			echo "<input type='hidden' name = 'ugyid' value='$ugyid'/>";
			echo "<input type='hidden' name = 'fogid' value='$fogid'/>";
			echo "<input type='hidden' name = 'jaratid' value='$jaratid'/>";
			echo "<input type='hidden' name = 'osztaly' value='$osztaly'/>";
		?>

		<input type="submit" name = "" value="Megvesz"/>
		<input type="button" onclick="history.back()" name = "" value="Vissza"/>
	</form>
	<?php
		if(isset($_SESSION['name']) && isset($_POST['ugyid'])) {
			

			/*echo $ugyid.' ';
			echo $fogid.' ';
			echo 'Jarat id: '.$jaratid.' ';
			echo $osztaly;*/

			insert($_POST['fogid'],$_POST['ugyid'], $_POST['jaratid'], $_POST['osztaly']);
		}
	?>
</body>
</html>
