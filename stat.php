<!DOCTYPE html>

<html>
<?php include 'head.php'?>
<body>
	<?php include 'header.php'?>
	<h1>Statisztikák</h1>
	<?php
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
		$select = 'SELECT varostav.varos1 as "Állomás 1",varostav.varos2 as "Állomás 2",count(id) as db FROM varostav, jarat
					WHERE (((jarat.honnan = varostav.varos1 AND jarat.hova = varostav.varos2) OR (jarat.hova = varostav.varos1 AND jarat.honnan = varostav.varos2)
					AND (UPPER(varos1) LIKE  UPPER(honnan) AND UPPER(varos2) LIKE  UPPER(hova)) OR (UPPER(varos2) LIKE  UPPER(honnan) AND UPPER(varos1) LIKE  UPPER(hova))) AND tavolsag > 100) 
					GROUP BY varostav.varos1,varostav.varos2 ORDER BY db DESC';
		
		$text = "1. 100km-nél messzebbre közlekedő járatok száma ezek az állomások között";
		
		createTable($select,$text);
		
		
		$select = 'SELECT honnan as "Honnan",hova as "Hova", COUNT(foglalas.id)As "Foglalasok száma" FROM jarat, foglalas 
		WHERE jarat.id = foglalas.jarat GROUP BY honnan,hova ORDER BY "Foglalasok száma" DESC';
		$text = "2. Egyes járatokra foglalt helyek száma";
		
		createTable($select,$text);
		
		$select = 'SELECT nev as "Indul", COUNT(nev)AS "db" FROM jarat, megallok 
		WHERE jarat.honnan = megallok.nev GROUP BY nev ORDER BY "db" DESC';
		
		$text = "3. Egyes megállókból induló járatok száma";
		
		createTable($select,$text);
		
		$select = 'SELECT nev as "Érkezik", COUNT(nev)AS "db" FROM jarat, megallok 
		WHERE jarat.hova = megallok.nev GROUP BY nev ORDER BY "db" DESC';
		
		$text = "4. Egyes megállókba érkező járatok száma";
		
		createTable($select,$text);
		
		$select = 'SELECT jarmu.jarmuszam as "Jármű szám", COUNT(jarmu.jarmuszam) as "db" FROM jarmu, jarat 
		WHERE jarmu.jarmuszam = jarat.jarmuszam GROUP BY jarmu.jarmuszam ORDER BY "db" DESC';
		
		$text = "5. Egyes járművek hány járathoz tartoznak";
		
		createTable($select,$text);

		
		$select = 'SELECT "Jármuszám", SUM("Távolság (km)" )as "Távolság (km)" FROM (
		SELECT jarat.jarmuszam as "Jármuszám", SUM(tavolsag) as "Távolság (km)" 
		FROM varostav, jarat
		WHERE (jarat.honnan = varostav.varos1 AND jarat.hova = varostav.varos2) 
		OR (jarat.hova = varostav.varos1 AND jarat.honnan = varostav.varos2) 
		GROUP BY jarat.jarmuszam,jarat.id ORDER BY jarat.id) 
		GROUP BY "Jármuszám" ORDER BY "Távolság (km)" DESC';
		
		$text = "6. Az egyes jarmuvek mennyi km-t tesznek meg";
		
		createTable($select,$text);
	?>
	
</body>
</html>
