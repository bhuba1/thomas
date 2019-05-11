<!DOCTYPE html>

<html>
<?php include 'head.php'?>
<body>
	<?php
		include 'header.php';
		function createTable($tableName) {
			
			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');

			if(!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
					
			}else {
				//echo "Sikeres kapcsolodás!";
			}

			echo '<h2>A(z) '. $tableName.'tábla adatai: </h2>';
			echo '<table border="0" class = "table-dark">';

			$select = 'SELECT * FROM '.$tableName.' ORDER BY 1';
			
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
		
		/*createTable('Megallok');
		createTable('Ugyfel');
		createTable('Varostav');
		createTable('Jarat');
		createTable('Jarmu');
		createTable('Foglalas');*/
		
	?>
	<form method="POST">
		<select  name="table">
			<option value="Megallok">Megállok</option>
			<option value="Ugyfel">Ugyfel</option>
			<option value="Varostav">Varostav</option>
			<option value="Jarat">Járat</option>
			<option value="Jarmu">Jármü</option>
			<option value="Foglalas">Foglalás</option>
		</select>
		<input type="submit" name = "listazas" value="Listázás">

	</form>
	<?php
		if( isset($_POST['table']) ){
			createTable($_POST['table']);
		}
	?>
	
</body>
</html>
