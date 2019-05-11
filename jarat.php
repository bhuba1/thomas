<!DOCTYPE html>

<html>
<?php include 'head.php'?>
<body>
	<?php include 'header.php'?>
	<h1>Jarat kereső</h1>

	<form method="POST">
		<input type="text" name="hon" placeholder="Honnan" minlength = "3" required>
		<input type="text" name="hov" placeholder="Hova" minlength = "3" required>
		<input type="date" name="date" value="2010-07-29" min="2010-05-01">
		<select  name="type">
			<option value="1" selected="selected">Teljesárú menetdíj</option>
			<option value="0.33">33% -os</option>
			<option value="0.50">50% -os</option>
		</select>
		<input type="submit" name = "listazas" value="Keresés">

	</form>
	<?php
		function createTable($tableName,$hon,$hov,$date,$type) {
			
			$conn = oci_connect('system', 'cool', 'localhost/thomas','UTF8');

			if(!$conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
					
			}else {
				//echo "Sikeres kapcsolodás!";
			}

			echo '<h2>Talált járatok: </h2>';
			echo '<table border="0" class = "table-dark">';
			
			$hon =mb_strtoupper($hon,'UTF-8');
			$hov =mb_strtoupper($hov,'UTF-8');
			//SELECT honnan,hova,datum as Dátum, indulas as Indulás,menetido as Menetidő, varostav.tavolsag as távolság FROM varostav, jarat WHERE (jarat.honnan = varostav.varos1 AND jarat.hova = varostav.varos2) OR (jarat.hova = varostav.varos1 AND jarat.honnan = varostav.varos2);
			
			/*$select = "SELECT * FROM ".$tableName
			." WHERE UPPER(honnan) LIKE '%".$hon
			."%' AND UPPER(hova) LIKE '%".$hov
			."%' AND datum >= TO_DATE('".$date."','YYYY-MM-DD')";
			*/
			
			/*$select = "SELECT honnan,hova,datum as Dátum, indulas as Indulás,menetido as Menetidő, varostav.tavolsag as távolság FROM varostav, jarat"
			." WHERE (UPPER(honnan) LIKE '%".$hon
			."%' AND UPPER(hova) LIKE '%".$hov
			."%' AND datum >= TO_DATE('".$date."','YYYY-MM-DD')) AND ("
			."(jarat.honnan = varostav.varos1 AND jarat.hova = varostav.varos2) OR (jarat.hova = varostav.varos1 AND jarat.honnan = varostav.varos2)) AND "
			."(UPPER(varos1) LIKE UPPER(honnan) AND UPPER(varos2) LIKE UPPER(hova)) OR (UPPER(varos2) LIKE UPPER(honnan) AND UPPER(varos1) LIKE UPPER(hova))";*/
			$select = "SELECT honnan,hova,datum as Dátum, indulas as Indulás,menetido as Menetidő, varostav.tavolsag as távolság FROM varostav, jarat "
			."WHERE ((UPPER(honnan) LIKE '%".$hon."%' AND UPPER(hova) LIKE '%".$hov."%' AND datum >= TO_DATE('".$date."','YYYY-MM-DD')) "
			."AND ((jarat.honnan = varostav.varos1 AND jarat.hova = varostav.varos2) OR (jarat.hova = varostav.varos1 AND jarat.honnan = varostav.varos2)"
			."AND (UPPER(varos1) LIKE  UPPER(honnan) AND UPPER(varos2) LIKE  UPPER(hova)) OR (UPPER(varos2) LIKE  UPPER(honnan) AND UPPER(varos1) LIKE  UPPER(hova))))";
			//echo $select;
			$stid = oci_parse($conn, $select);
			oci_execute($stid);
			

			$nfields = oci_num_fields($stid);
			//echo $nfields;

			echo '<tr>';
			
			for ($i = 1; $i<=$nfields; $i++){
				$field = oci_field_name($stid, $i);
				echo '<th>' . $field . '</th>';

			}
			echo '<th>Ár</th>';
			echo '<th>Vásárlás</th>';
			echo '</tr>';


			oci_execute($stid);
			
			$last = 0;
			while ( $row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC )) {
				
				echo '<tr>';
				foreach ($row as $item) {
					
					echo '<td>' . $item . '</td>';
					$last = $item;
				}
				echo '<td>'.($last*20*$type).'Ft</td>';
				echo "<td><a href = '#' class = 'jegy'>Jegyvásárlás</a></td>";
				
				echo '</tr>';
			}
			
			if($last == 0) {
				$nfields++;
				echo "<tr><td colspan='$nfields'><p class = 'center'>Sajnos nincs találat</p></td></tr>";
			}
			echo '</table>';
			oci_close($conn);
		}
		if(array_key_exists('listazas',$_POST)){
   			//$_POST['date'] = date("d-m-Y", strtotime($_POST['date']));
			
			//echo "".$_POST['date'];
			//echo $_POST['type'];
			if(!strcmp(strtoupper($_POST['hon']),strtoupper($_POST['hov']))) {
				echo 'asd';
				//header("Location: jarat.php");
				
			}
			createTable("Jarat",$_POST['hon'],$_POST['hov'],$_POST['date'],$_POST['type']);
			// header('Location: keszlet.php');
		}
	?>
</body>
</html>
