<!DOCTYPE html>

<html>
<?php include 'head.php'?>
<body>
	<?php include 'header.php'?>
	<h1>Statisztikák</h1>
	<?php
		function createTable($s) {
			
			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');

			if(!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
					
			}else {
				//echo "Sikeres kapcsolodás!";
			}

			echo '<h3>1. 100km-nél messzebbre közlekedő járatok száma ezk az állomások között</h3>';
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
		$select = 'SELECT varostav.varos1 as "Állomás 1",varostav.varos2 as "Állomás 2",count(id) as db FROM varostav, jarat
					WHERE (((jarat.honnan = varostav.varos1 AND jarat.hova = varostav.varos2) OR (jarat.hova = varostav.varos1 AND jarat.honnan = varostav.varos2)
					AND (UPPER(varos1) LIKE  UPPER(honnan) AND UPPER(varos2) LIKE  UPPER(hova)) OR (UPPER(varos2) LIKE  UPPER(honnan) AND UPPER(varos1) LIKE  UPPER(hova))) AND tavolsag > 100) 
					GROUP BY varostav.varos1,varostav.varos2 ORDER BY db DESC';
		createTable($select);
	?>
	
</body>
</html>
