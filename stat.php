<!DOCTYPE html>

<html>
<head>
    <link rel=stylesheet type="text/css" href="styles.css" />
	<meta charset="UTF-8">
	<title>Thomas a gőz mozdony</title>
</head>
<body>
	<?php include 'header.php'?>
	<h1>Statisztikák</h1>
	<?php
		function createTable($tableName) {
			
			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');

			if(!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
					
			}else {
				//echo "Sikeres kapcsolodás!";
			}

			echo '<h2>A(z) '. $tableName.'tábla adatai: </h2>';
			echo '<table border="0">';

			$select = 'SELECT * FROM '.$tableName;
			
			$stid = oci_parse($conn, $select);

			oci_execute($stid);


			$nfields = oci_num_fields($stid);

			echo '<tr>';
			for ($i = 1; $i<=$nfields; $i++){
				$field = oci_field_name($stid, $i);
				echo '<td>' . $field . '</td>';
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
	?>
	
</body>
</html>
