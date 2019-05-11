<!DOCTYPE html>

<html>
<?php include 'head.php'?>
<body>
	<?php include 'header.php'?>
	
	<h1>Jegy vásárlás</h1>
	
	<?php
		$id = -1;
		$ar = -1;
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			//echo $id;
		}
		if(isset($_POST['ar'])) {
			$ar = $_POST['ar'];
			//echo $ar;
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
		
		
		
	?>
	
	
	<form method="POST" class = 'buy_form'>
		<?php 
			$select = "SELECT honnan, hova, datum, indulas, menetido FROM jarat WHERE id = '$id'";
			$text = "Kiválasztott járat";
			createTable($select,$text);
		?>
		<input type="submit" name = "" value="Megvesz"/>
		<input type="button" onclick="history.back()" name = "" value="Vissza"/>
		

	</form>
	
</body>
</html>
